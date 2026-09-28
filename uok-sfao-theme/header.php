<?php
/**
 * The Header for UOK SFAO Theme (Latest Build)
 *
 * @package UOK_SFAO
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#379934" />
  <link rel="apple-touch-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/fav_icons/icon.png'); ?>" />
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/fav_icons/icon.png'); ?>" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <div class="main_holder">
    <!-- header start -->
    <header>
      <div class="container_content">
        <div class="nav_holder clearfix">
          <div class="header_row">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
              <?php 
                $header_logo = function_exists('get_field') ? get_field('header_logo', 'option') : null;
                if ($header_logo && is_array($header_logo)) : 
              ?>
                <img src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt'] ?: get_bloginfo('name')); ?>" />
              <?php elseif (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
              <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/sfao-logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
              <?php endif; ?>
            </a>

            <div class="lg_menu d-xl-block">
              <nav>
                <?php
                  if (has_nav_menu('primary_menu')) {
                    wp_nav_menu(array(
                      'theme_location' => 'primary_menu',
                      'container'      => false,
                      'items_wrap'     => '<ul>%3$s</ul>',
                      'fallback_cb'    => false,
                    ));
                  } else {
                    echo '<ul>';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/about-us')) . '">About Us</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/stories')) . '">Stories</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/awardees')) . '">Awardees</a></li>';
                    echo '<li><a href="' . esc_url(get_post_type_archive_link('scholarship')) . '">Scholarships</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/contact')) . '">Contact Us</a></li>';
                    echo '</ul>';
                  }
                ?>
              </nav>
            </div>

            <a href="javascript:void(0);" class="search_btn searchClick btn_fill d-none">
              <i class="icon-magnifier"></i>
            </a>

            <div class="menu_btn_holder">
              <a href="javascript:void(0);" class="filter_overaly_trigger" aria-label="Toggle navigation">
                <span><small></small></span>
              </a>
            </div>
          </div>

          <!-- search popup -->
          <div class="search_holder round_full">
            <div class="search_content">
              <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="form-control" placeholder="<?php echo esc_attr_x('Search Scholarships...', 'placeholder', 'uok-sfao'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
              </form>
            </div>
            <span class="close_search searchOffClick"><i class="ri-close-line"></i></span>
          </div>
        </div>
      </div>
    </header>
    <!-- header end -->
