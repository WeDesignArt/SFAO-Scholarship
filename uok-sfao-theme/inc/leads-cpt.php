<?php
/**
 * UOK SFAO "Contact Leads" Custom Post Type:
 * - Private CPT (admin only)
 * - Custom admin table columns with status badges
 * - Sortable columns
 * - Multi-criteria deep search (Name, Phone, Email, Topic, Message)
 * - Date range (From - To), Inquiry Topic, and Status filtering
 * - Lead status management (New, Contacted, In Review, Awarded, Closed) + Admin Private Notes
 * - Metrics / KPI dashboard bar on top of admin table
 *
 * @package UOK_SFAO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Register CPT: sfao_lead
 */
function uok_register_lead_cpt() {
	register_post_type( 'sfao_lead', array(
		'labels' => array(
			'name'               => __( 'Contact Leads', 'uok-sfao' ),
			'singular_name'      => __( 'Contact Lead', 'uok-sfao' ),
			'menu_name'          => __( 'Contact Leads', 'uok-sfao' ),
			'all_items'          => __( 'All Leads', 'uok-sfao' ),
			'view_item'          => __( 'View Lead', 'uok-sfao' ),
			'search_items'       => __( 'Search Leads', 'uok-sfao' ),
			'not_found'          => __( 'No leads found.', 'uok-sfao' ),
			'not_found_in_trash' => __( 'No leads in Trash.', 'uok-sfao' ),
		),
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => false,
		'show_in_rest'       => false,
		'menu_icon'          => 'dashicons-email-alt2',
		'menu_position'      => 8,
		'supports'           => array( 'title' ),
		'capability_type'    => 'post',
		'map_meta_cap'       => true,
		'capabilities'       => array(
			'create_posts' => 'do_not_allow',
		),
		'has_archive'        => false,
		'rewrite'            => false,
	) );
}
add_action( 'init', 'uok_register_lead_cpt' );

/**
 * Add counter bubble badge to Contact Leads menu in WP Admin
 */
function uok_add_leads_menu_badge() {
	global $menu;
	$unread_count = uok_get_unread_leads_count();
	if ( $unread_count > 0 && is_array( $menu ) ) {
		foreach ( $menu as $key => $item ) {
			if ( isset( $item[2] ) && $item[2] === 'edit.php?post_type=sfao_lead' ) {
				$menu[ $key ][0] .= sprintf( ' <span class="update-plugins count-%1$d"><span class="plugin-count">%1$d</span></span>', $unread_count );
				break;
			}
		}
	}
}
add_action( 'admin_menu', 'uok_add_leads_menu_badge', 999 );

/**
 * Get count of unread (New) leads
 */
function uok_get_unread_leads_count() {
	$query = new WP_Query( array(
		'post_type'      => 'sfao_lead',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'meta_query'     => array(
			'relation' => 'OR',
			array(
				'key'     => 'lead_status',
				'value'   => 'new',
				'compare' => '=',
			),
			array(
				'key'     => '_lead_status',
				'value'   => 'New',
				'compare' => '=',
			),
			array(
				'key'     => 'lead_status',
				'compare' => 'NOT EXISTS',
			),
		),
	) );
	return (int) $query->found_posts;
}

/**
 * Status Definitions & Badges helper.
 */
function uok_get_lead_statuses() {
	return array(
		'new'         => array( 'label' => 'New / Unread', 'bg' => '#fef3c7', 'color' => '#92400e', 'border' => '#fde68a' ),
		'in_review'   => array( 'label' => 'In Review', 'bg' => '#e0f2fe', 'color' => '#0369a1', 'border' => '#bae6fd' ),
		'contacted'   => array( 'label' => 'Contacted', 'bg' => '#e0e7ff', 'color' => '#3730a3', 'border' => '#c7d2fe' ),
		'awarded'     => array( 'label' => 'Awarded / Shortlisted', 'bg' => '#dcfce7', 'color' => '#166534', 'border' => '#86efac' ),
		'closed'      => array( 'label' => 'Closed / Resolved', 'bg' => '#f1f5f9', 'color' => '#475569', 'border' => '#cbd5e1' ),
	);
}

/**
 * Admin list table columns.
 */
