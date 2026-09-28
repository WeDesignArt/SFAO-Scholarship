<?php
/**
 * The template for displaying single Scholarship post (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();

while (have_posts()) : the_post();
  $post_id = get_the_ID();

  $amount = function_exists('get_field') ? get_field('scholarship_amount', $post_id) : '500,000';
  $deadline = function_exists('get_field') ? get_field('scholarship_deadline', $post_id) : '';
  $status = function_exists('get_field') ? get_field('scholarship_status', $post_id) : 'Open';
  $apply_url = function_exists('get_field') ? get_field('scholarship_apply_url', $post_id) : '#';
  $video_url = function_exists('get_field') ? get_field('scholarship_video_url', $post_id) : '';
  $important_info = function_exists('get_field') ? get_field('important_info', $post_id) : '';
  $intro_gallery = function_exists('get_field') ? get_field('scholarship_intro_gallery', $post_id) : null;
  $awards_gallery = function_exists('get_field') ? get_field('previous_awards_gallery', $post_id) : null;
?>

    <main role="main" class="home_content nav_space clearfix">

      <!-- Hero Banner -->
      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url($theme_uri . '/assets/images/uok/scholarship-bg.jpg'); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid w-100">
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php the_title(); ?></h1>
            </div>
          </div>
        </div>
      </section>

      <!-- Breadcrumbs -->
      <section class="section-2 overflow-hidden">
        <div class="container">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'uok-sfao'); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>"><?php esc_html_e('Scholarships', 'uok-sfao'); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
            </ol>
          </nav>
        </div>
      </section>

      <!-- Dropdown Quick Switcher -->
      <section class="section-3">
        <div class="container my-4">
          <h2 class="fw-bold mb-2"><?php the_title(); ?></h2>
          <p class="mb-4"><?php esc_html_e('Manage and view detailed scholarship criteria, notifications, and application guidelines.', 'uok-sfao'); ?></p>

          <h5 class="fw-semibold mb-3"><?php esc_html_e('Switch Scholarship', 'uok-sfao'); ?></h5>

          <div class="dropdown w-100">
            <button class="btn pill-dropdown dropdown-toggle d-flex justify-content-between align-items-center w-100 scholarship-btn" type="button" data-bs-toggle="dropdown">
              <span class="scholarship-text"><?php the_title(); ?></span>
              <i class="bi bi-chevron-down ms-2 flex-shrink-0"></i>
            </button>
            <ul class="dropdown-menu w-100">
              <?php
                $all_scholarships = get_posts(array(
                  'post_type'      => 'scholarship',
                  'posts_per_page' => 30,
                  'post_status'    => 'publish',
                  'exclude'        => array($post_id),
                ));
                if (!empty($all_scholarships)) :
                  foreach ($all_scholarships as $item) :
              ?>
                <li><a class="dropdown-item" href="<?php echo esc_url(get_permalink($item->ID)); ?>"><?php echo esc_html($item->post_title); ?></a></li>
              <?php 
                  endforeach;
                else :
              ?>
                <li><a class="dropdown-item" href="#"><?php esc_html_e('No other scholarships found', 'uok-sfao'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </section>

      <!-- Tabs Section -->
      <section class="section-4 overflow-hidden ptb_80">
        <div class="container">

          <!-- Desktop Tabs -->
          <div class="d-none d-md-block">
            <ul class="nav nav-tabs custom-tabs gap-5 mb-4" role="tablist">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-intro">
                  <i class="bi bi-file-earmark-text-fill"></i> <?php esc_html_e('Introduction', 'uok-sfao'); ?>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-notify">
                  <i class="bi bi-bell-fill"></i> <?php esc_html_e('Notifications', 'uok-sfao'); ?>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-video">
                  <i class="bi bi-camera-video-fill"></i> <?php esc_html_e('Video', 'uok-sfao'); ?>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-awards">
                  <i class="bi bi-trophy-fill"></i> <?php esc_html_e('Previous Awards', 'uok-sfao'); ?>
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-info">
                  <i class="bi bi-info-circle-fill"></i> <?php esc_html_e('Important Info', 'uok-sfao'); ?>
                </button>
              </li>
            </ul>

            <div class="tab-content">
              <!-- Intro Tab Content -->
              <div class="tab-pane fade show active" id="tab-intro">
                <h3 class="fw-bold"><?php the_title(); ?></h3>
                <p class="text-black"><?php esc_html_e('Award Amount & Overview', 'uok-sfao'); ?></p>

                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label fw-bold"><?php esc_html_e('Program Title', 'uok-sfao'); ?></label>
                    <input type="text" class="form-control rounded-pill" value="<?php echo esc_attr(get_the_title()); ?>" readonly>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold"><?php esc_html_e('Award Amount (PKR)', 'uok-sfao'); ?></label>
                    <input type="text" class="form-control rounded-pill" value="<?php echo esc_attr($amount); ?>" readonly>
                  </div>
                </div>

                <div class="scholarship-body-text mb-4">
                  <?php if (get_the_content()) : ?>
                    <?php the_content(); ?>
                  <?php else : ?>
                    <p>The Merit-Based Scholarship is established to support academically outstanding students who demonstrate consistent excellence in their studies. This scholarship is awarded to individuals who have achieved strong academic results and show the potential to contribute positively to the university community.</p>
                    <p>The program aims to reduce financial barriers that may hinder students from continuing their education. By providing financial assistance, the scholarship enables recipients to focus on their academic goals without financial constraints.</p>
                  <?php endif; ?>
                </div>

                <!-- Eligibility Criteria Repeater -->
                <?php if (function_exists('have_rows') && have_rows('eligibility_criteria', $post_id)) : ?>
                  <h5 class="fw-bold mt-4 mb-3"><?php esc_html_e('Eligibility Criteria:', 'uok-sfao'); ?></h5>
                  <ul class="mb-4">
                    <?php while (have_rows('eligibility_criteria', $post_id)) : the_row(); ?>
                      <li><?php echo esc_html(get_sub_field('point_text')); ?></li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>

                <?php if (!empty($apply_url) && $apply_url !== '#') : ?>
                  <div class="my-4">
                    <a href="<?php echo esc_url($apply_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn_fill round_full px-5 py-3">
                      <?php esc_html_e('Apply Now', 'uok-sfao'); ?>
                    </a>
                  </div>
                <?php endif; ?>

                <!-- Intro Image Collage -->
                <div class="image-collage mt-4">
                  <div class="row">
                    <?php if (!empty($intro_gallery) && is_array($intro_gallery)) : ?>
                      <?php foreach ($intro_gallery as $img) : ?>
                        <div class="col-md-4 mb-3">
                          <div class="image-box">
                            <img src="<?php echo esc_url($img['url']); ?>" class="img-fluid w-100" alt="<?php echo esc_attr($img['alt'] ?: 'Gallery Image'); ?>">
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <?php for ($k = 1; $k <= 6; $k++) : ?>
                        <div class="col-md-4 mb-3">
                          <div class="image-box">
                            <img src="<?php echo esc_url($theme_uri . '/assets/images/uok/img' . $k . '.png'); ?>" class="img-fluid w-100" alt="Gallery">
                          </div>
                        </div>
                      <?php endfor; ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Notifications Tab -->
              <div class="tab-pane fade" id="tab-notify">
                <h4 class="fw-bold mb-3"><?php esc_html_e('Announcements & Notifications', 'uok-sfao'); ?></h4>
                <?php if (function_exists('have_rows') && have_rows('scholarship_notifications', $post_id)) : ?>
                  <ul class="list-group">
                    <?php while (have_rows('scholarship_notifications', $post_id)) : the_row(); 
                      $n_title = get_sub_field('notify_title');
                      $n_file = get_sub_field('notify_file');
                      $n_date = get_sub_field('notify_date');
                    ?>
                      <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                          <strong><?php echo esc_html($n_title); ?></strong>
                          <?php if (!empty($n_date)): ?><span class="badge bg-light text-dark ms-2"><?php echo esc_html($n_date); ?></span><?php endif; ?>
                        </div>
                        <?php if (!empty($n_file) && is_array($n_file)): ?>
                          <a href="<?php echo esc_url($n_file['url']); ?>" target="_blank" class="btn btn-sm btn_fill"><?php esc_html_e('Download Notice', 'uok-sfao'); ?></a>
                        <?php endif; ?>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php else : ?>
                  <div class="alert alert-info"><?php esc_html_e('No new notifications for this scholarship at this time. Please check back later.', 'uok-sfao'); ?></div>
                <?php endif; ?>
              </div>

              <!-- Video Tab -->
              <div class="tab-pane fade" id="tab-video">
                <h4 class="fw-bold mb-3"><?php esc_html_e('Video Guidance & Orientation', 'uok-sfao'); ?></h4>
                <?php if (!empty($video_url)) : ?>
                  <div class="ratio ratio-16x9">
                    <?php if (function_exists('wp_oembed_get') && wp_oembed_get($video_url)) : ?>
                      <?php echo wp_oembed_get($video_url); ?>
                    <?php else : ?>
                      <iframe src="<?php echo esc_url($video_url); ?>" allowfullscreen></iframe>
                    <?php endif; ?>
                  </div>
                <?php else : ?>
                  <div class="alert alert-info"><?php esc_html_e('Video guidance will be updated soon.', 'uok-sfao'); ?></div>
                <?php endif; ?>
              </div>

              <!-- Previous Awards Tab -->
              <div class="tab-pane fade" id="tab-awards">
                <h4 class="fw-bold mb-3"><?php esc_html_e('Previous Award Ceremonies', 'uok-sfao'); ?></h4>
                <div class="row">
                  <?php if (!empty($awards_gallery) && is_array($awards_gallery)) : ?>
                    <?php foreach ($awards_gallery as $img) : ?>
                      <div class="col-md-4 mb-4">
                        <img src="<?php echo esc_url($img['url']); ?>" class="img-fluid w-100 rounded" alt="Previous Award">
                      </div>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <?php for ($p = 4; $p <= 9; $p++) : ?>
                      <div class="col-md-4 mb-4">
                        <img src="<?php echo esc_url($theme_uri . '/assets/images/uok/img' . $p . '.png'); ?>" class="img-fluid w-100 rounded" alt="Previous Award">
                      </div>
                    <?php endfor; ?>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Important Info Tab -->
              <div class="tab-pane fade" id="tab-info">
                <h4 class="fw-bold mb-3"><?php esc_html_e('Important Information & Guidelines', 'uok-sfao'); ?></h4>
                <?php if (!empty($important_info)) : ?>
                  <?php echo wp_kses_post($important_info); ?>
                <?php else : ?>
                  <p><?php esc_html_e('For inquiries, visit Student Financial Aid Office (SFAO), Room #04, Ground Floor, Old Administration Building, University of Karachi.', 'uok-sfao'); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Mobile Accordion -->
          <div class="d-block d-md-none">
            <div class="accordion" id="scholarshipAccordion">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#acc-intro">
                    <i class="bi bi-file-earmark-text-fill me-2"></i> <?php esc_html_e('Introduction', 'uok-sfao'); ?>
                  </button>
                </h2>
                <div id="acc-intro" class="accordion-collapse collapse show" data-bs-parent="#scholarshipAccordion">
                  <div class="accordion-body">
                    <h5 class="fw-bold"><?php the_title(); ?></h5>
                    <p class="badge bg-success mb-3"><?php echo esc_html__('Amount: PKR ', 'uok-sfao') . esc_html($amount); ?></p>
                    <div class="mb-3"><?php the_content(); ?></div>
                    <?php if (!empty($apply_url) && $apply_url !== '#') : ?>
                      <a href="<?php echo esc_url($apply_url); ?>" class="btn btn_fill round_full w-100 mb-3"><?php esc_html_e('Apply Now', 'uok-sfao'); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#acc-notify">
                    <i class="bi bi-bell-fill me-2"></i> <?php esc_html_e('Notifications', 'uok-sfao'); ?>
                  </button>
                </h2>
                <div id="acc-notify" class="accordion-collapse collapse" data-bs-parent="#scholarshipAccordion">
                  <div class="accordion-body">
                    <?php esc_html_e('Check desktop view for complete list of notification attachments.', 'uok-sfao'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

    </main>

<?php
endwhile;
get_footer();
