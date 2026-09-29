<?php
/**
 * UOK SFAO Leads Form Submission Handler
 * Handles AJAX submissions from the Contact Form (page-contact.php)
 *
 * @package UOK_SFAO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle AJAX Lead Submission
 */
function uok_handle_lead_submission() {
	if ( ! isset( $_POST['lead_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lead_nonce'] ) ), 'uok_contact_lead_action' ) ) {
		wp_send_json_error( array( 'message' => __( 'Security verification failed. Please refresh the page and try again.', 'uok-sfao' ) ) );
	}

	$full_name = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
	$email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone     = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$subject   = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : 'General Scholarship Inquiry';
	$message   = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	// Contact page form: department becomes the topic, roll number is kept with the message.
	$department = isset( $_POST['department'] ) ? sanitize_text_field( wp_unslash( $_POST['department'] ) ) : '';
	if ( 'other' === $department ) {
		$department = isset( $_POST['other_department'] ) ? sanitize_text_field( wp_unslash( $_POST['other_department'] ) ) : '';
	}
	if ( $department ) {
		$subject = $department;
	}
	$student_id = isset( $_POST['student_id'] ) ? sanitize_text_field( wp_unslash( $_POST['student_id'] ) ) : '';
	if ( $student_id && $message ) {
		$message = 'Student ID / Roll No: ' . $student_id . "\n\n" . $message;
	}

	if ( empty( $full_name ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter your full name.', 'uok-sfao' ) ) );
	}
	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid email address.', 'uok-sfao' ) ) );
	}
	if ( empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Please write your message or inquiry.', 'uok-sfao' ) ) );
	}

	$user_ip = ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) ) : ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) : sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) );

	$lead_id = wp_insert_post( array(
		'post_title'  => $full_name . ' — ' . $subject,
		'post_type'   => 'sfao_lead',
		'post_status' => 'publish',
		'post_author' => 1,
	) );

	if ( is_wp_error( $lead_id ) ) {
		wp_send_json_error( array( 'message' => __( 'Something went wrong while submitting. Please try again later.', 'uok-sfao' ) ) );
	}

	// Update meta keys for both formats (backward compatible)
	update_post_meta( $lead_id, 'full_name', $full_name );
	update_post_meta( $lead_id, 'email', $email );
	update_post_meta( $lead_id, 'phone', $phone );
	update_post_meta( $lead_id, 'subject', $subject );
	update_post_meta( $lead_id, 'message', $message );
	update_post_meta( $lead_id, 'lead_status', 'new' );
	update_post_meta( $lead_id, 'lead_ip', $user_ip );

	// Legacy keys
	update_post_meta( $lead_id, '_lead_email', $email );
	update_post_meta( $lead_id, '_lead_phone', $phone );
	update_post_meta( $lead_id, '_lead_subject', $subject );
	update_post_meta( $lead_id, '_lead_message', $message );
	update_post_meta( $lead_id, '_lead_status', 'New' );
	update_post_meta( $lead_id, '_lead_ip', $user_ip );

	// Email Notification to Admin
	$admin_email = get_option( 'admin_email' );
	$sfao_email  = function_exists( 'get_field' ) ? get_field( 'footer_email', 'option' ) : 'sfao@uok.edu.pk';
	$recipient   = ! empty( $sfao_email ) ? $sfao_email : $admin_email;

	$email_subject = sprintf( '[SFAO New Lead] %s - %s', $subject, $full_name );
	$email_body    = "New Scholarship / Contact Inquiry Received:\n\n"
		. "Name: " . $full_name . "\n"
		. "Email: " . $email . "\n"
		. "Phone: " . $phone . "\n"
		. "Topic: " . $subject . "\n"
		. "Date: " . current_time( 'F j, Y, g:i a' ) . "\n\n"
		. "Message:\n" . $message . "\n\n"
		. "View and manage this lead in WordPress:\n"
		. admin_url( 'post.php?post=' . $lead_id . '&action=edit' );

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'From: SFAO Portal <' . $admin_email . '>',
		'Reply-To: ' . $full_name . ' <' . $email . '>',
	);
	@wp_mail( $recipient, $email_subject, $email_body, $headers );

	wp_send_json_success( array(
		'message' => __( 'Thank you! Your message has been received successfully. The SFAO team will review your inquiry and get back to you shortly.', 'uok-sfao' ),
	) );
}
add_action( 'wp_ajax_uok_submit_lead', 'uok_handle_lead_submission' );
add_action( 'wp_ajax_nopriv_uok_submit_lead', 'uok_handle_lead_submission' );
