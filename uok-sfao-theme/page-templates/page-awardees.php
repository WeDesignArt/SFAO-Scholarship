<?php
/**
 * Template Name: Awardees Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields
$banner_title = function_exists('get_field') && get_field('awardees_banner_title', $post_id) ? get_field('awardees_banner_title', $post_id) : 'Scholarship Awardees';
$banner_subtitle = function_exists('get_field') && get_field('awardees_banner_subtitle', $post_id) ? get_field('awardees_banner_subtitle', $post_id) : 'Honoring students who earned financial support through their dedication, merit, and need.';
$banner_image = function_exists('get_field') ? get_field('awardees_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/scholarship-outerpage-background.jpg';

$intro_title = function_exists('get_field') && get_field('awardees_intro_title', $post_id) ? get_field('awardees_intro_title', $post_id) : 'A Legacy of Educational Empowerment';
$intro_text = function_exists('get_field') && get_field('awardees_intro_text', $post_id) ? get_field('awardees_intro_text', $post_id) : 'Since 2006, the Student Financial Aid Office (SFAO) at the University of Karachi has been a lifeline for thousands of deserving students. By bridging the gap between financial hardship and academic ambition, SFAO has grown its scholarship disbursements from Rs. 6 million to over Rs. 200 million, transforming more than 2,000 student lives across over 17 active scholarship programs.';

$grid_title = function_exists('get_field') && get_field('awardees_grid_title', $post_id) ? get_field('awardees_grid_title', $post_id) : 'Mitsubishi UFJ Foundation Scholarship';
?>

    <main role="main" class="home_content nav_space clearfix">

      <!-- Hero -->
      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url($banner_image_url); ?>" alt="<?php echo esc_attr($banner_title); ?>" class="img-fluid w-100">
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-3"><?php echo esc_html($banner_title); ?></h1>
              <p class="text-white" style="font-size:1.05rem;max-width:520px;opacity:0.92;">
                <?php echo esc_html($banner_subtitle); ?>
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Breadcrumb -->
      <section class="section-2 overflow-hidden">
        <div class="container">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'uok-sfao'); ?></a></li>
              <li class="breadcrumb-item"><a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>"><?php esc_html_e('Scholarships', 'uok-sfao'); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo esc_html($banner_title); ?></li>
            </ol>
          </nav>
        </div>
      </section>

      <!-- Impact Stats -->
      <section class="awardees-stats-bar">
        <div class="container">
          <div class="row g-3 justify-content-center text-center">
            <?php if (function_exists('have_rows') && have_rows('awardees_stats', $post_id)) : ?>
              <?php while (have_rows('awardees_stats', $post_id)) : the_row(); ?>
                <div class="col-6 col-md-3">
                  <div class="awardees-stat-box">
                    <div class="awardees-stat-number"><?php echo esc_html(get_sub_field('stat_number')); ?></div>
                    <div class="awardees-stat-label"><?php echo esc_html(get_sub_field('stat_label')); ?></div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php else : ?>
              <div class="col-6 col-md-3">
                <div class="awardees-stat-box">
                  <div class="awardees-stat-number">2,000+</div>
                  <div class="awardees-stat-label"><?php esc_html_e('Students Supported', 'uok-sfao'); ?></div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="awardees-stat-box">
                  <div class="awardees-stat-number">Rs. 200M+</div>
                  <div class="awardees-stat-label"><?php esc_html_e('Scholarships Disbursed', 'uok-sfao'); ?></div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="awardees-stat-box">
                  <div class="awardees-stat-number">17+</div>
                  <div class="awardees-stat-label"><?php esc_html_e('Active Scholarship Programs', 'uok-sfao'); ?></div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="awardees-stat-box">
                  <div class="awardees-stat-number">Since 2006</div>
                  <div class="awardees-stat-label"><?php esc_html_e('Empowering Students', 'uok-sfao'); ?></div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <!-- Intro Box -->
      <section class="awardees-intro-section">
        <div class="container">
          <div class="awardees-intro-box">
            <div class="awardees-intro-icon">&#127942;</div>
            <div>
              <h2 class="awardees-intro-title"><?php echo esc_html($intro_title); ?></h2>
              <p class="awardees-intro-text">
                <?php echo esc_html($intro_text); ?>
              </p>
              <p class="awardees-intro-text">
                <?php esc_html_e('Each year, SFAO proudly recognizes and congratulates the recipients of these scholarships — students who have demonstrated exceptional academic merit, financial need, or both. This page celebrates their achievement and acknowledges the generosity of our donor partners who make it all possible.', 'uok-sfao'); ?>
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Featured Awardees Section -->
      <section class="awardees-featured-section">
        <div class="container">
          <div class="awardees-section-header">
            <div>
              <span class="awardees-year-tag">2025&#8211;26</span>
              <h2 class="awardees-section-title"><?php echo esc_html($grid_title); ?></h2>
              <p class="awardees-section-subtitle">
                <?php esc_html_e('SFAO warmly congratulates the following students on being selected for scholarship awards. This merit & need recognition honors outstanding academic dedication among morning program students.', 'uok-sfao'); ?>
              </p>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>" class="awardees-sch-link">
              <?php esc_html_e('View Scholarship Details &rarr;', 'uok-sfao'); ?>
            </a>
          </div>

          <div class="row g-4 justify-content-center">
            <?php
              $awardees = new WP_Query(array(
                'post_type'      => 'awardee',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
              ));

              if ($awardees->have_posts()) :
                while ($awardees->have_posts()) : $awardees->the_post();
                  $aw_id = get_the_ID();
                  $aw_photo = function_exists('get_field') ? get_field('awardee_photo', $aw_id) : null;
                  $aw_initials = function_exists('get_field') ? get_field('awardee_initials', $aw_id) : '';
                  if (empty($aw_initials)) {
                    $words = explode(' ', trim(get_the_title()));
                    $aw_initials = '';
                    foreach ($words as $w) {
                      $aw_initials .= mb_substr($w, 0, 1);
                      if (strlen($aw_initials) >= 2) break;
                    }
                  }
                  $aw_scholarship = function_exists('get_field') ? get_field('awardee_program', $aw_id) : 'Mitsubishi UFJ Foundation Scholarship';

                  $photo_url = '';
                  if (!empty($aw_photo)) {
                    if (is_array($aw_photo) && !empty($aw_photo['url'])) {
                      $photo_url = $aw_photo['url'];
                    } elseif (is_string($aw_photo)) {
                      $photo_url = $aw_photo;
                    }
                  }
            ?>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-full-card">
                  <div class="awardee-full-card-ribbon"><?php esc_html_e('Selected Awardee', 'uok-sfao'); ?></div>
                  
                  <div class="awardee-full-avatar">
                    <?php if (!empty($photo_url)) : ?>
                      <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>" class="awardee-avatar-img">
                    <?php else : ?>
                      <span><?php echo esc_html(strtoupper($aw_initials ?: 'AK')); ?></span>
                    <?php endif; ?>
                  </div>

                  <div class="awardee-full-name"><?php the_title(); ?></div>
                  <div class="awardee-full-program"><?php echo esc_html($aw_scholarship); ?></div>
                  <div class="awardee-full-badge">&#127881; <?php esc_html_e('Congratulations!', 'uok-sfao'); ?></div>
                </div>
              </div>
            <?php 
                endwhile;
                wp_reset_postdata();
              else :
                $sample_awardees = array(
                  array('AK', 'Ahmed Khan', 'Morning Program — Computer Science'),
                  array('SF', 'Sara Fatima', 'Morning Program — Chemistry'),
                  array('MH', 'Muhammad Hassan', 'Morning Program — Economics'),
                  array('FN', 'Fatima Noor', 'Morning Program — Biochemistry'),
                  array('BA', 'Bilal Ali', 'Morning Program — Business Administration'),
                  array('ZA', 'Zainab Ahmed', 'Morning Program — Physics'),
                  array('UR', 'Usman Raza', 'Morning Program — Applied Physics'),
                  array('AR', 'Ayesha Rehman', 'Morning Program — Commerce')
                );
                foreach ($sample_awardees as $s) :
            ?>
              <div class="col-12 col-sm-6 col-lg-3">
                <div class="awardee-full-card">
                  <div class="awardee-full-card-ribbon"><?php esc_html_e('Selected Awardee', 'uok-sfao'); ?></div>
                  <div class="awardee-full-avatar">
                    <span><?php echo esc_html($s[0]); ?></span>
                  </div>
                  <div class="awardee-full-name"><?php echo esc_html($s[1]); ?></div>
                  <div class="awardee-full-program"><?php echo esc_html($s[2]); ?></div>
                  <div class="awardee-full-badge">&#127881; <?php esc_html_e('Congratulations!', 'uok-sfao'); ?></div>
                </div>
              </div>
            <?php 
                endforeach;
              endif; 
            ?>
          </div>
        </div>
      </section>

      <!-- Past Awardees (Year-wise Accordion) -->
      <section class="awardees-history-section">
        <div class="container">
          <h2 class="awardees-history-title"><?php esc_html_e("Previous Years' Awardees", 'uok-sfao'); ?></h2>
          <p class="awardees-history-subtitle">
            <?php esc_html_e('A record of students recognized by SFAO across scholarship cycles since 2006.', 'uok-sfao'); ?>
          </p>

          <!-- 2024-25 -->
          <div class="awardees-year-block">
            <button class="awardees-year-toggle" data-target="ay2024">
              <span><?php esc_html_e('Academic Year 2024–25', 'uok-sfao'); ?></span>
              <span class="awardees-toggle-icon">+</span>
            </button>
            <div class="awardees-year-content" id="ay2024" style="display:none;">
              <div class="awardees-sch-group">
                <div class="awardees-sch-group-header">
                  <span class="awardees-sch-group-name">Higher Education Commission (HEC) Need-Based Scholarship</span>
                  <span class="awardees-sch-count">24 Awardees</span>
                </div>
                <div class="awardees-names-grid">
                  <span class="awardees-name-chip">Muhammad Bilal — Economics</span>
                  <span class="awardees-name-chip">Areeba Siddiqui — Microbiology</span>
                  <span class="awardees-name-chip">Syed Farhan Ali — Computer Science</span>
                  <span class="awardees-name-chip">Nimra Tariq — Mass Comm.</span>
                  <span class="awardees-name-chip">Zubair Ahmed — Chemistry</span>
                  <span class="awardees-name-chip">Bushra Parveen — Botany</span>
                  <span class="awardees-name-chip">Hamza Qureshi — Zoology</span>
                  <span class="awardees-name-chip">Khadija Bano — Mathematics</span>
                </div>
              </div>

              <div class="awardees-sch-group">
                <div class="awardees-sch-group-header">
                  <span class="awardees-sch-group-name">Sindh Education Endowment Fund (SEEF)</span>
                  <span class="awardees-sch-count">18 Awardees</span>
                </div>
                <div class="awardees-names-grid">
                  <span class="awardees-name-chip">Ali Raza — Pharmacy</span>
                  <span class="awardees-name-chip">Mehwish Shah — Physiology</span>
                  <span class="awardees-name-chip">Danish Hussain — Geology</span>
                  <span class="awardees-name-chip">Hira Anwar — Food Science</span>
                </div>
              </div>
            </div>
          </div>

          <!-- 2023-24 -->
          <div class="awardees-year-block">
            <button class="awardees-year-toggle" data-target="ay2023">
              <span><?php esc_html_e('Academic Year 2023–24', 'uok-sfao'); ?></span>
              <span class="awardees-toggle-icon">+</span>
            </button>
            <div class="awardees-year-content" id="ay2023" style="display:none;">
              <div class="awardees-sch-group">
                <div class="awardees-sch-group-header">
                  <span class="awardees-sch-group-name">Mitsubishi UFJ Foundation Scholarship</span>
                  <span class="awardees-sch-count">8 Awardees</span>
                </div>
                <div class="awardees-names-grid">
                  <span class="awardees-name-chip">Tariq Mehmood — Morning Program</span>
                  <span class="awardees-name-chip">Sadia Javed — Morning Program</span>
                  <span class="awardees-name-chip">Waqas Ur Rehman — Morning Program</span>
                  <span class="awardees-name-chip">Kainat Fatima — Morning Program</span>
                </div>
              </div>
            </div>
          </div>

          <!-- 2022-23 -->
          <div class="awardees-year-block">
            <button class="awardees-year-toggle" data-target="ay2022">
              <span><?php esc_html_e('Academic Year 2022–23', 'uok-sfao'); ?></span>
              <span class="awardees-toggle-icon">+</span>
            </button>
            <div class="awardees-year-content" id="ay2022" style="display:none;">
              <div class="awardees-sch-group">
                <div class="awardees-sch-group-header">
                  <span class="awardees-sch-group-name">Balochistan Education Endowment Fund (BEEF)</span>
                  <span class="awardees-sch-count">12 Awardees</span>
                </div>
                <div class="awardees-names-grid">
                  <span class="awardees-name-chip">Abdul Samad — International Relations</span>
                  <span class="awardees-name-chip">Gul Bibi — Sociology</span>
                  <span class="awardees-name-chip">Jamshed Khan — Psychology</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Archive note -->
          <div class="awardees-history-note">
            <span>&#8505;</span>
            <div>
              <strong><?php esc_html_e('Need older awardee records?', 'uok-sfao'); ?></strong>
              <?php esc_html_e('Records for scholarship cycles prior to 2022 are maintained at the SFAO office archives. Enrolled students and alumni can visit Room #4, Ground Floor, Old Administration Building during office hours for official award verification certificates.', 'uok-sfao'); ?>
            </div>
          </div>

        </div>
      </section>

      <!-- Accordion Toggle Script -->
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.awardees-year-toggle').forEach(function(btn) {
            btn.addEventListener('click', function() {
              var targetId = this.getAttribute('data-target');
              var content = document.getElementById(targetId);
              if (!content) return;
              var isClosed = content.style.display === 'none';
              if (isClosed) {
                content.style.display = 'block';
                this.classList.add('open');
              } else {
                content.style.display = 'none';
                this.classList.remove('open');
              }
            });
          });
        });
      </script>

    </main>

<?php
get_footer();
