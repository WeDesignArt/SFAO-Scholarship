<?php
/**
 * Template Name: Stories Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields
$banner_title = function_exists('get_field') && get_field('stories_banner_title', $post_id) ? get_field('stories_banner_title', $post_id) : 'Stories';
$banner_image = function_exists('get_field') ? get_field('stories_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/stories.jpg';

$heading = function_exists('get_field') && get_field('stories_heading', $post_id) ? get_field('stories_heading', $post_id) : 'Student Success Stories';
$subheading = function_exists('get_field') && get_field('stories_subheading', $post_id) ? get_field('stories_subheading', $post_id) : 'Read how financial aid transformed the academic journey of students at University of Karachi.';
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

      <!-- Stories Cards Grid -->
      <section class="ptb_80 clearfix overflow-hidden">
        <div class="container_content">
          <section class="col-xl-10 col-lg-11 mx-auto">
            <div class="section_intro fw_md h4 mb_40" data-aos="fade-left">
              <div class="row g-4 justify-content-between align-items-center">
                <div class="col-lg-8">
                  <h2 class="section_title h2 stories_heading divider_heading">
                    <?php echo esc_html($heading); ?>
                  </h2>
                  <div class="gray_7 col-lg-9 d-inline-block">
                    <p><?php echo esc_html($subheading); ?></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-4">
              <?php
                $stories = new WP_Query(array(
                  'post_type'      => 'student_story',
                  'posts_per_page' => 12,
                  'post_status'    => 'publish',
                ));

                if ($stories->have_posts()) :
                  while ($stories->have_posts()) : $stories->the_post();
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'story-thumb') ?: $theme_uri . '/assets/images/story-1.jpg';
              ?>
                <div class="col-md-4">
                  <div class="info_card_single" data-aos="fade-up">
                    <div class="info_card_single_media">
                      <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title"><?php the_title(); ?></h4>
                      <div class="text-muted small mb-2"><?php the_excerpt(); ?></div>
                      <a href="<?php the_permalink(); ?>" class="btn btn-link"><?php esc_html_e('Learn more', 'uok-sfao'); ?> <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
              <?php
                  endwhile;
                  wp_reset_postdata();
                else :
              ?>
                <div class="col-md-4">
                  <div class="info_card_single" data-aos="fade-up">
                    <div class="info_card_single_media">
                      <a href="#"><img src="<?php echo esc_url($theme_uri . '/assets/images/story-1.jpg'); ?>" alt="Story" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title">Bilal Shaikh Bachelor’s & Master’s Scholarship</h4>
                      <p>Overcoming economic hurdles to secure top position in Computer Science.</p>
                      <a href="#" class="btn btn-link">Learn more <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info_card_single" data-aos="fade-up">
                    <div class="info_card_single_media">
                      <a href="#"><img src="<?php echo esc_url($theme_uri . '/assets/images/story-2.jpg'); ?>" alt="Story" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title">Ali & Sidra Bachelor’s Scholarship</h4>
                      <p>Supported throughout their 4-year undergraduate degree program.</p>
                      <a href="#" class="btn btn-link">Learn more <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info_card_single" data-aos="fade-up">
                    <div class="info_card_single_media">
                      <a href="#"><img src="<?php echo esc_url($theme_uri . '/assets/images/story-3.jpg'); ?>" alt="Story" /></a>
                    </div>
                    <div class="info_card_single_content">
                      <h4 class="info_card_single_content_title">Sameera Iqbal Master’s Scholarship</h4>
                      <p>Empowered to pursue postgraduate research in Biotechnology.</p>
                      <a href="#" class="btn btn-link">Learn more <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </section>
        </div>
      </section>

    </main>

<?php
get_footer();
