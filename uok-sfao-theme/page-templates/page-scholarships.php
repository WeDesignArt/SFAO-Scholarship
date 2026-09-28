<?php
/**
 * Template Name: Scholarships Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields
$banner_title = function_exists('get_field') && get_field('scholarships_banner_title', $post_id) ? get_field('scholarships_banner_title', $post_id) : 'Scholarships 2025–26';
$banner_image = function_exists('get_field') ? get_field('scholarships_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/scholarship-outerpage-background.jpg';

$show_notice = function_exists('get_field') ? get_field('scholarships_show_notice', $post_id) : true;
$notice_text = function_exists('get_field') && get_field('scholarships_notice_text', $post_id) ? get_field('scholarships_notice_text', $post_id) : 'Selected students for Mitsubishi UFJ Foundation Scholarship 2025-26 are requested to visit SFAO office Room #4.';

$proc_title = function_exists('get_field') && get_field('processes_title', $post_id) ? get_field('processes_title', $post_id) : 'Scholarship Application Processes';
$proc_subtitle = function_exists('get_field') && get_field('processes_subtitle', $post_id) ? get_field('processes_subtitle', $post_id) : 'University of Karachi — Student Financial Aid Office (SFAO)';
$proc_note = function_exists('get_field') && get_field('processes_note', $post_id) ? get_field('processes_note', $post_id) : 'Applications must be submitted with all required supporting documents before the specified deadline. Incomplete submissions will not be processed. Regular morning program students have priority for most scholarships.';

$steps_title = function_exists('get_field') && get_field('steps_title', $post_id) ? get_field('steps_title', $post_id) : 'Steps in Scholarships Process';
$steps_subtitle = function_exists('get_field') && get_field('steps_subtitle', $post_id) ? get_field('steps_subtitle', $post_id) : 'From application to award — key milestones in the scholarship journey at University of Karachi.';

$faq_title = function_exists('get_field') && get_field('faq_title', $post_id) ? get_field('faq_title', $post_id) : 'Frequently Asked Questions (FAQs)';
$faq_subtitle = function_exists('get_field') && get_field('faq_subtitle', $post_id) ? get_field('faq_subtitle', $post_id) : 'Everything you need to know about scholarship applications, eligibility, and disbursements.';
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

      <!-- Breadcrumbs -->
      <section class="section-2 overflow-hidden">
        <div class="container">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'uok-sfao'); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo esc_html($banner_title); ?></li>
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
            <?php if ($show_notice && !empty($notice_text)) : ?>
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

            <div class="scholarship-no-results" id="scholarship-no-results">
              <?php esc_html_e('No scholarships found for this status.', 'uok-sfao'); ?>
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
              <?php
                $sch_query = new WP_Query(array(
                  'post_type'      => 'scholarship',
                  'posts_per_page' => -1,
                  'post_status'    => 'publish',
                ));

                if ($sch_query->have_posts()) :
                  while ($sch_query->have_posts()) : $sch_query->the_post(); 
                    $deadline = function_exists('get_field') ? get_field('scholarship_deadline') : 'Ongoing';
                    $status = function_exists('get_field') ? get_field('scholarship_status') : 'Open';
                    $status_lower = strtolower($status ?: 'open');
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
              <?php
                  endwhile;
                  wp_reset_postdata();
                else :
                  $default_list = array(
                    array('The Higher Education Commission (HEC) Need-Based Scholarship', 'Jun 25, 2025', 'closed'),
                    array('Need-Cum-Merit Scholarships — Zakat & Ushr Department, Government of Sindh', '—', 'closed'),
                    array('Sindh Education Endowment Fund (SEEF) Scholarship', 'May 30, 2025', 'closed'),
                    array('Balochistan Education Endowment Fund (BEEF) Scholarship', 'Announcement Coming Soon', 'upcoming'),
                    array('University of Karachi Alumni Association Houston USA (UKAHA)', '—', 'closed'),
                    array('Al-Kauser (UKAA), Baltimore, USA Scholarship', 'Oct 24, 2025', 'closed'),
                    array('Bismillah Bibi & Mrs. Talat Jamil Scholarship', 'Nov 21, 2025', 'closed'),
                    array('Syed Mohammad & Begum Safia Baqir Memorial Scholarship', 'Dec 12, 2025', 'closed'),
                    array('Haier Funded Scholarships 2025-26', 'May 30, 2025', 'closed'),
                    array('Ihsan Trust Qarz-e-Hasna (Interest-Free Loan Facility)', 'Year Round', 'open'),
                    array('Mitsubishi UFJ Foundation Scholarship 2025–26', 'Notification in Progress', 'pending'),
                    array('Dr. A. Q. Khan Need-Based Scholarship', 'Open Soon', 'upcoming'),
                    array('Sindh HEC Indigenous Scholarships (for M.Phil & Ph.D.)', 'Closed for 2025', 'closed'),
                    array('Merit-cum-Need Freeship Scholarship (University of Karachi)', 'Ongoing', 'open'),
                    array('Prime Minister Youth Laptop & Fee Reimbursement Scheme', 'Upcoming Cycle', 'upcoming')
                  );

                  foreach ($default_list as $row) :
                    $st_class = 'status-' . $row[2];
              ?>
                <div class="scholarship-row" data-status="<?php echo esc_attr($row[2]); ?>">
                  <div class="scholarship-col-name"><?php echo esc_html($row[0]); ?></div>
                  <div class="scholarship-col-deadline"><?php echo esc_html($row[1]); ?></div>
                  <div class="scholarship-col-status"><span class="scholarship-status-badge <?php echo esc_attr($st_class); ?>"><?php echo ucfirst(esc_html($row[2])); ?></span></div>
                  <div class="scholarship-col-details"><a href="#" class="scholarship-view-details"><?php esc_html_e('View Details', 'uok-sfao'); ?></a></div>
                </div>
              <?php 
                  endforeach;
                endif; 
              ?>
            </div>

            <!-- Client-Side Filter Count Script -->
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const rows = document.querySelectorAll('.scholarship-table-body .scholarship-row');
                const filterBtns = document.querySelectorAll('.scholarship-filter-btn');
                const noResults = document.getElementById('scholarship-no-results');

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
                    let visibleCount = 0;

                    rows.forEach(r => {
                      if (filter === 'all' || r.getAttribute('data-status') === filter) {
                        r.style.display = 'flex';
                        visibleCount++;
                      } else {
                        r.style.display = 'none';
                      }
                    });

                    if (noResults) {
                      noResults.style.display = (visibleCount === 0) ? 'block' : 'none';
                    }
                  });
                });
              });
            </script>

          </div>
        </div>
      </section>

      <!-- ================= SCHOLARSHIP APPLICATION PROCESSES CHART ================= -->
      <section class="scholarship-processes-section">
        <div class="container my-5">
          <h2 class="processes-title"><?php echo esc_html($proc_title); ?></h2>
          <p class="processes-subtitle"><?php echo esc_html($proc_subtitle); ?></p>

          <div class="processes-table-wrapper">
            <table class="processes-table">
              <thead>
                <tr>
                  <th style="width: 25%;">Scholarship Category</th>
                  <th style="width: 35%;">Application Steps</th>
                  <th style="width: 20%;">Submission Location</th>
                  <th style="width: 20%;">Mandatory Documents</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <strong>Merit-cum-Need Based</strong>
                    <span class="badge bg-success" style="font-size: 0.75rem;">Undergraduate &amp; Graduate</span>
                  </td>
                  <td>
                    <ol class="table-steps">
                      <li>Collect application form from SFAO office.</li>
                      <li>Fill all personal and family financial details.</li>
                      <li>Attach verified salary slip / income certificate.</li>
                      <li>Submit before deadline.</li>
                      <li>Attend interview if shortlisted.</li>
                    </ol>
                  </td>
                  <td><strong>Room #04, Ground Floor</strong><br>Old Administration Building, KU</td>
                  <td>Income Certificate, CNIC / B-Form copy, Father's CNIC, Latest Fee Challan, Academic transcripts.</td>
                </tr>
                <tr>
                  <td>
                    <strong>HEC Need-Based Scholarship</strong>
                    <span class="badge bg-primary" style="font-size: 0.75rem;">HEC Funded</span>
                  </td>
                  <td>
                    <ol class="table-steps">
                      <li>Download form from HEC / SFAO portal.</li>
                      <li>Complete form with authentic financial data.</li>
                      <li>Submit hard copy with documents to SFAO.</li>
                      <li>Institutional Scholarship Award Committee (ISAC) conducts interviews.</li>
                      <li>Final approval by HEC.</li>
                    </ol>
                  </td>
                  <td><strong>SFAO Counter</strong><br>Administration Block</td>
                  <td>Father / Guardian income slip, Utility bills (last 6 months), Rent agreement (if applicable), Academic records.</td>
                </tr>
                <tr>
                  <td>
                    <strong>Endowment &amp; Alumni Scholarships</strong>
                    <span class="badge bg-warning text-dark" style="font-size: 0.75rem;">Donor Funded</span>
                  </td>
                  <td>
                    <ol class="table-steps">
                      <li>Announcements published on SFAO notice board.</li>
                      <li>Obtain specific donor application form.</li>
                      <li>Department Chairperson recommendation required.</li>
                      <li>Submit complete dossier to SFAO.</li>
                      <li>Donor panel interview.</li>
                    </ol>
                  </td>
                  <td><strong>Respective Department</strong><br>then forwarded to SFAO</td>
                  <td>Department recommendation letter, Statement of purpose / need, Academic transcripts, Donor-specific form.</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="processes-note">
            <i class="bi bi-info-circle-fill" style="font-size: 1.3rem; flex-shrink: 0; color: #0d6efd; margin-top: 2px;"></i>
            <div>
              <strong><?php esc_html_e('Important Note:', 'uok-sfao'); ?></strong>
              <?php echo esc_html($proc_note); ?>
            </div>
          </div>
        </div>
      </section>

      <!-- ================= STEPS IN SCHOLARSHIPS PROCESS ================= -->
      <section class="steps-in-scholarships-section">
        <div class="container my-5">
          <h2 class="steps-title"><?php echo esc_html($steps_title); ?></h2>
          <p class="steps-subtitle"><?php echo esc_html($steps_subtitle); ?></p>

          <div class="scholarship-timeline">
            <div class="timeline-item">
              <div class="timeline-number"><div class="phase-badge phase-1">1</div></div>
              <div class="timeline-content">
                <h4 class="phase-title">Phase 1: Announcement &amp; Form Distribution</h4>
                <p class="phase-desc">SFAO issues official notifications through KU Times, department notice boards, and the official portal. Application forms become available at SFAO Room #04 and online. Students must review eligibility criteria carefully.</p>
              </div>
            </div>

            <div class="timeline-item">
              <div class="timeline-number"><div class="phase-badge phase-2">2</div></div>
              <div class="timeline-content">
                <h4 class="phase-title">Phase 2: Document Verification &amp; Submission</h4>
                <p class="phase-desc">Completed applications with verified income slips, utility bills, and department endorsements must be submitted before the announced deadline. SFAO verifies all documentation.</p>
              </div>
            </div>

            <div class="timeline-item">
              <div class="timeline-number"><div class="phase-badge phase-3">3</div></div>
              <div class="timeline-content">
                <h4 class="phase-title">Phase 3: Scrutiny &amp; Interview by Committee</h4>
                <p class="phase-desc">Shortlisted candidates are invited for an in-person interview before the Institutional Scholarship Award Committee (ISAC) or donor representatives to assess authentic financial need and merit.</p>
              </div>
            </div>

            <div class="timeline-item">
              <div class="timeline-number"><div class="phase-badge phase-4">4</div></div>
              <div class="timeline-content">
                <h4 class="phase-title">Phase 4: Award Notification &amp; Fund Disbursement</h4>
                <p class="phase-desc">Final selected candidates list is displayed on the SFAO notice board. Scholarship cheques are distributed at official award ceremonies or adjusted directly against university tuition fee challans.</p>
              </div>
            </div>
          </div>

          <div class="steps-info-box">
            <i class="bi bi-check-circle-fill"></i>
            <div>
              <strong><?php esc_html_e('Need Help?', 'uok-sfao'); ?></strong>
              <?php esc_html_e('Visit Room #04, Ground Floor, Old Administration Building during office hours (9:00 AM – 3:00 PM) for personalized guidance on applications.', 'uok-sfao'); ?>
            </div>
          </div>
        </div>
      </section>

      <!-- ================= FREQUENTLY ASKED QUESTIONS ================= -->
      <section class="faq-section">
        <div class="container my-4">
          <h2 class="faq-main-title text-center"><?php echo esc_html($faq_title); ?></h2>
          <p class="faq-main-subtitle text-center"><?php echo esc_html($faq_subtitle); ?></p>

          <div class="faq-accordion" id="scholarshipOuterFaq">
            <div class="faq-item">
              <button class="faq-question active">
                <span>How many scholarship slots are available for Sindh HEC Indigenous?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-answer open">
                63 scholarship slots are provided each year. Each successful candidate is awarded Rs. 230,000 for tuition and academic expenses.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                <span>What is the duration of HEC Need-Based Scholarships?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-answer">
                The scholarship covers the entire duration of the 4-year undergraduate or graduate degree program, provided the student maintains satisfactory GPA performance each semester.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                <span>Who is eligible for the Ihsan Trust Qarz-e-Hasna facility?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-answer">
                Both morning and evening program students at the University of Karachi can apply for Ihsan Trust interest-free loans year-round. Repayment begins after completion of graduation and employment.
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question">
                <span>Where can I find interview schedules and selected candidate lists?</span>
                <span class="faq-icon">+</span>
              </button>
              <div class="faq-answer">
                All interview schedules and selected candidate lists are displayed on the SFAO Notice Board at Room #04, Ground Floor, Old Administration Building, and announced via the KU Times page.
              </div>
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              document.querySelectorAll('.faq-question').forEach(function(btn) {
                btn.addEventListener('click', function() {
                  const item = this.closest('.faq-item');
                  const ans = item.querySelector('.faq-answer');
                  const isOpen = ans.classList.contains('open');

                  document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
                  document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('active'));

                  if (!isOpen) {
                    ans.classList.add('open');
                    this.classList.add('active');
                  }
                });
              });
            });
          </script>
        </div>
      </section>

    </main>

<?php
get_footer();
