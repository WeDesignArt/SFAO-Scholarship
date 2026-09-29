<?php
/**
 * Template Name: Front Page Template (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();

// Hero Section Fields
$hero_img_desktop = function_exists('get_field') ? get_field('hero_image_desktop') : null;
$hero_img_desktop_url = ($hero_img_desktop && is_array($hero_img_desktop)) ? $hero_img_desktop['url'] : $theme_uri . '/assets/images/home-hero.jpg';

$hero_img_mobile = function_exists('get_field') ? get_field('hero_image_mobile') : null;
$hero_img_mobile_url = ($hero_img_mobile && is_array($hero_img_mobile)) ? $hero_img_mobile['url'] : $theme_uri . '/assets/images/home-hero-sm.jpg';

$hero_banner_text = function_exists('get_field') ? get_field('hero_banner_text') : 'Honorable VC Prof. Dr Khalid M. Iraqi University of Karachi, Respective Deans, Faculty Members, Esteemed Donar Organisations, Student Financial Aid Office Scholarship Students';

// About Section Fields
$about_title = function_exists('get_field') ? get_field('about_title') : 'Student Financial Aid Office, University of Karachi (SFAO)';
$about_desc = function_exists('get_field') ? get_field('about_description') : 'The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the <strong>Honorable Vice Chancellor, University of Karachi, Prof. Dr. Muhammad Tufail Jokhio,</strong> for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.';

// VC Message Fields
$vc_image = function_exists('get_field') ? get_field('vc_image') : null;
$vc_image_url = ($vc_image && is_array($vc_image)) ? $vc_image['url'] : $theme_uri . '/assets/images/pic-vc.jpg';
$vc_title = function_exists('get_field') ? get_field('vc_heading') : 'Message from Honorable Vice Chancellor';
$vc_name = function_exists('get_field') ? get_field('vc_name') : 'Prof. Dr. Muhammad Tufail';
$vc_message = function_exists('get_field') ? get_field('vc_message') : 'As the Vice Chancellor of the University of Karachi, I believe that one of the major challenges facing our student’s while pursing high quality education is the financial burden. Here I strongly advocate that the University of Karachi is actively minimizing tuition fees of meritorious students and making education accessible through freeship and need-based scholarships offered at SFAO.';

// Incharge Message Fields
$ic_image = function_exists('get_field') ? get_field('incharge_image') : null;
$ic_image_url = ($ic_image && is_array($ic_image)) ? $ic_image['url'] : $theme_uri . '/assets/images/pic-ic.jpg';
$ic_title = function_exists('get_field') ? get_field('incharge_heading') : 'Message from Student Financial Aid Office (SFAO) In charge';
$ic_name = function_exists('get_field') ? get_field('incharge_name') : 'Prof. Dr. Ziasma Haneef Khan';
$ic_message = function_exists('get_field') ? get_field('incharge_message') : 'The SFAO serves as a crucial bridge, connecting bright and deserving students with generous national and international donor organizations. Our mission is to ensure that financial support empowers students to achieve their academic dreams.';
?>

    <main role="main" class="home_content nav_space clearfix">

      <!-- Hero Slider -->
      <section class="home_hero_slider hero-font">
        <div class="container_content">
          <div class="hero_wrapper">
            <picture>
              <source media="(max-width: 767.98px)" srcset="<?php echo esc_url($hero_img_mobile_url); ?>" />
              <img src="<?php echo esc_url($hero_img_desktop_url); ?>" alt="<?php bloginfo('name'); ?>" class="w-100 d-block" />
            </picture>
          </div>

          <?php if (!empty($hero_banner_text)): ?>
          <div class="image-divider">
            <div class="text-divider">
              <div class="text-center py-3">
                <p class="mb-0 text-white">
                  <?php echo esc_html($hero_banner_text); ?>
                </p>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </section>

      <!-- News Ticker Bar -->
      <div class="sfao-ticker-bar">
        <div class="sfao-ticker-label">
          <span>&#128227;</span> <?php esc_html_e('SFAO News', 'uok-sfao'); ?>
        </div>
        <div class="sfao-ticker-track-wrapper">
          <div class="sfao-ticker-track">
            <?php
              $ticker_items = function_exists('get_field') ? get_field('ticker_items', 'option') : null;
              if (!empty($ticker_items) && is_array($ticker_items)) :
                foreach ($ticker_items as $t_item) :
            ?>
              <span class="sfao-ticker-item"><?php echo wp_kses_post($t_item['ticker_text']); ?></span>
              <span class="sfao-ticker-sep">&#9679;</span>
            <?php 
                endforeach;
              else :
            ?>
              <span class="sfao-ticker-item">&#127881; Congratulations to all Mitsubishi UFJ Foundation Scholarship 2025&#8211;26 awardees &mdash; Selected candidates list is now available.</span>
              <span class="sfao-ticker-sep">&#9679;</span>
              <span class="sfao-ticker-item">HEC Need-Based Scholarship 2025&#8211;26 &mdash; Applications closed. Notification process is underway.</span>
              <span class="sfao-ticker-sep">&#9679;</span>
              <span class="sfao-ticker-item">&#128994; Ihsan Trust Qarz-e-Hasna (Interest-Free Loan) &mdash; Applications accepted <strong>year round</strong> for Morning &amp; Evening program students.</span>
              <span class="sfao-ticker-sep">&#9679;</span>
              <span class="sfao-ticker-item">Balochistan Education Endowment Fund (BEEF) Scholarship &mdash; Announcement coming soon. Stay updated.</span>
              <span class="sfao-ticker-sep">&#9679;</span>
              <span class="sfao-ticker-item">&#128241; For all scholarship updates follow SFAO on KU Times Facebook &amp; WhatsApp Channel &mdash; sfao@uok.edu.pk</span>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- About Home Section -->
      <section class="ptb_80 clearfix inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40">
                <h2 class="section_title h2 divider_heading center">
                  <?php echo esc_html($about_title); ?>
                </h2>
              </div>
              <div class="gray_7">
                <p><?php echo wp_kses_post($about_desc); ?></p>
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
              <div class="section_image">
                <img src="<?php echo esc_url($vc_image_url); ?>" alt="<?php echo esc_attr($vc_name); ?>" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-right">
                <h2 class="section_content_title divider_heading align-sm-center h2">
                  <?php echo esc_html($vc_title); ?>
                </h2>

                <div class="sub_title h4 my-4 text-cen primary_color">
                  <?php echo esc_html($vc_name); ?>
                </div>

                <div class="gray_7 section_para">
                  <?php echo wpautop(wp_kses_post($vc_message)); ?>
                </div>
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
              <div class="section_image pt-5 pt-md-0">
                <img src="<?php echo esc_url($ic_image_url); ?>" alt="<?php echo esc_attr($ic_name); ?>" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-left">
                <h2 class="section_content_title divider_heading align-sm-center h2">
                  <?php echo esc_html($ic_title); ?>
                </h2>

                <div class="sub_title h4 my-4 text-cen primary_color">
                  <?php echo esc_html($ic_name); ?>
                </div>

                <div class="gray_7 section_para">
                  <?php echo wpautop(wp_kses_post($ic_message)); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Scholarships Section -->
      <section class="ptb_40 clearfix overflow-hidden bg_light_logo">
        <div class="container_content">
          <section class="pt_60 text-center">
            <div class="section_intro mb_60 fw_md h4 col-lg-9 col-xl-8 mx-auto text-center" data-aos="fade-left">
              <h2 class="section_title h2 divider_heading center">
                <?php esc_html_e('Scholarship Opportunities', 'uok-sfao'); ?>
              </h2>
              <div class="gray_7 col-lg-12 d-inline-block">
                <p>
                  <?php esc_html_e('Since 2006, the University has grown student support from Rs. 6 million to over Rs. 200 million, benefiting 2,000+ students through merit and need-based aid.', 'uok-sfao'); ?>
                </p>
              </div>
            </div>
          </section>

          <div class="col-xl-10 col-lg-11 mx-auto">
            <div class="scholarship_cards_container">
              <div class="row g-4 ps-2 ps-lg-0">
                <?php
                  $scholarships_query = new WP_Query(array(
                    'post_type'      => 'scholarship',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                  ));

                  if ($scholarships_query->have_posts()) :
                    while ($scholarships_query->have_posts()) : $scholarships_query->the_post();
                      $status = function_exists('get_field') ? get_field('scholarship_status') : 'Open';
                      $btn_class = (strtolower($status) === 'closed') ? 'btn-apply-closed' : '';
                ?>
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="icon_box_single bordered round_xl" data-aos="fade-up">
                      <div class="icon_box_single_header">
                        <h2 class="icon_box_single_header_title">
                          <a href="<?php the_permalink(); ?>" class="text-reset text-decoration-none"><?php the_title(); ?></a>
                        </h2>
                      </div>
                      <div class="icon_box_single_footer">
                        <a href="<?php the_permalink(); ?>" class="btn btn_fill round_xl <?php echo esc_attr($btn_class); ?>">
                          <?php echo (strtolower($status) === 'closed') ? esc_html__('Applications Closed', 'uok-sfao') : esc_html__('Apply Now', 'uok-sfao'); ?>
                        </a>
                      </div>
                    </div>
                  </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                  else :
                ?>
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="icon_box_single bordered round_xl" data-aos="fade-up">
                      <div class="icon_box_single_header">
                        <h2 class="icon_box_single_header_title">University of Karachi Alumni Association Houston USA (UKAHA)</h2>
                      </div>
                      <div class="icon_box_single_footer">
                        <a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>" class="btn btn_fill round_xl btn-apply-closed">Applications Closed</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="icon_box_single bordered round_xl" data-aos="fade-up">
                      <div class="icon_box_single_header">
                        <h2 class="icon_box_single_header_title">University of Karachi Alumni Association (UKAA), Baltimore</h2>
                      </div>
                      <div class="icon_box_single_footer">
                        <a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>" class="btn btn_fill round_xl btn-apply-closed">Applications Closed</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="icon_box_single bordered round_xl" data-aos="fade-up">
                      <div class="icon_box_single_header">
                        <h2 class="icon_box_single_header_title">Sindh HEC Indigenous Scholarships (for M.Phil & Ph.D.)</h2>
                      </div>
                      <div class="icon_box_single_footer">
                        <a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>" class="btn btn_fill round_xl btn-apply-closed">Applications Closed</a>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <div class="seemore mt-4 text-center" data-aos="fade-up">
                <a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>" class="btn btn_fill round_full">
                  <?php esc_html_e('See More Scholarships', 'uok-sfao'); ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Awardees Section -->
      <section class="sfao-awardees-section ptb_80 overflow-hidden">
        <div class="container">
          <div class="section_intro mb_40 text-center" data-aos="fade-up">
            <h2 class="section_title h2 divider_heading center">
              <?php esc_html_e('Scholarship Awardees', 'uok-sfao'); ?>
            </h2>
            <p class="gray_7 col-lg-7 mx-auto">
              <?php esc_html_e('SFAO proudly congratulates the students selected for the Scholarships. Your dedication and hard work have earned this recognition.', 'uok-sfao'); ?>
            </p>
          </div>

          <div class="row g-4 justify-content-center" data-aos="fade-up">
            <?php
              $awardees_query = new WP_Query(array(
                'post_type'      => 'awardee',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
              ));

              if ($awardees_query->have_posts()) :
                while ($awardees_query->have_posts()) : $awardees_query->the_post();
                  $aw_initials = function_exists('get_field') ? get_field('awardee_initials') : 'AK';
                  $aw_scholarship = function_exists('get_field') ? get_field('awardee_program') : 'Mitsubishi UFJ Foundation';
            ?>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-card">
                  <div class="awardee-avatar"><?php echo esc_html($aw_initials ?: substr(get_the_title(), 0, 2)); ?></div>
                  <div class="awardee-name"><?php the_title(); ?></div>
                  <div class="awardee-scholarship"><?php echo esc_html($aw_scholarship); ?></div>
                  <div class="awardee-badge"><?php esc_html_e('Congratulations!', 'uok-sfao'); ?></div>
                </div>
              </div>
            <?php 
                endwhile;
                wp_reset_postdata();
              else :
            ?>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-card">
                  <div class="awardee-avatar">AK</div>
                  <div class="awardee-name">Ahmed Khan</div>
                  <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                  <div class="awardee-badge">Congratulations!</div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-card">
                  <div class="awardee-avatar">SF</div>
                  <div class="awardee-name">Sara Fatima</div>
                  <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                  <div class="awardee-badge">Congratulations!</div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-card">
                  <div class="awardee-avatar">MH</div>
                  <div class="awardee-name">Muhammad Hassan</div>
                  <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                  <div class="awardee-badge">Congratulations!</div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-card">
                  <div class="awardee-avatar">FN</div>
                  <div class="awardee-name">Fatima Noor</div>
                  <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                  <div class="awardee-badge">Congratulations!</div>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <div class="seemore mt-4 text-center" data-aos="fade-up">
            <a href="<?php echo esc_url(home_url('/awardees')); ?>" class="btn btn_fill round_full"><?php esc_html_e('See All Awardees', 'uok-sfao'); ?></a>
          </div>
        </div>
      </section>

      <!-- Process of our Programs (ACF Repeater) -->
      <section class="ptb_80 clearfix overflow-hidden">
        <div class="container_content">
          <section class="col-xl-10 col-lg-11 mx-auto">
            <div class="section_intro fw_md h4 mb_80" data-aos="fade-left">
              <div class="row g-4 justify-content-between align-items-center">
                <div class="col-lg-8">
                  <h2 class="section_title h2 process-heading center-divider stories_heading divider_heading">
                    <?php echo esc_html(function_exists('get_field') ? get_field('process_section_title') : 'Process of our Programs'); ?>
                  </h2>
                  <div class="gray_7 text-cen col-lg-9 d-inline-block">
                    <p><?php echo esc_html(function_exists('get_field') ? get_field('process_section_desc') : 'Step-by-step guidance on how to explore, apply, and secure financial assistance.'); ?></p>
                  </div>
                </div>
                <div class="col-lg-4 text-lg-end text-center">
                  <a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>" class="btn btn_fill round_full"><?php esc_html_e('Read More', 'uok-sfao'); ?></a>
                </div>
              </div>
            </div>

            <div class="row g-4" data-aos="fade-up">
              <?php if (function_exists('have_rows') && have_rows('process_steps')) : ?>
                <?php while (have_rows('process_steps')) : the_row(); 
                  $step_img = get_sub_field('step_image');
                  $step_img_url = ($step_img && is_array($step_img)) ? $step_img['url'] : $theme_uri . '/assets/images/process-1.jpg';
                  $step_title = get_sub_field('step_title');
                  $step_desc = get_sub_field('step_description');
                  $step_link = get_sub_field('step_link') ?: '#';
                ?>
                  <div class="col-lg-4">
                    <div class="info_card_single info_shadow">
                      <div class="info_card_single_media">
                        <a href="<?php echo esc_url($step_link); ?>">
                          <img src="<?php echo esc_url($step_img_url); ?>" alt="<?php echo esc_attr($step_title); ?>" />
                        </a>
                      </div>
                      <div class="info_card_single_content">
                        <h4 class="info_card_single_content_title"><?php echo esc_html($step_title); ?></h4>
                        <p><?php echo esc_html($step_desc); ?></p>
                        <a href="<?php echo esc_url($step_link); ?>" class="btn btn-link">
                          <?php esc_html_e('Learn more', 'uok-sfao'); ?> <i class="bi bi-arrow-right-short"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else : ?>
                <div class="col-lg-4">
                  <div class="info_card_single info_shadow">
                    <div class="info_card_single_media">
                      <a href="javascript:void(0);"><img src="<?php echo esc_url($theme_uri . '/assets/images/process-1.jpg'); ?>" alt="Plan Your Studies" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title">Plan Your Studies</h4>
                      <p>Check available morning degree programmes, eligibility requirements, and merit thresholds.</p>
                      <a href="javascript:void(0);" class="btn btn-link"><?php esc_html_e('Learn more', 'uok-sfao'); ?> <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="info_card_single info_shadow">
                    <div class="info_card_single_media">
                      <a href="javascript:void(0);"><img src="<?php echo esc_url($theme_uri . '/assets/images/process-2.jpg'); ?>" alt="Scholarships & Funding" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title">Scholarships & Funding</h4>
                      <p>Apply for Need-cum-Merit, HEC, or Alumni funded scholarships with required documentation.</p>
                      <a href="javascript:void(0);" class="btn btn-link"><?php esc_html_e('Learn more', 'uok-sfao'); ?> <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="info_card_single info_shadow">
                    <div class="info_card_single_media">
                      <a href="javascript:void(0);"><img src="<?php echo esc_url($theme_uri . '/assets/images/process-3.jpg'); ?>" alt="Universities" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title">Award & Disbursement</h4>
                      <p>Shortlisted candidates undergo verification and interview rounds before fund disbursements.</p>
                      <a href="javascript:void(0);" class="btn btn-link"><?php esc_html_e('Learn more', 'uok-sfao'); ?> <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </section>
        </div>
      </section>

      <!-- Appreciation Section -->
      <?php
        $app_title = function_exists('get_field') && get_field('appreciation_heading') ? get_field('appreciation_heading') : 'Appreciation';
      ?>
      <section class="ptb_40 clearfix sfao_appreciation inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40" data-aos="fade-up">
                <h2 class="section_title h2 stories_heading divider_heading center">
                  <?php echo esc_html($app_title); ?>
                </h2>
              </div>

              <div data-aos="fade-right">
                <?php 
                  $app_full = function_exists('get_field') ? get_field('appreciation_text') : '';
                  if (!empty($app_full)) :
                ?>
                  <div class="gray_7">
                    <?php echo wpautop(wp_kses_post($app_full)); ?>
                  </div>
                <?php elseif (function_exists('have_rows') && have_rows('appreciation_paragraphs')) : ?>
                  <?php while (have_rows('appreciation_paragraphs')) : the_row(); ?>
                    <div class="gray_7">
                      <?php echo wpautop(wp_kses_post(get_sub_field('paragraph_text'))); ?>
                    </div>
                  <?php endwhile; ?>
                <?php else : ?>
                  <div class="gray_7">
                    <p><?php esc_html_e('The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the Honorable Vice Chancellor, University of Karachi, Prof. Dr. Muhammad Tufail Jokhio, for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.', 'uok-sfao'); ?></p>
                  </div>
                  <div class="gray_7">
                    <p><?php esc_html_e('We are extremely thankful to all our scholarship donor organizations for empowering students through their generous support. Your dedication to fostering educational opportunities has transformed lives, enabling students to pursue their dreams without financial barriers. Thank you for shaping a brighter, more equitable future through your belief in the power of education.', 'uok-sfao'); ?></p>
                  </div>
                  <div class="gray_7">
                    <p><?php esc_html_e('SFAO extends its heartfelt gratitude to IO Digital for their exceptional creative partnership. Designed with absolute precision, this beautiful space has been crafted to best serve the evolving needs of our vibrant community. We sincerely appreciate their dedication to bringing this vision to life, ensuring a seamless and inspiring experience for everyone who visits.', 'uok-sfao'); ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SFAO Events Collage (ACF Gallery) -->
      <section class="sfao-events-section overflow-hidden color-limegreeen">
        <div class="container">
          <div class="text-sfao-events" data-aos="fade-up">
            <h2 class="section_title h2 divider_heading center text-center">
              <?php echo esc_html(function_exists('get_field') ? get_field('events_section_title') : 'SFAO Events'); ?>
            </h2>
          </div>
          <div class="image-collage">
            <div class="row" data-aos="fade-left">
              <?php
                $events_gallery = function_exists('get_field') ? get_field('sfao_events_gallery') : null;
                if (!empty($events_gallery) && is_array($events_gallery)) :
                  foreach ($events_gallery as $img) :
              ?>
                <div class="col-md-4">
                  <div class="image-box">
                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?: 'SFAO Event'); ?>" class="img-fluid w-100">
                  </div>
                </div>
              <?php 
                  endforeach;
                else :
                  for ($i = 1; $i <= 9; $i++) :
              ?>
                <div class="col-md-4">
                  <div class="image-box">
                    <img src="<?php echo esc_url($theme_uri . '/assets/images/uok/img' . $i . '.png'); ?>" class="img-fluid w-100" alt="Event <?php echo $i; ?>">
                  </div>
                </div>
              <?php 
                  endfor;
                endif; 
              ?>
            </div>
          </div>
          <div class="seemore" data-aos="fade-up">
            <a href="<?php echo esc_url(home_url('/events')); ?>" class="btn btn_fill round_full"><?php esc_html_e('See More Events', 'uok-sfao'); ?></a>
          </div>
        </div>
      </section>

      <!-- FAQs Accordion (ACF Repeater) -->
      <section class="section section_content_left clearfix overflow-hidden ptb_60" id="faq">
        <div class="container_content">
          <div class="row align-items-center">
            <div class="col-lg-5 order-md-2" data-aos="fade-left">
              <div class="section_image custom-size">
                <img src="<?php echo esc_url($theme_uri . '/assets/images/dpa.jpg'); ?>" alt="FAQs" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-right">
                <h2 class="section_content_title divider_heading h2">
                  <?php echo esc_html(function_exists('get_field') ? get_field('faq_section_title') : 'Frequently Asked Questions (FAQs) for University Scholarships'); ?>
                </h2>

                <div class="gray_7">
                  <p><?php echo esc_html(function_exists('get_field') ? get_field('faq_section_subtitle') : 'Find quick answers regarding scholarship quotas, award amounts, eligibility criteria, and interview dates.'); ?></p>
                </div>

                <article class="faq_accord">
                  <?php if (function_exists('have_rows') && have_rows('faq_items')) : ?>
                    <?php $faq_idx = 0; while (have_rows('faq_items')) : the_row(); $faq_idx++; ?>
                      <div class="faq_single">
                        <h5 class="faq_single_title btn_faq <?php echo ($faq_idx === 1) ? 'active' : ''; ?>">
                          <span><?php echo esc_html(get_sub_field('faq_question')); ?></span>
                          <i class="bi bi-plus-lg"></i>
                        </h5>
                        <div class="faq_single_content">
                          <?php echo wp_kses_post(get_sub_field('faq_answer')); ?>
                        </div>
                      </div>
                    <?php endwhile; ?>
                  <?php else : ?>
                    <div class="faq_single">
                      <h5 class="faq_single_title btn_faq active">
                        <span>How many scholarship slots are available, and what is the award amount for Sindh HEC indigenous?</span>
                        <i class="bi bi-plus-lg"></i>
                      </h5>
                      <div class="faq_single_content">
                        63 scholarship slots are provided in 2023-24. Each successful candidate is rewarded Rs. 230,000.
                      </div>
                    </div>
                    <div class="faq_single">
                      <h5 class="faq_single_title btn_faq">
                        <span>How long is the HEC need-based scholarship duration, and what is the award amount?</span>
                        <i class="bi bi-plus-lg"></i>
                      </h5>
                      <div class="faq_single_content">
                        The scholarship covers the full duration of the standard degree program, subject to maintaining satisfactory academic standing.
                      </div>
                    </div>
                    <div class="faq_single">
                      <h5 class="faq_single_title btn_faq">
                        <span>Which departments/faculties are eligible for the Bismillah Bibi & Mrs. Talat Jamil Scholarship?</span>
                        <i class="bi bi-plus-lg"></i>
                      </h5>
                      <div class="faq_single_content">
                        Regular students enrolled in the designated Science and Arts faculties in the morning program.
                      </div>
                    </div>
                    <div class="faq_single">
                      <h5 class="faq_single_title btn_faq">
                        <span>Where can I find details about the scholarship interview, including time and venue?</span>
                        <i class="bi bi-plus-lg"></i>
                      </h5>
                      <div class="faq_single_content">
                        Interview schedules are posted on the SFAO Notice Board, Room #4, Ground Floor, Old Administration Building.
                      </div>
                    </div>
                  <?php endif; ?>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
