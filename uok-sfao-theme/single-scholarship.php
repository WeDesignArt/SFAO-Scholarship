<?php
/**
 * Single Scholarship — mirrors scholarship-innerpage-N.html of the static site.
 * Body text = post content; status box, next step and the Forms / Notifications / Selected Candidates
 * tabs come from the "Scholarship Details & Tabs" ACF group.
 *
 * @package UOK_SFAO
 */

get_header();

while (have_posts()) : the_post();
  $post_id     = get_the_ID();
  $hero_title  = uok_field('scholarship_hero_title', 'Scholarship 2025', $post_id);
  $crumb_ptext = uok_field('scholarship_breadcrumb_parent', 'Scholarships', $post_id);
  $crumb       = uok_field('scholarship_breadcrumb', get_the_title(), $post_id);
  $box_type    = uok_field('status_box_type', 'none', $post_id);
  $next_text   = uok_field('next_step_text', '', $post_id);

  $forms = array();
  foreach ((array) uok_field('scholarship_forms', array(), $post_id) as $row) {
    if (!empty($row['form_title'])) $forms[] = $row;
  }
  $notifications = array();
  foreach ((array) uok_field('scholarship_notifications', array(), $post_id) as $row) {
    if (!empty($row['notify_title'])) $notifications[] = $row;
  }
  $notify_has_files = false;
  foreach ($notifications as $row) {
    if (!empty($row['notify_file']['url'])) $notify_has_files = true;
  }
  $candidates = array();
  foreach ((array) uok_field('scholarship_candidates', array(), $post_id) as $block) {
    if (!empty($block['cand_students'])) $candidates[] = $block;
  }