function uok_lead_columns( $columns ) {
	unset( $columns['date'] );
	$columns['lead_status']  = __( 'Status', 'uok-sfao' );
	$columns['lead_name']    = __( 'Applicant Name', 'uok-sfao' );
	$columns['lead_phone']   = __( 'Phone / WhatsApp', 'uok-sfao' );
	$columns['lead_email']   = __( 'Email Address', 'uok-sfao' );
	$columns['lead_subject'] = __( 'Inquiry Topic / Program', 'uok-sfao' );
	$columns['lead_message'] = __( 'Message Snippet', 'uok-sfao' );
	$columns['date']         = __( 'Submitted Date', 'uok-sfao' );
	return $columns;
}
add_filter( 'manage_sfao_lead_posts_columns', 'uok_lead_columns' );

/**
 * Admin list table column content.
 */
function uok_lead_column_content( $column, $post_id ) {
	$statuses = uok_get_lead_statuses();

	switch ( $column ) {
		case 'lead_status':
			$status_key = get_post_meta( $post_id, 'lead_status', true );
			if ( ! $status_key ) {
				$old_status = get_post_meta( $post_id, '_lead_status', true );
				$status_key = strtolower( str_replace( ' ', '_', $old_status ?: 'new' ) );
			}
			if ( ! isset( $statuses[ $status_key ] ) ) {
				$status_key = 'new';
			}
			$st = $statuses[ $status_key ];
			echo '<span style="display:inline-block; padding:3px 9px; border-radius:12px; font-size:11px; font-weight:700; background-color:' . esc_attr( $st['bg'] ) . '; color:' . esc_attr( $st['color'] ) . '; border:1px solid ' . esc_attr( $st['border'] ) . ';">' . esc_html( $st['label'] ) . '</span>';
			break;

		case 'lead_name':
			$name = get_post_meta( $post_id, 'full_name', true );
			if ( ! $name ) {
				$name = get_the_title( $post_id );
			}
			$edit_link = get_edit_post_link( $post_id );
			echo '<strong><a href="' . esc_url( $edit_link ) . '" style="color:#1a3c2b; font-size:13px;">' . esc_html( $name ) . '</a></strong>';
			break;

		case 'lead_phone':
			$phone = get_post_meta( $post_id, 'phone', true );
			if ( ! $phone ) {
				$phone = get_post_meta( $post_id, '_lead_phone', true );
			}
			if ( $phone ) {
				$clean_phone = preg_replace( '/[^0-9+]/', '', $phone );
				echo '<a href="tel:' . esc_attr( $clean_phone ) . '" style="text-decoration:none;">' . esc_html( $phone ) . '</a>';
				echo ' <a href="https://wa.me/' . esc_attr( ltrim( $clean_phone, '+' ) ) . '" target="_blank" title="Chat on WhatsApp" style="text-decoration:none; margin-left:4px; font-size:14px;">💬</a>';
			} else {
				echo '&mdash;';
			}
			break;

		case 'lead_email':
			$email = get_post_meta( $post_id, 'email', true );
			if ( ! $email ) {
				$email = get_post_meta( $post_id, '_lead_email', true );
			}
			if ( $email ) {
				echo '<a href="mailto:' . esc_attr( $email ) . '" style="text-decoration:none;">' . esc_html( $email ) . '</a>';
			} else {
				echo '&mdash;';
			}
			break;

		case 'lead_subject':
			$subject = get_post_meta( $post_id, 'subject', true );
			if ( ! $subject ) {
				$subject = get_post_meta( $post_id, '_lead_subject', true );
			}
			echo '<span style="background:#f1f5f9; padding:2px 8px; border-radius:4px; font-size:12px; font-weight:500;">' . esc_html( $subject ?: 'General' ) . '</span>';
			break;

		case 'lead_message':
			$msg = get_post_meta( $post_id, 'message', true );
			if ( ! $msg ) {
				$msg = get_post_meta( $post_id, '_lead_message', true );
			}
			echo esc_html( wp_trim_words( $msg, 8, '...' ) );
			break;
	}
}
add_action( 'manage_sfao_lead_posts_custom_column', 'uok_lead_column_content', 10, 2 );

/**
 * Make columns sortable.
 */
function uok_lead_sortable_columns( $columns ) {
	$columns['lead_name']    = 'lead_name';
	$columns['lead_subject'] = 'lead_subject';
	$columns['lead_status']  = 'lead_status';
	$columns['date']         = 'date';
	return $columns;
}
add_filter( 'manage_edit-sfao_lead_sortable_columns', 'uok_lead_sortable_columns' );

