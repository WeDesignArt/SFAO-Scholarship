<?php
/**
 * Template Name: Calendar Page (Latest Build)
 * Mirrors calendar.html of the static site; empty ACF fields fall back to the static text.
 * Appreciation text: one paragraph per blank-line-separated block.
 *
 * @package UOK_SFAO
 */

get_header();

$banner_title = uok_field('calendar_banner_title', 'Calendar');
$banner_image = function_exists('get_field') ? get_field('calendar_banner_image') : null;
$ann_title    = uok_field('calendar_announcement_title', 'Scholarship Announcement 2026');
$ann_text     = uok_field('calendar_announcement_text', 'At the start of the new academic year, the University is pleased to open its annual scholarship cycle. These scholarships are designed to support deserving students, encourage academic excellence, and ensure equal access to quality education.');
$app_title    = uok_field('calendar_appreciation_title', 'Appreciation');
$app_text     = uok_field('calendar_appreciation_text', "The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the Honorable Vice Chancellor, University of Karachi, Dr. Khalid M. Iraqi, for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.\n\nWe are extremely thankful to all our scholarship donor organizations for empowering students through their generous support. Your dedication to fostering educational opportunities has transformed lives, enabling students to pursue their dreams without financial barriers. Thank you for shaping a brighter, more equitable future through your belief in the power of education.\n\nThe Student Financial Aid Office, University also expresses it's sincere thanks to our sponsors: Al Kauser and The University of Karachi Alumni Association Houston (UKAHA) for their invaluable support in making the 2025 e-calendar a reality.\n\nA special thanks to Bisma Binte Jaffer from the Department of Psychology, UoK, & Junaid Jamshaid Printing Department of Physics UoK, in Designing e Calendar, 2025");
?>

    <main role="main" class="home_content nav_space clearfix">

       <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
  
            <?php if (is_array($banner_image) && !empty($banner_image['url'])) : ?>
              <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_title); ?>" class="img-fluid w-100">
            <?php endif; ?>
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php echo esc_html($banner_title); ?></h1>
            </div>
  
          </div>
        </div>
      </section>

      <section class="ptb_80 bg_light_logo overflow-hidden calendar_section bg_f" style="background-image: url(<?php echo esc_url(uok_img('ku-logo.png')); ?>)">
        <div class="container_content">
          <section class="col-xl-9 col-lg-11 mx-auto">
            <section class="pt_60 text-center">
              <div class="section_intro mb_60 fw_md h4 col-lg-9 col-xl-8 mx-auto text-center aos-init aos-animate"
               >
                <h2 class="section_title h2 divider_heading center">
                  <?php echo esc_html($ann_title); ?>
                </h2>

                <div class="gray_7 d-inline-block" data-aos="fade-right">
                  <p><?php echo wp_kses_post($ann_text); ?></p>
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

      <section class="ptb_40 clearfix inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40" data-aos="fade-up">
                <h2 class="section_title h2 stories_heading divider_heading center"><?php echo esc_html($app_title); ?></h2>
              </div>
              <div data-aos="fade-left">
                <?php foreach (preg_split('/\R\s*\R/', trim($app_text)) as $para) : ?>
                <div class="gray_7">
                  <p><?php echo wp_kses_post(trim($para)); ?></p>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
