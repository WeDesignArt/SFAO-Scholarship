<?php
/**
 * Template Name: About Us Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields with Defaults
$banner_title = function_exists('get_field') && get_field('about_banner_title', $post_id) ? get_field('about_banner_title', $post_id) : 'About Us';
$banner_image = function_exists('get_field') ? get_field('about_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/about-us.jpg';

// Intro Section
$intro_title = function_exists('get_field') && get_field('about_intro_title', $post_id) ? get_field('about_intro_title', $post_id) : 'Student Financial Aid Office, University of Karachi (SFAO)';
$intro_desc = function_exists('get_field') && get_field('about_intro_desc', $post_id) ? get_field('about_intro_desc', $post_id) : 'The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the Honorable Vice Chancellor, University of Karachi, for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.';

// VC Message
$vc_heading = function_exists('get_field') && get_field('about_vc_heading', $post_id) ? get_field('about_vc_heading', $post_id) : 'Message from Honorable Vice Chancellor';
$vc_name = function_exists('get_field') && get_field('about_vc_name', $post_id) ? get_field('about_vc_name', $post_id) : 'Prof. Dr. Muhammad Tufail';
$vc_image = function_exists('get_field') ? get_field('about_vc_image', $post_id) : null;
$vc_image_url = ($vc_image && is_array($vc_image)) ? $vc_image['url'] : $theme_uri . '/assets/images/pic-vc.jpg';
$vc_message = function_exists('get_field') && get_field('about_vc_message', $post_id) ? get_field('about_vc_message', $post_id) : 'As the Vice Chancellor of the University of Karachi, I believe that one of the major challenges facing our student’s while pursing high quality education is the financial burden. Here I strongly advocate that the University of Karachi is actively minimizing tuition fees of meritorious students and making education accessible through freeship and need-based scholarships offered at SFAO.';

// Incharge Message
$ic_heading = function_exists('get_field') && get_field('about_ic_heading', $post_id) ? get_field('about_ic_heading', $post_id) : 'Message from Student Financial Aid Office (SFAO) In charge';
$ic_name = function_exists('get_field') && get_field('about_ic_name', $post_id) ? get_field('about_ic_name', $post_id) : 'Prof. Dr. Ziasma Haneef Khan';
$ic_image = function_exists('get_field') ? get_field('about_ic_image', $post_id) : null;
$ic_image_url = ($ic_image && is_array($ic_image)) ? $ic_image['url'] : $theme_uri . '/assets/images/pic-ic.jpg';
$ic_message = function_exists('get_field') && get_field('about_ic_message', $post_id) ? get_field('about_ic_message', $post_id) : 'The SFAO serves as a crucial bridge, connecting bright and deserving students with generous national and international donor organizations. Our mission is to ensure that financial support empowers students to achieve their academic dreams.';

// Appreciation Section
$app_title = function_exists('get_field') && get_field('about_appreciation_title', $post_id) ? get_field('about_appreciation_title', $post_id) : 'Appreciation';
?>

    <main role="main" class="home_content nav_space clearfix">

      <!-- Hero Banner -->
      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url($banner_image_url); ?>" alt="<?php echo esc_attr($banner_title); ?>" class="img-fluid w-100 d-block">
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php echo esc_html($banner_title); ?></h1>
            </div>
          </div>
        </div>
      </section>

      <!-- About Intro -->
      <section class="ptb_80 clearfix inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40">
                <h2 class="section_title h2 divider_heading center">
                  <?php echo esc_html($intro_title); ?>
                </h2>
              </div>
              <div class="gray_7">
                <?php echo wp_kses_post($intro_desc); ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- VC Message -->
      <section class="section section_content_left clearfix overflow-hidden ptb_40">
        <div class="container_content bg_light_logo">
          <div class="row align-items-center">
            <div class="col-lg-5 order-md-2" data-aos="fade-left">
              <div class="section_image"><img src="<?php echo esc_url($vc_image_url); ?>" alt="<?php echo esc_attr($vc_name); ?>" /></div>
            </div>
            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-right">
                <h2 class="section_content_title divider_heading align-sm-center h2"><?php echo esc_html($vc_heading); ?></h2>
                <div class="sub_title h4 my-4 text-cen primary_color"><?php echo esc_html($vc_name); ?></div>
                <div class="gray_7 section_para"><p><?php echo wp_kses_post($vc_message); ?></p></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Incharge Message -->
      <section class="section section_content_right clearfix overflow-hidden ptb_40">
        <div class="container_content">
          <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
              <div class="section_image pt-5 pt-md-0"><img src="<?php echo esc_url($ic_image_url); ?>" alt="<?php echo esc_attr($ic_name); ?>" /></div>
            </div>
            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-left">
                <h2 class="section_content_title divider_heading align-sm-center h2"><?php echo esc_html($ic_heading); ?></h2>
                <div class="sub_title h4 my-4 text-cen primary_color"><?php echo esc_html($ic_name); ?></div>
                <div class="gray_7 section_para"><p><?php echo wp_kses_post($ic_message); ?></p></div>
              </div>
            </div>
          </div>
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
                <?php if (function_exists('have_rows') && have_rows('about_appreciation_paragraphs', $post_id)) : ?>
                  <?php while (have_rows('about_appreciation_paragraphs', $post_id)) : the_row(); ?>
                    <div class="gray_7">
                      <?php echo wpautop(wp_kses_post(get_sub_field('paragraph_text'))); ?>
                    </div>
                  <?php endwhile; ?>
                <?php else : ?>
                  <div class="gray_7">
                    <p><?php esc_html_e('The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the Honorable Vice Chancellor, University of Karachi, for his steadfast support and visionary leadership.', 'uok-sfao'); ?></p>
                  </div>
                  <div class="gray_7">
                    <p><?php esc_html_e('We are extremely thankful to all our scholarship donor organizations for empowering students through their generous support. Your dedication to fostering educational opportunities has transformed lives, enabling students to pursue their dreams without financial barriers.', 'uok-sfao'); ?></p>
                  </div>
                  <div class="gray_7">
                    <p><?php esc_html_e('SFAO extends its heartfelt gratitude to our creative partners and alumni networks for their exceptional partnership.', 'uok-sfao'); ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
