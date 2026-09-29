<?php
/**
 * Leads CSV Export Feature
 * 
 * Provides:
 * 1. "Download Selected Leads (CSV)" button (Blue) - downloads only checked leads.
 * 2. "Download Filtered / All Leads (CSV)" button (Green) - respects active date, topic, status filters!
 * 3. Bulk Action dropdown: "Export Selected to CSV".
 * 4. Secure download handler with UTF-8 BOM support for Microsoft Excel.
 *
 * @package UOK_SFAO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add both "Download Selected" and "Download Filtered / All" buttons on the Leads list table.
 */
function uok_add_export_buttons_to_leads_list( $which ) {
	global $typenow;

	if ( 'sfao_lead' !== $typenow || 'top' !== $which ) {
		return;
	}

	// Build URL preserving active query parameters (filters/date)
	$current_params = array(
		'action'        => 'uok_export_leads',
		'export_type'   => 'all',
		'date_from'     => isset( $_GET['date_from'] ) ? sanitize_text_field( wp_unslash( $_GET['date_from'] ) ) : '',
		'date_to'       => isset( $_GET['date_to'] ) ? sanitize_text_field( wp_unslash( $_GET['date_to'] ) ) : '',
		'filter_topic'  => isset( $_GET['filter_topic'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_topic'] ) ) : '',
		'filter_status' => isset( $_GET['filter_status'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_status'] ) ) : '',
		's'             => isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '',
	);

	$export_all_url = wp_nonce_url(
		add_query_arg( array_filter( $current_params ), admin_url( 'admin-post.php' ) ),
		'uok_export_leads_nonce',
		'export_nonce'
	);

	$nonce = wp_create_nonce( 'uok_export_leads_nonce' );

	$is_filtered   = ( ! empty( $current_params['date_from'] ) || ! empty( $current_params['date_to'] ) || ! empty( $current_params['filter_topic'] ) || ! empty( $current_params['filter_status'] ) || ! empty( $current_params['s'] ) );
	$all_btn_label = $is_filtered ? __( 'Download Filtered Leads (CSV)', 'uok-sfao' ) : __( 'Download All Leads (CSV)', 'uok-sfao' );

	?>
	<div class="alignleft actions" style="display: inline-flex; align-items: center; gap: 6px; margin-left: 6px;">
		<!-- Nonce input for table form submission -->
		<input type="hidden" name="uok_export_nonce" value="<?php echo esc_attr( $nonce ); ?>">

		<!-- Button 1: Download Selected Leads (Blue) -->
		<button type="submit" name="uok_lead_export_action" value="selected" id="uok-export-selected-btn" class="button button-primary" style="background-color: #2563eb; border-color: #1d4ed8; color: #fff; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
			<span class="dashicons dashicons-yes-alt" style="line-height: inherit; font-size: 16px; margin-top: 1px;"></span>
			<span id="uok-selected-btn-text"><?php esc_html_e( 'Download Selected Leads (CSV)', 'uok-sfao' ); ?></span>
		</button>

		<!-- Button 2: Download All / Filtered Leads (Green) -->
		<a href="<?php echo esc_url( $export_all_url ); ?>" class="button" style="background-color: #10b981; border-color: #059669; color: #fff; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
			<span class="dashicons dashicons-download" style="line-height: inherit; font-size: 16px; margin-top: 1px;"></span>
			<?php echo esc_html( $all_btn_label ); ?>
		</a>
	</div>

	<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			function updateCount() {
				var checked = $('input[name="post[]"]:checked').length;
				if (checked > 0) {
					$('#uok-selected-btn-text').text("Download Selected Leads (" + checked + ")");
				} else {
					$('#uok-selected-btn-text').text("Download Selected Leads (CSV)");
				}
			}

			$(document).on('change', 'input[name="post[]"], #cb-select-all-1, #cb-select-all-2', function() {
				updateCount();
			});

			$('#uok-export-selected-btn').on('click', function(e) {
				var checked = $('input[name="post[]"]:checked').length;
				if (checked === 0) {
					e.preventDefault();
					alert("Pehle koi lead select karein (checkbox par tick lagayein).");
				}
			});
		});
	})(jQuery);
	</script>
	<?php
}
add_action( 'manage_posts_extra_tablenav', 'uok_add_export_buttons_to_leads_list' );

