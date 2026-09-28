<?php
/**
 * The template for displaying Scholarship Archive / Listing (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
?>

    <main role="main" class="home_content nav_space clearfix">

      <!-- Hero Banner -->
      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url($theme_uri . '/assets/images/uok/scholarship-outerpage-background.jpg'); ?>" alt="Scholarship Management" class="img-fluid w-100">
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php esc_html_e('Scholarships 2025–26', 'uok-sfao'); ?></h1>
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
              <li class="breadcrumb-item active" aria-current="page"><?php esc_html_e('Scholarships 2025–26', 'uok-sfao'); ?></li>
            </ol>
          </nav>
        </div>
      </section>

      <!-- Scholarship List Section -->
      <section id="scholarship-section" class="scholarship-list-container">
        <div class="container my-4">
          
          <div class="sch-tabs-nav mb-4">
            <button class="sch-tab active" data-tab="current">
              <?php esc_html_e('Current Scholarships', 'uok-sfao'); ?>
            </button>
          </div>

          <div class="sch-tab-content" id="tab-current">
            <h2 class="scholarship-list-title"><?php esc_html_e('Merit & Need-Based Scholarships 2025–26', 'uok-sfao'); ?></h2>
            <p class="scholarship-list-subtitle"><?php esc_html_e('Scholarship cycle running until mid-June 2026. Stay updated via SFAO for latest status.', 'uok-sfao'); ?></p>

            <!-- Notice Banner -->
            <?php 
              $notice_active = function_exists('get_field') ? get_field('show_notice_banner', 'option') : false;
              $notice_text = function_exists('get_field') ? get_field('notice_banner_text', 'option') : '';
              if ($notice_active && !empty($notice_text)) :
            ?>
              <div class="sfao-notice-banner" id="sfao-notice-banner">
                <div class="sfao-notice-inner">
                  <span class="sfao-notice-icon">&#128226;</span>
                  <div class="sfao-notice-text">
                    <strong><?php esc_html_e('Notice:', 'uok-sfao'); ?></strong> <?php echo wp_kses_post($notice_text); ?>
                  </div>
                  <button class="sfao-notice-close" onclick="document.getElementById('sfao-notice-banner').style.display='none'" title="Dismiss">&times;</button>
                </div>
              </div>
            <?php endif; ?>

            <!-- Filter Buttons -->
            <div class="scholarship-filter-bar">
              <button class="scholarship-filter-btn active" data-filter="all"><?php esc_html_e('All', 'uok-sfao'); ?> <span class="filter-count" id="count-all"></span></button>
              <button class="scholarship-filter-btn filter-open" data-filter="open"><?php esc_html_e('Open', 'uok-sfao'); ?> <span class="filter-count" id="count-open"></span></button>
              <button class="scholarship-filter-btn filter-closed" data-filter="closed"><?php esc_html_e('Closed', 'uok-sfao'); ?> <span class="filter-count" id="count-closed"></span></button>
              <button class="scholarship-filter-btn filter-pending" data-filter="pending"><?php esc_html_e('Pending', 'uok-sfao'); ?> <span class="filter-count" id="count-pending"></span></button>
              <button class="scholarship-filter-btn filter-upcoming" data-filter="upcoming"><?php esc_html_e('Upcoming', 'uok-sfao'); ?> <span class="filter-count" id="count-upcoming"></span></button>
            </div>

            <!-- Table Header -->
            <div class="scholarship-table-header">
              <div class="scholarship-col-name"><?php esc_html_e('Scholarship Name List', 'uok-sfao'); ?></div>
              <div class="scholarship-col-deadline"><?php esc_html_e('Deadlines', 'uok-sfao'); ?></div>
              <div class="scholarship-col-status"><?php esc_html_e('Status', 'uok-sfao'); ?></div>
              <div class="scholarship-col-details"><?php esc_html_e('Details', 'uok-sfao'); ?></div>
            </div>

            <!-- Scholarships Loop -->
            <div class="scholarship-table-body">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); 
                  $deadline = function_exists('get_field') ? get_field('scholarship_deadline') : 'Ongoing';
                  $status = function_exists('get_field') ? get_field('scholarship_status') : 'Open';
                  $status_lower = strtolower($status);
                  $status_class = 'status-' . $status_lower;
                ?>
                  <div class="scholarship-row" data-status="<?php echo esc_attr($status_lower); ?>">
                    <div class="scholarship-col-name">
                      <a href="<?php the_permalink(); ?>" class="text-reset text-decoration-none fw-medium">
                        <?php the_title(); ?>
                      </a>
                    </div>
                    <div class="scholarship-col-deadline">
                      <?php echo esc_html($deadline ?: 'Ongoing'); ?>
                    </div>
                    <div class="scholarship-col-status">
                      <span class="scholarship-status-badge <?php echo esc_attr($status_class); ?>">
                        <?php echo esc_html($status ?: 'Open'); ?>
                      </span>
                    </div>
                    <div class="scholarship-col-details">
                      <a href="<?php the_permalink(); ?>" class="scholarship-view-details"><?php esc_html_e('View Details', 'uok-sfao'); ?></a>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else : ?>
                <!-- Fallback items -->
                <div class="scholarship-row" data-status="closed">
                  <div class="scholarship-col-name">Haier Funded Scholarships 2025-26 (Based on Need Cum Merit, Only for Morning Program Students)</div>
                  <div class="scholarship-col-deadline">May 30, 2025</div>
                  <div class="scholarship-col-status"><span class="scholarship-status-badge status-closed">Closed</span></div>
                  <div class="scholarship-col-details"><a href="#" class="scholarship-view-details">View Details</a></div>
                </div>

                <div class="scholarship-row" data-status="open">
                  <div class="scholarship-col-name">Ihsan Trust Qarz-e-Hasna (Interest-Free Loan Facility)</div>
                  <div class="scholarship-col-deadline">Year Round</div>
                  <div class="scholarship-col-status"><span class="scholarship-status-badge status-open">Open</span></div>
                  <div class="scholarship-col-details"><a href="#" class="scholarship-view-details">View Details</a></div>
                </div>

                <div class="scholarship-row" data-status="pending">
                  <div class="scholarship-col-name">Mitsubishi UFJ Foundation Scholarship 2025–26</div>
                  <div class="scholarship-col-deadline">Notification in Progress</div>
                  <div class="scholarship-col-status"><span class="scholarship-status-badge status-pending">Pending</span></div>
                  <div class="scholarship-col-details"><a href="#" class="scholarship-view-details">View Details</a></div>
                </div>

                <div class="scholarship-row" data-status="upcoming">
                  <div class="scholarship-col-name">Balochistan Education Endowment Fund (BEEF) Scholarship</div>
                  <div class="scholarship-col-deadline">Announcement Coming Soon</div>
                  <div class="scholarship-col-status"><span class="scholarship-status-badge status-upcoming">Upcoming</span></div>
                  <div class="scholarship-col-details"><a href="#" class="scholarship-view-details">View Details</a></div>
                </div>
              <?php endif; ?>
            </div>

            <!-- Client-Side Filter Count Script -->
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const rows = document.querySelectorAll('.scholarship-table-body .scholarship-row');
                const filterBtns = document.querySelectorAll('.scholarship-filter-btn');

                function updateCounts() {
                  let total = rows.length;
                  let counts = { all: total, open: 0, closed: 0, pending: 0, upcoming: 0 };

                  rows.forEach(r => {
                    let st = r.getAttribute('data-status');
                    if (counts[st] !== undefined) counts[st]++;
                  });

                  for (let key in counts) {
                    let el = document.getElementById('count-' + key);
                    if (el) el.textContent = '(' + counts[key] + ')';
                  }
                }

                updateCounts();

                filterBtns.forEach(btn => {
                  btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    let filter = this.getAttribute('data-filter');

                    rows.forEach(r => {
                      if (filter === 'all' || r.getAttribute('data-status') === filter) {
                        r.style.display = 'flex';
                      } else {
                        r.style.display = 'none';
                      }
                    });
                  });
                });
              });
            </script>

          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