/**
 * Handle custom column ordering in WP_Query.
 */
function uok_lead_orderby_custom_columns( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() || 'sfao_lead' !== $query->get( 'post_type' ) ) {
		return;
	}

	$orderby = $query->get( 'orderby' );

	switch ( $orderby ) {
		case 'lead_name':
			$query->set( 'meta_key', 'full_name' );
			$query->set( 'orderby', 'meta_value' );
			break;
		case 'lead_subject':
			$query->set( 'meta_key', 'subject' );
			$query->set( 'orderby', 'meta_value' );
			break;
		case 'lead_status':
			$query->set( 'meta_key', 'lead_status' );
			$query->set( 'orderby', 'meta_value' );
			break;
	}
}
add_action( 'pre_get_posts', 'uok_lead_orderby_custom_columns' );

/**
 * Top Metrics Summary Banner on Leads List Page.
 */
function uok_lead_admin_metrics_banner() {
	global $pagenow, $typenow;

	if ( 'edit.php' !== $pagenow || 'sfao_lead' !== $typenow ) {
		return;
	}

	$total_leads_obj = wp_count_posts( 'sfao_lead' );
	$total_leads     = isset( $total_leads_obj->publish ) ? $total_leads_obj->publish : 0;

	$today_query = new WP_Query( array(
		'post_type'      => 'sfao_lead',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'date_query'     => array(
			array(
				'year'  => gmdate( 'Y' ),
				'month' => gmdate( 'm' ),
				'day'   => gmdate( 'd' ),
			),
		),
		'fields'         => 'ids',
	) );
	$today_count = $today_query->found_posts;

	$month_query = new WP_Query( array(
		'post_type'      => 'sfao_lead',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'date_query'     => array(
			array(
				'year'  => gmdate( 'Y' ),
				'month' => gmdate( 'm' ),
			),
		),
		'fields'         => 'ids',
	) );
	$month_count = $month_query->found_posts;

	$new_count = uok_get_unread_leads_count();

	?>
	<div style="display:flex; gap:15px; margin: 15px 0 12px 0; flex-wrap: wrap;">
		<div style="flex:1; min-width:160px; background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; box-shadow:0 1px 3px rgba(0,0,0,0.05); border-left:4px solid #3b82f6;">
			<div style="font-size:12px; color:#64748b; font-weight:600; text-transform:uppercase;"><?php esc_html_e( 'Total Leads', 'uok-sfao' ); ?></div>
			<div style="font-size:24px; font-weight:800; color:#1e293b; margin-top:4px;"><?php echo esc_html( number_format_i18n( $total_leads ) ); ?></div>
		</div>
		<div style="flex:1; min-width:160px; background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; box-shadow:0 1px 3px rgba(0,0,0,0.05); border-left:4px solid #f59e0b;">
			<div style="font-size:12px; color:#64748b; font-weight:600; text-transform:uppercase;"><?php esc_html_e( 'New / Pending', 'uok-sfao' ); ?></div>
			<div style="font-size:24px; font-weight:800; color:#d97706; margin-top:4px;"><?php echo esc_html( number_format_i18n( $new_count ) ); ?></div>
		</div>
		<div style="flex:1; min-width:160px; background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; box-shadow:0 1px 3px rgba(0,0,0,0.05); border-left:4px solid #10b981;">
			<div style="font-size:12px; color:#64748b; font-weight:600; text-transform:uppercase;"><?php esc_html_e( 'This Month', 'uok-sfao' ); ?></div>
			<div style="font-size:24px; font-weight:800; color:#059669; margin-top:4px;"><?php echo esc_html( number_format_i18n( $month_count ) ); ?></div>
		</div>
		<div style="flex:1; min-width:160px; background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:12px 16px; box-shadow:0 1px 3px rgba(0,0,0,0.05); border-left:4px solid #8b5cf6;">
			<div style="font-size:12px; color:#64748b; font-weight:600; text-transform:uppercase;"><?php esc_html_e( "Today's Leads", 'uok-sfao' ); ?></div>
			<div style="font-size:24px; font-weight:800; color:#6d28d9; margin-top:4px;"><?php echo esc_html( number_format_i18n( $today_count ) ); ?></div>
		</div>
	</div>
	<?php
}
add_action( 'all_admin_notices', 'uok_lead_admin_metrics_banner' );

