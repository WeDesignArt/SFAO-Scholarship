<?php
/**
 * Template Name: Events Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields
$banner_title = function_exists('get_field') && get_field('events_banner_title', $post_id) ? get_field('events_banner_title', $post_id) : 'SFAO Events & Activities';
$banner_image = function_exists('get_field') ? get_field('events_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/stories.jpg';

$main_title = function_exists('get_field') && get_field('events_main_title', $post_id) ? get_field('events_main_title', $post_id) : 'Event Highlights & Award Ceremonies';
$main_subtitle = function_exists('get_field') && get_field('events_main_subtitle', $post_id) ? get_field('events_main_subtitle', $post_id) : 'A visual chronicle of scholarship distribution events, donor meetings, orientation sessions, and student recognition ceremonies held at the University of Karachi.';
$gallery = function_exists('get_field') ? get_field('events_gallery', $post_id) : null;
?>

    <main role="main" class="home_content nav_space clearfix">

      <!-- Hero Banner -->
      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url($banner_image_url); ?>" alt="<?php echo esc_attr($banner_title); ?>" class="img-fluid w-100">
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php echo esc_html($banner_title); ?></h1>
            </div>
          </div>
        </div>
      </section>

      <!-- Events Collage Section -->
      <section class="sfao-events-section overflow-hidden ptb_80">
        <div class="container">
          <div class="text-sfao-events mb-5" data-aos="fade-up">
            <h2 class="section_title h2 divider_heading center text-center">
              <?php echo esc_html($main_title); ?>
            </h2>
            <p class="text-center gray_7 col-lg-8 mx-auto mt-3">
              <?php echo esc_html($main_subtitle); ?>
            </p>
          </div>

          <div class="image-collage">
            <div class="row g-4" data-aos="fade-left">
              <?php if (!empty($gallery) && is_array($gallery)) : ?>
                <?php foreach ($gallery as $item) : ?>
                  <div class="col-md-4">
                    <div class="image-box">
                      <img src="<?php echo esc_url($item['url']); ?>" class="img-fluid w-100 rounded" alt="<?php echo esc_attr($item['alt'] ?: 'Event'); ?>">
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <?php for ($i = 1; $i <= 9; $i++) : ?>
                  <div class="col-md-4">
                    <div class="image-box">
                      <img src="<?php echo esc_url($theme_uri . '/assets/images/uok/img' . $i . '.png'); ?>" class="img-fluid w-100 rounded" alt="Event <?php echo $i; ?>">
                    </div>
                  </div>
                <?php endfor; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