?>

    <main role="main" class="home_content nav_space clearfix">

      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url(uok_img('uok/scholarship-innerpage-background.jpg')); ?>" alt="Scholarship Management" class="img-fluid w-100">
            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php echo esc_html($hero_title); ?></h1>
            </div>
          </div>
        </div>
      </section>

      <section class="section-2 overflow-hidden">
        <div class="container">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo esc_url(get_post_type_archive_link('scholarship')); ?>"><?php echo esc_html($crumb_ptext); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo esc_html($crumb); ?></a></li>
            </ol>
          </nav>
        </div>
      </section>

      <section class="section-3 scholarship-inner-content">
        <div class="container my-5">
          <h2 class="fw-bold mb-4 text-dark"><?php the_title(); ?></h2>

          <?php the_content(); ?>

          <?php if (in_array($box_type, array('open', 'pending', 'closed'), true)) : ?>
          <div class="mb-5 p-3 rounded application-<?php echo esc_attr($box_type); ?>">
            <h6 class="fw-bold mb-1"><?php echo esc_html(uok_field('status_box_title', '', $post_id)); ?></h6>
            <p class="mb-0 text-secondary"><?php echo wp_kses_post(uok_field('status_box_text', '', $post_id)); ?></p>
          </div>
          <?php endif; ?>

          <?php if ($next_text) : ?>
          <div class="mb-5 p-3 rounded next-step-section">
            <h6 class="fw-bold mb-1"><?php echo esc_html(uok_field('next_step_title', 'Next Step', $post_id)); ?></h6>
            <p class="mb-0 text-secondary"><?php echo wp_kses_post($next_text); ?></p>
          </div>
          <?php endif; ?>
        </div>

        <div class="sch-resources-section container mb-5">
          <h6 class="fw-bold mb-3 text-dark">Important details</h6>

          <div class="sch-res-tabs">
            <button class="sch-res-tab active" data-pane="sch-res-forms">
              <i class="bi bi-file-earmark-arrow-down"></i> Forms
            </button>
            <button class="sch-res-tab" data-pane="sch-res-notifications">
              <i class="bi bi-bell"></i> Notifications
            </button>
            <button class="sch-res-tab" data-pane="sch-res-candidates">
              <i class="bi bi-people"></i> Selected Candidates
            </button>
          </div>

          <!-- FORMS TAB -->
          <div class="sch-res-pane" id="sch-res-forms">
            <?php if ($forms) : ?>
            <div class="table-responsive mt-3">
              <table class="sch-res-table">
                <thead>
                  <tr><th>Form Title</th><th>Academic Year</th><th>Upload Date</th><th>Download</th></tr>
                </thead>
                <tbody>
                  <?php foreach ($forms as $row) : ?>
                  <tr>
                    <td><?php echo esc_html($row['form_title']); ?></td>
                    <td><?php echo esc_html($row['form_year']); ?></td>
                    <td><?php echo esc_html($row['form_date']); ?></td>
                    <td><?php if (!empty($row['form_file']['url'])) : ?><a href="<?php echo esc_url($row['form_file']['url']); ?>" target="_blank">&#8681; Download</a><?php endif; ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else : ?>
            <div class="sch-res-placeholder">
              <i class="bi bi-file-earmark"></i>
              No forms uploaded yet. Application forms will appear here when the scholarship cycle opens.
            </div>
            <?php endif; ?>
          </div>

          <!-- NOTIFICATIONS TAB -->
          <div class="sch-res-pane" id="sch-res-notifications" style="display:none">
            <?php if ($notifications) : ?>
            <div class="table-responsive mt-3">
              <table class="sch-res-table">
                <thead>
                  <tr><th>Title</th><th>Date</th><?php if ($notify_has_files) : ?><th>View</th><?php endif; ?></tr>
                </thead>
                <tbody>
                  <?php foreach ($notifications as $row) : ?>
                  <tr>
                    <td><?php echo esc_html($row['notify_title']); ?></td>
                    <td><?php echo esc_html($row['notify_date']); ?></td>
                    <?php if ($notify_has_files) : ?>
                    <td><?php if (!empty($row['notify_file']['url'])) : ?><a href="<?php echo esc_url($row['notify_file']['url']); ?>" target="_blank">View</a><?php endif; ?></td>
                    <?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else : ?>
            <div class="sch-res-placeholder">
              <i class="bi bi-bell-slash"></i>
              No notifications yet. Official announcements and circulars will appear here.
            </div>
            <?php endif; ?>
          </div>

          <!-- SELECTED CANDIDATES TAB -->
          <div class="sch-res-pane" id="sch-res-candidates" style="display:none">
            <?php if ($candidates) : ?>
              <?php foreach ($candidates as $block) : ?>
              <div class="sch-year-block">
                <span class="sch-year-title"><?php echo esc_html($block['cand_year']); ?></span>
                <div class="table-responsive mt-3">
                  <table class="sch-res-table">
                    <thead>
                      <tr><th>#</th><th>Student Name</th><th>Roll No.</th><th>Program / Department</th></tr>
                    </thead>
                    <tbody>
                      <?php foreach (array_values($block['cand_students']) as $i => $student) : ?>
                      <tr><td><?php echo (int) $i + 1; ?></td><td><?php echo esc_html($student['student_name']); ?></td><td><?php echo esc_html($student['roll_no']); ?></td><td><?php echo esc_html($student['program']); ?></td></tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php endforeach; ?>
            <?php else : ?>
            <div class="sch-res-placeholder">
              <i class="bi bi-person-lines-fill"></i>
              No results yet. Selected candidates will be listed here year-wise once confirmed.
            </div>
            <?php endif; ?>
          </div>

        </div>

        <script>
        (function () {
          var sec = document.querySelector('.sch-resources-section');
          if (!sec) return;

          var defaultPane = 'sch-res-forms';
          var locked = false;

          var statusBox = document.querySelector('.application-open, .application-pending, .application-closed');
          if (statusBox) {
            if (statusBox.classList.contains('application-pending')) {
              defaultPane = 'sch-res-notifications';
              locked = true;
            }
            if (statusBox.classList.contains('application-closed')) {
              defaultPane = 'sch-res-candidates';
              locked = true;
            }
          }

          function activatePane(paneId) {
            sec.querySelectorAll('.sch-res-tab').forEach(function (t) { t.classList.remove('active'); });
            sec.querySelectorAll('.sch-res-pane').forEach(function (p) { p.style.display = 'none'; });
            var tab = sec.querySelector('[data-pane="' + paneId + '"]');
            var pane = document.getElementById(paneId);
            if (tab)  tab.classList.add('active');
            if (pane) pane.style.display = '';
          }

          activatePane(defaultPane);

          if (locked) {
            sec.querySelectorAll('.sch-res-tab:not(.active)').forEach(function (t) {
              t.classList.add('sch-res-tab-locked');
              t.setAttribute('title', 'Not available in this phase');
            });
          }

          sec.querySelectorAll('.sch-res-tab').forEach(function (tab) {
            tab.addEventListener('click', function () {
              if (locked) return;
              activatePane(tab.getAttribute('data-pane'));
            });
          });
        })();
        </script>
      </section>

    </main>

<?php
endwhile;
get_footer();
