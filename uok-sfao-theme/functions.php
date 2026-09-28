<?php
/**
 * UOK SFAO Custom Theme Functions (Latest Build)
 *
 * @package UOK_SFAO
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function uok_sfao_setup() {
    load_theme_textdomain('uok-sfao', get_template_directory() . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_image_size('scholarship-thumb', 600, 400, true);
    add_image_size('story-thumb', 500, 350, true);
    add_image_size('awardee-thumb', 300, 300, true);
    add_image_size('event-thumb', 500, 350, true);

    // Register Navigation Menus
    register_nav_menus(array(
        'primary_menu'   => esc_html__('Primary Header Menu', 'uok-sfao'),
        'footer_links_1' => esc_html__('Footer Quick Links Column 1', 'uok-sfao'),
        'footer_links_2' => esc_html__('Footer Quick Links Column 2', 'uok-sfao'),
    ));

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 350,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'uok_sfao_setup');

/**
 * Enqueue scripts and styles
 */
function uok_sfao_scripts() {
    $theme_version = wp_get_theme()->get('Version');
    $theme_uri     = get_template_directory_uri();

    // Google Fonts
    wp_enqueue_style('uok-google-fonts', 'https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap', array(), null);

    // Bootstrap Icons CDN
    wp_enqueue_style('uok-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3');

    // Theme Stylesheets
    wp_enqueue_style('uok-main-style', $theme_uri . '/assets/css/main.css', array(), $theme_version);
    wp_enqueue_style('uok-custom-style', $theme_uri . '/assets/css/style.css', array('uok-main-style'), $theme_version);
    wp_enqueue_style('uok-theme-root', get_stylesheet_uri(), array('uok-custom-style'), $theme_version);

    // JavaScript Files
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', $theme_uri . '/assets/js/jquery.js', array(), '3.6.0', true);
    wp_enqueue_script('jquery-migrate', $theme_uri . '/assets/js/jquery-migrate.js', array('jquery'), '3.3.2', true);
    wp_enqueue_script('uok-vendor', $theme_uri . '/assets/js/vendor.js', array('jquery', 'jquery-migrate'), $theme_version, true);
    wp_enqueue_script('uok-main', $theme_uri . '/assets/js/main.js', array('jquery', 'uok-vendor'), $theme_version, true);

    wp_localize_script('uok-main', 'uok_ajax_obj', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'themeUrl' => $theme_uri
    ));
}
add_action('wp_enqueue_scripts', 'uok_sfao_scripts');

/**
 * Register Custom Post Types and Taxonomies
 */