/**
 * Filter dropdowns in Admin Table (Date Range, Topic, Status).
 */
function uok_lead_admin_filters() {
	global $typenow, $wpdb;

	if ( 'sfao_lead' !== $typenow ) {
		return;
	}

	$selected_topic  = isset( $_GET['filter_topic'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_topic'] ) ) : '';
	$selected_status = isset( $_GET['filter_status'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_status'] ) ) : '';
	$date_from       = isset( $_GET['date_from'] ) ? sanitize_text_field( wp_unslash( $_GET['date_from'] ) ) : '';
	$date_to         = isset( $_GET['date_to'] ) ? sanitize_text_field( wp_unslash( $_GET['date_to'] ) ) : '';

	$topics = $wpdb->get_col( $wpdb->prepare(
		"SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm
		INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
		WHERE p.post_type = %s AND pm.meta_key IN ('subject', '_lead_subject') AND pm.meta_value != ''
		ORDER BY pm.meta_value ASC",
		'sfao_lead'
	) );

	?>
	<span style="display:inline-flex; align-items:center; gap:3px; margin: 0 4px;">
		<span style="font-size:12px; color:#64748b; font-weight:600;">From:</span>
		<input type="date" name="date_from" value="<?php echo esc_attr( $date_from ); ?>" style="padding: 2px 6px; font-size: 13px; height: 30px; border-radius: 4px; border: 1px solid #8c8f94;">
	</span>
	<span style="display:inline-flex; align-items:center; gap:3px; margin: 0 4px;">
		<span style="font-size:12px; color:#64748b; font-weight:600;">To:</span>
		<input type="date" name="date_to" value="<?php echo esc_attr( $date_to ); ?>" style="padding: 2px 6px; font-size: 13px; height: 30px; border-radius: 4px; border: 1px solid #8c8f94;">
	</span>

	<!-- Topic Filter -->
	<select name="filter_topic">
		<option value=""><?php esc_html_e( 'All Inquiry Topics', 'uok-sfao' ); ?></option>
		<?php foreach ( $topics as $topic ) : ?>
			<option value="<?php echo esc_attr( $topic ); ?>" <?php selected( $selected_topic, $topic ); ?>>
				<?php echo esc_html( $topic ); ?>
			</option>
		<?php endforeach; ?>
	</select>

	<!-- Status Filter -->
	<select name="filter_status">
		<option value=""><?php esc_html_e( 'All Statuses', 'uok-sfao' ); ?></option>
		<?php foreach ( uok_get_lead_statuses() as $key => $st ) : ?>
			<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $selected_status, $key ); ?>>
				<?php echo esc_html( $st['label'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
}
add_action( 'restrict_manage_posts', 'uok_lead_admin_filters' );

/**
 * Filter the Leads list query according to selected filters.
 */
function uok_lead_filter_query( $query ) {
	global $pagenow;

	if ( ! is_admin() || ! $query->is_main_query() || 'edit.php' !== $pagenow || 'sfao_lead' !== $query->get( 'post_type' ) ) {
		return;
	}

	$meta_query = array( 'relation' => 'AND' );

	if ( ! empty( $_GET['filter_topic'] ) ) {
		$topic = sanitize_text_field( wp_unslash( $_GET['filter_topic'] ) );
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key'     => 'subject',
				'value'   => $topic,
				'compare' => '=',
			),
			array(
				'key'     => '_lead_subject',
				'value'   => $topic,
				'compare' => '=',
			),
		);
	}

	if ( ! empty( $_GET['filter_status'] ) ) {
		$status = sanitize_text_field( wp_unslash( $_GET['filter_status'] ) );
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key'     => 'lead_status',
				'value'   => $status,
				'compare' => '=',
			),
			array(
				'key'     => '_lead_status',
				'value'   => ucfirst( str_replace( '_', ' ', $status ) ),
				'compare' => '=',
			),
		);
	}

	if ( count( $meta_query ) > 1 ) {
		$query->set( 'meta_query', $meta_query );
	}

	$date_from = ! empty( $_GET['date_from'] ) ? sanitize_text_field( wp_unslash( $_GET['date_from'] ) ) : '';
	$date_to   = ! empty( $_GET['date_to'] ) ? sanitize_text_field( wp_unslash( $_GET['date_to'] ) ) : '';

	if ( $date_from || $date_to ) {
		$date_query = array( 'inclusive' => true );
		if ( $date_from ) {
			$date_query['after'] = $date_from . ' 00:00:00';
		}
		if ( $date_to ) {
			$date_query['before'] = $date_to . ' 23:59:59';
		}
		$query->set( 'date_query', array( $date_query ) );
	}
}
add_action( 'pre_get_posts', 'uok_lead_filter_query' );

/**
 * Deep Search across meta fields (Name, Phone, Email, Topic, Message).
 */
function uok_lead_deep_search( $search, $query ) {
	global $wpdb;

	if ( ! is_admin() || ! $query->is_main_query() || 'sfao_lead' !== $query->get( 'post_type' ) || empty( $query->get( 's' ) ) ) {
		return $search;
	}

	$term = sanitize_text_field( $query->get( 's' ) );
	$like = '%' . $wpdb->esc_like( $term ) . '%';

	$meta_post_ids = $wpdb->get_col( $wpdb->prepare(
		"SELECT DISTINCT post_id FROM {$wpdb->postmeta}
		WHERE meta_key IN ('full_name', 'phone', 'email', 'subject', 'message', '_lead_email', '_lead_phone', '_lead_subject', '_lead_message')
		AND meta_value LIKE %s",
		$like
	) );

	if ( ! empty( $meta_post_ids ) ) {
		$search = " AND ({$wpdb->posts}.post_title LIKE '{$like}' OR {$wpdb->posts}.ID IN (" . implode( ',', array_map( 'intval', $meta_post_ids ) ) . ")) ";
	}

	return $search;
}
add_filter( 'posts_search', 'uok_lead_deep_search', 10, 2 );

/**
 * Detail Screen: Read-only table + Editable Status & Notes meta box.
 */
function uok_lead_meta_boxes() {
	add_meta_box( 'uok_lead_status_box', __( 'Lead Management & Status', 'uok-sfao' ), 'uok_render_lead_status_box', 'sfao_lead', 'side', 'high' );
	add_meta_box( 'uok_lead_details', __( 'Submission Details', 'uok-sfao' ), 'uok_render_lead_meta_box', 'sfao_lead', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'uok_lead_meta_boxes' );

/**
 * Status management side meta box.
 */
function uok_render_lead_status_box( $post ) {
	wp_nonce_field( 'uok_save_lead_status', 'uok_lead_status_nonce' );

	$current_status = get_post_meta( $post->ID, 'lead_status', true );
	if ( ! $current_status ) {
		$old_status = get_post_meta( $post->ID, '_lead_status', true );
		$current_status = strtolower( str_replace( ' ', '_', $old_status ?: 'new' ) );
	}
	$admin_notes = get_post_meta( $post->ID, 'admin_notes', true );
	$statuses    = uok_get_lead_statuses();

	?>
	<div style="margin-bottom: 15px;">
		<label for="lead_status" style="font-weight:600; display:block; margin-bottom:5px;"><?php esc_html_e( 'Update Lead Status:', 'uok-sfao' ); ?></label>
		<select name="lead_status" id="lead_status" style="width:100%;">
			<?php foreach ( $statuses as $key => $st ) : ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current_status, $key ); ?>>
					<?php echo esc_html( $st['label'] ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>

	<div>
		<label for="admin_notes" style="font-weight:600; display:block; margin-bottom:5px;"><?php esc_html_e( 'Admin Private Notes:', 'uok-sfao' ); ?></label>
		<textarea name="admin_notes" id="admin_notes" rows="4" style="width:100%; border-radius:4px;" placeholder="<?php esc_attr_e( 'Add internal notes about this applicant (e.g. called student on Monday, verified documents)...', 'uok-sfao' ); ?>"><?php echo esc_textarea( $admin_notes ); ?></textarea>
	</div>
	<?php
}

/**
 * Save lead status and notes.
 */
function uok_save_lead_meta( $post_id ) {
	if ( ! isset( $_POST['uok_lead_status_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['uok_lead_status_nonce'] ) ), 'uok_save_lead_status' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['lead_status'] ) ) {
		$status = sanitize_text_field( wp_unslash( $_POST['lead_status'] ) );
		update_post_meta( $post_id, 'lead_status', $status );
		update_post_meta( $post_id, '_lead_status', ucfirst( str_replace( '_', ' ', $status ) ) );
	}

	if ( isset( $_POST['admin_notes'] ) ) {
		update_post_meta( $post_id, 'admin_notes', sanitize_textarea_field( wp_unslash( $_POST['admin_notes'] ) ) );
	}
}
add_action( 'save_post_sfao_lead', 'uok_save_lead_meta' );

/**
 * Submission Details Box.
 */
function uok_render_lead_meta_box( $post ) {
	$name    = get_post_meta( $post->ID, 'full_name', true ) ?: get_the_title( $post->ID );
	$phone   = get_post_meta( $post->ID, 'phone', true ) ?: get_post_meta( $post->ID, '_lead_phone', true );
	$email   = get_post_meta( $post->ID, 'email', true ) ?: get_post_meta( $post->ID, '_lead_email', true );
	$subject = get_post_meta( $post->ID, 'subject', true ) ?: get_post_meta( $post->ID, '_lead_subject', true );
	$message = get_post_meta( $post->ID, 'message', true ) ?: get_post_meta( $post->ID, '_lead_message', true );
	$ip      = get_post_meta( $post->ID, 'lead_ip', true ) ?: ( get_post_meta( $post->ID, '_lead_ip', true ) ?: 'N/A' );
	$date    = get_the_date( 'F j, Y \a\t g:i A', $post->ID );

	echo '<table class="widefat striped" style="border-radius:4px; overflow:hidden;"><tbody>';
	echo '<tr><th style="width:200px; font-weight:600; color:#334155;">' . esc_html__( 'Applicant Name', 'uok-sfao' ) . '</th><td style="color:#0f172a; font-weight:700; font-size:14px;">' . esc_html( $name ) . '</td></tr>';
	
	echo '<tr><th style="font-weight:600; color:#334155;">' . esc_html__( 'Phone / WhatsApp', 'uok-sfao' ) . '</th><td>';
	if ( $phone ) {
		$clean_phone = preg_replace( '/[^0-9+]/', '', $phone );
		echo '<a href="tel:' . esc_attr( $clean_phone ) . '" class="button button-secondary">📞 ' . esc_html( $phone ) . '</a> ';
		echo '<a href="https://wa.me/' . esc_attr( ltrim( $clean_phone, '+' ) ) . '" target="_blank" class="button button-secondary" style="color:#25D366;">💬 WhatsApp Chat</a>';
	} else {
		echo '—';
	}
	echo '</td></tr>';

	echo '<tr><th style="font-weight:600; color:#334155;">' . esc_html__( 'Email Address', 'uok-sfao' ) . '</th><td>';
	if ( $email ) {
		echo '<a href="mailto:' . esc_attr( $email ) . '" class="button button-secondary">✉️ ' . esc_html( $email ) . '</a>';
	} else {
		echo '—';
	}
	echo '</td></tr>';

	echo '<tr><th style="font-weight:600; color:#334155;">' . esc_html__( 'Inquiry Topic / Program', 'uok-sfao' ) . '</th><td><span style="background:#e0f2fe; color:#0369a1; padding:4px 10px; border-radius:4px; font-weight:600;">' . esc_html( $subject ?: 'General' ) . '</span></td></tr>';
	echo '<tr><th style="font-weight:600; color:#334155;">' . esc_html__( 'Submitted Date / Time', 'uok-sfao' ) . '</th><td>' . esc_html( $date ) . ' (' . esc_html( human_time_diff( get_the_time( 'U', $post->ID ), current_time( 'timestamp' ) ) ) . ' ago)</td></tr>';
	echo '<tr><th style="font-weight:600; color:#334155;">' . esc_html__( 'IP Address', 'uok-sfao' ) . '</th><td><code>' . esc_html( $ip ) . '</code></td></tr>';
	echo '<tr><th style="font-weight:600; color:#334155; vertical-align:top;">' . esc_html__( 'Student Message', 'uok-sfao' ) . '</th><td style="line-height:1.7; white-space:pre-wrap; background:#fff;">' . esc_html( $message ) . '</td></tr>';
	echo '</tbody></table>';
}

/**
 * Remove slug box.
 */
function uok_lead_remove_meta_boxes() {
	remove_meta_box( 'slugdiv', 'sfao_lead', 'normal' );
}
add_action( 'admin_menu', 'uok_lead_remove_meta_boxes' );
