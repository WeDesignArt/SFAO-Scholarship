<?php
/**
 * Template Name: Events Page (Latest Build)
 * Mirrors events.html of the static site; empty ACF fields fall back to the static text.
 * "Events Gallery" replaces the 2026 photos; the 2024 photos are fixed.
 *
 * @package UOK_SFAO
 */

get_header();

$banner_title  = uok_field('events_banner_title', 'Events');
$banner_image  = function_exists('get_field') ? get_field('events_banner_image') : null;
$main_title    = uok_field('events_main_title', 'Student Financial Aid Office, University of Karachi (SFAO)');
$main_subtitle = uok_field('events_main_subtitle', 'The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the <strong>Honorable Vice Chancellor, University of Karachi, Dr. Khalid M. Iraqi,</strong> for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.');
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
   <section class="ptb_80 clearfix inner_about color-limegreeen overflow-hidden">
    <div class="container">
     <div class="row g-0 justify-content-center">
      <div class="col-11 text-center">
       <div class="section_intro m-13 m-lg-15 mb_40">
        <h2 class="section_title h2 divider_heading center"><?php echo esc_html($main_title); ?></h2>
       </div>
       <div class="gray_7">
        <p><?php echo wp_kses_post($main_subtitle); ?>
        </p>
       </div>
      </div>
     </div>
    </div>
   </section>

   <section class="sfao-events-section overflow-hidden ptb_80">
    <div class="container">
     <div class="text-sfao-events" data-aos="fade-up">
      <h2 class="section_title h2 divider_heading center text-center">
       SFAO Events 2026
      </h2>
     </div>
       <div class="image-collage">
            <div class="row" data-aos="fade-left">
              <?php
                $gallery = uok_field('events_gallery', array());
                $urls = array();
                foreach ((array) $gallery as $img) { if (!empty($img['url'])) $urls[] = $img['url']; }
                if (empty($urls)) {
                  foreach (array('uok/events-26/sfao-events-26-1.png', 'uok/events-26/sfao-events-26-2.png', 'uok/events-26/sfao-events-26-3.jpeg', 'uok/events-26/sfao-events-26-4.png', 'uok/events-26/sfao-events-26-5.jpeg') as $file) $urls[] = uok_img($file);
                }
                foreach ($urls as $url) :
              ?>
              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url($url); ?>" class="img-fluid w-100">
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
     
    </div>
   </section>

   <section class="sfao-events-section overflow-hidden ptb_80">
    <div class="container">
     <div class="text-sfao-events" data-aos="fade-up">
      <h2 class="section_title h2 divider_heading center text-center">
       SFAO Events 2024
      </h2>
     </div>
     <div class="image-collage">
      <div class="row" data-aos="fade-left">

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img1.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img2.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img3.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img4.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img5.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img6.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img7.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img8.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

       <div class="col-md-4">
        <div class="image-box">
         <img src="<?php echo esc_url(uok_img('uok/img9.png')); ?>" class="img-fluid w-100">
        </div>
       </div>

      </div>
     </div>
     
    </div>
   </section>

  </main>

<?php
get_footer();
