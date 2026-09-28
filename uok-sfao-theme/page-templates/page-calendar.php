<?php
/**
 * Template Name: Calendar Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields
$banner_title = function_exists('get_field') && get_field('calendar_banner_title', $post_id) ? get_field('calendar_banner_title', $post_id) : 'Calendar';
$banner_image = function_exists('get_field') ? get_field('calendar_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/calendar.jpg';

$ann_title = function_exists('get_field') && get_field('calendar_announcement_title', $post_id) ? get_field('calendar_announcement_title', $post_id) : 'Scholarship Announcement & Schedule ' . date('Y');
$ann_text = function_exists('get_field') && get_field('calendar_announcement_text', $post_id) ? get_field('calendar_announcement_text', $post_id) : 'At the start of the new academic year, the University is pleased to open its annual scholarship cycle. Check dates for forms, interviews, and result announcements below.';

$app_title = function_exists('get_field') && get_field('calendar_appreciation_title', $post_id) ? get_field('calendar_appreciation_title', $post_id) : 'Appreciation';
$app_text = function_exists('get_field') && get_field('calendar_appreciation_text', $post_id) ? get_field('calendar_appreciation_text', $post_id) : 'The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the leadership and our sponsors: Al Kauser and The University of Karachi Alumni Association Houston (UKAHA) for their invaluable support.';
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

      <!-- Calendar Container -->
      <section class="ptb_80 bg_light_logo overflow-hidden calendar_section bg_f" style="background-image: url(<?php echo esc_url($theme_uri . '/assets/images/ku-logo.png'); ?>)">
        <div class="container_content">
          <section class="col-xl-9 col-lg-11 mx-auto">
            <section class="pt_60 text-center">
              <div class="section_intro mb_60 fw_md h4 col-lg-9 col-xl-8 mx-auto text-center">
                <h2 class="section_title h2 divider_heading center">
                  <?php echo esc_html($ann_title); ?>
                </h2>

                <div class="gray_7 d-inline-block" data-aos="fade-right">
                  <p><?php echo esc_html($ann_text); ?></p>
                </div>
              </div>
            </section>

            <div class="card">
              <div class="card-body">
                <div id="calendar"></div>
              </div>
            </div>
          </section>
        </div>
      </section>

      <!-- Appreciation -->
      <section class="ptb_40 clearfix inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40" data-aos="fade-up">
                <h2 class="section_title h2 stories_heading divider_heading center"><?php echo esc_html($app_title); ?></h2>
              </div>
              <div data-aos="fade-left">
                <div class="gray_7">
                  <p><?php echo esc_html($app_text); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