function uok_sfao_register_custom_post_types() {
    // 1. Scholarships CPT
    $scholarship_labels = array(
        'name'               => _x('Scholarships', 'post type general name', 'uok-sfao'),
        'singular_name'      => _x('Scholarship', 'post type singular name', 'uok-sfao'),
        'menu_name'          => _x('Scholarships', 'admin menu', 'uok-sfao'),
        'name_admin_bar'     => _x('Scholarship', 'add new on admin bar', 'uok-sfao'),
        'add_new'            => _x('Add New', 'scholarship', 'uok-sfao'),
        'add_new_item'       => __('Add New Scholarship', 'uok-sfao'),
        'new_item'           => __('New Scholarship', 'uok-sfao'),
        'edit_item'          => __('Edit Scholarship', 'uok-sfao'),
        'view_item'          => __('View Scholarship', 'uok-sfao'),
        'all_items'          => __('All Scholarships', 'uok-sfao'),
        'search_items'       => __('Search Scholarships', 'uok-sfao'),
        'not_found'          => __('No scholarships found.', 'uok-sfao'),
        'not_found_in_trash' => __('No scholarships found in Trash.', 'uok-sfao')
    );

    $scholarship_args = array(
        'labels'             => $scholarship_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'scholarships', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );
    register_post_type('scholarship', $scholarship_args);

    // Taxonomy: Scholarship Status / Category (e.g. Merit-cum-Need, Government & HEC, Endowment, Alumni, Private)
    register_taxonomy('scholarship_cat', array('scholarship'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x('Scholarship Categories', 'taxonomy general name', 'uok-sfao'),
            'singular_name'     => _x('Scholarship Category', 'taxonomy singular name', 'uok-sfao'),
            'search_items'      => __('Search Categories', 'uok-sfao'),
            'all_items'         => __('All Categories', 'uok-sfao'),
            'edit_item'         => __('Edit Category', 'uok-sfao'),
            'update_item'       => __('Update Category', 'uok-sfao'),
            'add_new_item'      => __('Add New Category', 'uok-sfao'),
            'new_item_name'     => __('New Category Name', 'uok-sfao'),
            'menu_name'         => __('Categories', 'uok-sfao'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'scholarship-category'),
        'show_in_rest'      => true,
    ));

    // 2. Student Stories Custom Post Type
    $story_labels = array(
        'name'               => _x('Student Stories', 'post type general name', 'uok-sfao'),
        'singular_name'      => _x('Student Story', 'post type singular name', 'uok-sfao'),
        'menu_name'          => _x('Student Stories', 'admin menu', 'uok-sfao'),
        'add_new'            => _x('Add New Story', 'story', 'uok-sfao'),
        'add_new_item'       => __('Add New Student Story', 'uok-sfao'),
        'edit_item'          => __('Edit Story', 'uok-sfao'),
        'all_items'          => __('All Stories', 'uok-sfao'),
        'menu_icon'          => 'dashicons-format-quote',
    );

    $story_args = array(
        'labels'             => $story_labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'student-stories'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position'      => 6,
        'show_in_rest'       => true,
    );
    register_post_type('student_story', $story_args);

    // 3. Awardees Custom Post Type
    $awardee_labels = array(
        'name'               => _x('Awardees', 'post type general name', 'uok-sfao'),
        'singular_name'      => _x('Awardee', 'post type singular name', 'uok-sfao'),
        'menu_name'          => _x('Awardees', 'admin menu', 'uok-sfao'),
        'add_new'            => _x('Add New Awardee', 'awardee', 'uok-sfao'),
        'add_new_item'       => __('Add New Awardee', 'uok-sfao'),
        'edit_item'          => __('Edit Awardee', 'uok-sfao'),
        'all_items'          => __('All Awardees', 'uok-sfao'),
        'menu_icon'          => 'dashicons-awards',
    );

    $awardee_args = array(
        'labels'             => $awardee_labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'awardees-list'),
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_position'      => 7,
        'show_in_rest'       => true,
    );
    register_post_type('awardee', $awardee_args);
}
add_action('init', 'uok_sfao_register_custom_post_types');

/**
 * Register ACF Options Page for Theme Settings
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => __('Theme General Settings', 'uok-sfao'),
        'menu_title'    => __('Theme Settings', 'uok-sfao'),
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'icon_url'      => 'dashicons-admin-customizer',
        'position'      => 59,
    ));

    acf_add_options_sub_page(array(
        'page_title'  => __('News Ticker Settings', 'uok-sfao'),
        'menu_title'  => __('News Ticker', 'uok-sfao'),
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => __('Header & Footer Settings', 'uok-sfao'),
        'menu_title'  => __('Header & Footer', 'uok-sfao'),
        'parent_slug' => 'theme-general-settings',
    ));
}

/**
 * Auto Sync ACF JSON Fields
 */
add_filter('acf/settings/save_json', function ($path) {
    return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});

/**
 * Include Leads Management System (Modular: CPT, CSV Export, Handler)
 */
if (file_exists(get_template_directory() . '/inc/leads-cpt.php')) {
    require_once get_template_directory() . '/inc/leads-cpt.php';
}
if (file_exists(get_template_directory() . '/inc/leads-export.php')) {
    require_once get_template_directory() . '/inc/leads-export.php';
}
if (file_exists(get_template_directory() . '/inc/leads-handler.php')) {
    require_once get_template_directory() . '/inc/leads-handler.php';
}