/**
 * Handle export requests submitted from the Leads list table.
 */
function uok_check_leads_table_export_submission() {
	global $typenow, $pagenow;

	if ( 'edit.php' !== $pagenow || 'sfao_lead' !== $typenow ) {
		return;
	}

	if ( isset( $_REQUEST['uok_lead_export_action'] ) && 'selected' === $_REQUEST['uok_lead_export_action'] ) {
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_die( esc_html__( 'You do not have permission to export leads.', 'uok-sfao' ) );
		}

		$nonce = isset( $_REQUEST['uok_export_nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['uok_export_nonce'] ) ) : '';
		if ( ! $nonce || ! wp_verify_nonce( $nonce, 'uok_export_leads_nonce' ) ) {
			wp_die( esc_html__( 'Invalid security token. Please refresh and try again.', 'uok-sfao' ) );
		}

		$post_ids = isset( $_REQUEST['post'] ) ? array_map( 'intval', (array) $_REQUEST['post'] ) : array();

		if ( empty( $post_ids ) ) {
			wp_die( esc_html__( 'No leads selected. Please check at least one lead checkbox.', 'uok-sfao' ) );
		}

		uok_generate_leads_csv( $post_ids );
		exit;
	}
}
add_action( 'load-edit.php', 'uok_check_leads_table_export_submission' );

/**
 * Add "Export to CSV" to the standard WordPress Bulk Actions dropdown.
 */
function uok_register_bulk_export_lead_action( $bulk_actions ) {
	$bulk_actions['uok_bulk_export_leads'] = __( 'Export Selected to CSV', 'uok-sfao' );
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-sfao_lead', 'uok_register_bulk_export_lead_action' );

/**
 * Handle the standard WordPress Bulk Action dropdown submission.
 */
function uok_handle_bulk_export_leads( $redirect_to, $doaction, $post_ids ) {
	if ( 'uok_bulk_export_leads' !== $doaction || empty( $post_ids ) ) {
		return $redirect_to;
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to export leads.', 'uok-sfao' ) );
	}

	uok_generate_leads_csv( $post_ids );
	exit;
}
add_filter( 'handle_bulk_actions-edit-sfao_lead', 'uok_handle_bulk_export_leads', 10, 3 );

/**
 * Handle the "Download All / Filtered Leads" direct link action.
 */
function uok_handle_export_all_leads() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to export leads.', 'uok-sfao' ) );
	}

	$nonce = isset( $_GET['export_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['export_nonce'] ) ) : '';

	if ( ! $nonce || ! wp_verify_nonce( $nonce, 'uok_export_leads_nonce' ) ) {
		wp_die( esc_html__( 'Invalid or expired export request.', 'uok-sfao' ) );
	}

	$filters = array(
		'date_from'     => isset( $_GET['date_from'] ) ? sanitize_text_field( wp_unslash( $_GET['date_from'] ) ) : '',
		'date_to'       => isset( $_GET['date_to'] ) ? sanitize_text_field( wp_unslash( $_GET['date_to'] ) ) : '',
		'filter_topic'  => isset( $_GET['filter_topic'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_topic'] ) ) : '',
		'filter_status' => isset( $_GET['filter_status'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_status'] ) ) : '',
		's'             => isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '',
	);

	uok_generate_leads_csv( null, $filters );
	exit;
}
add_action( 'admin_post_uok_export_leads', 'uok_handle_export_all_leads' );

/**
 * Helper function to generate and stream the CSV file to the browser.
 *
 * @param array|null $post_ids Specific lead post IDs to export, or null for query export.
 * @param array|null $filters  Active filters if doing a filtered export.
 */
function uok_generate_leads_csv( $post_ids = null, $filters = null ) {
	if ( ob_get_level() ) {
		ob_end_clean();
	}

	$is_selected = ( ! empty( $post_ids ) && is_array( $post_ids ) );
	$suffix      = $is_selected ? '-selected-' . count( $post_ids ) : '-leads';
	$filename    = 'sfao' . $suffix . '-' . gmdate( 'Y-m-d_H-i-s' ) . '.csv';

	header( 'Content-Type: text/csv; charset=UTF-8' );
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );

	$output = fopen( 'php://output', 'w' );

	// UTF-8 BOM for proper Urdu/Unicode rendering in Microsoft Excel
	fputs( $output, "\xEF\xBB\xBF" );

	// CSV Header row
	$headers = array(
		'Lead ID',
		'Status',
		'Date Submitted',
		'Applicant Name',
		'Phone / WhatsApp',
		'Email Address',
		'Inquiry Topic / Program',
		'Message from Student',
		'Admin Notes',
		'IP Address',
	);
	fputcsv( $output, $headers );

	$query_args = array(
		'post_type'      => 'sfao_lead',
		'post_status'    => array( 'publish', 'private', 'draft' ),
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	if ( $is_selected ) {
		$query_args['post__in'] = array_map( 'intval', $post_ids );
	} elseif ( ! empty( $filters ) && is_array( $filters ) ) {
		// Apply Date filters
		$date_from = ! empty( $filters['date_from'] ) ? $filters['date_from'] : '';
		$date_to   = ! empty( $filters['date_to'] ) ? $filters['date_to'] : '';

		if ( $date_from || $date_to ) {
			$date_query = array( 'inclusive' => true );
			if ( $date_from ) {
				$date_query['after'] = $date_from . ' 00:00:00';
			}
			if ( $date_to ) {
				$date_query['before'] = $date_to . ' 23:59:59';
			}
			$query_args['date_query'] = array( $date_query );
		}

		$meta_query = array( 'relation' => 'AND' );

		if ( ! empty( $filters['filter_topic'] ) ) {
			$meta_query[] = array(
				'relation' => 'OR',
				array( 'key' => 'subject', 'value' => $filters['filter_topic'], 'compare' => '=' ),
				array( 'key' => '_lead_subject', 'value' => $filters['filter_topic'], 'compare' => '=' ),
			);
		}

		if ( ! empty( $filters['filter_status'] ) ) {
			$meta_query[] = array(
				'relation' => 'OR',
				array( 'key' => 'lead_status', 'value' => $filters['filter_status'], 'compare' => '=' ),
				array( 'key' => '_lead_status', 'value' => ucfirst( str_replace( '_', ' ', $filters['filter_status'] ) ), 'compare' => '=' ),
			);
		}

		if ( count( $meta_query ) > 1 ) {
			$query_args['meta_query'] = $meta_query;
		}

		if ( ! empty( $filters['s'] ) ) {
			$query_args['s'] = $filters['s'];
		}
	}

	$leads = get_posts( $query_args );
	$statuses = function_exists( 'uok_get_lead_statuses' ) ? uok_get_lead_statuses() : array();

	foreach ( $leads as $lead ) {
		$status_key = get_post_meta( $lead->ID, 'lead_status', true );
		if ( ! $status_key ) {
			$old_status = get_post_meta( $lead->ID, '_lead_status', true );
			$status_key = strtolower( str_replace( ' ', '_', $old_status ?: 'new' ) );
		}
		$status_label = isset( $statuses[ $status_key ]['label'] ) ? $statuses[ $status_key ]['label'] : ucfirst( $status_key );

		$name        = get_post_meta( $lead->ID, 'full_name', true ) ?: ( get_the_title( $lead->ID ) );
		$phone       = get_post_meta( $lead->ID, 'phone', true ) ?: get_post_meta( $lead->ID, '_lead_phone', true );
		$email       = get_post_meta( $lead->ID, 'email', true ) ?: get_post_meta( $lead->ID, '_lead_email', true );
		$subject     = get_post_meta( $lead->ID, 'subject', true ) ?: get_post_meta( $lead->ID, '_lead_subject', true );
		$message     = get_post_meta( $lead->ID, 'message', true ) ?: get_post_meta( $lead->ID, '_lead_message', true );
		$admin_notes = get_post_meta( $lead->ID, 'admin_notes', true );
		$ip          = get_post_meta( $lead->ID, 'lead_ip', true ) ?: ( get_post_meta( $lead->ID, '_lead_ip', true ) ?: 'N/A' );

		fputcsv( $output, array(
			$lead->ID,
			$status_label,
			get_the_date( 'Y-m-d H:i:s', $lead->ID ),
			$name,
			$phone,
			$email,
			$subject,
			$message,
			$admin_notes,
			$ip,
		) );
	}

	fclose( $output );
	exit;
}
