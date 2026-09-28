<?php
/**
 * Template Name: Contact Us Page (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();

$theme_uri = get_template_directory_uri();
$post_id = get_the_ID();

// ACF Fields
$banner_title = function_exists('get_field') && get_field('contact_banner_title', $post_id) ? get_field('contact_banner_title', $post_id) : 'Contact Us';
$banner_image = function_exists('get_field') ? get_field('contact_banner_image', $post_id) : null;
$banner_image_url = ($banner_image && is_array($banner_image)) ? $banner_image['url'] : $theme_uri . '/assets/images/uok/contact-us.jpg';

$form_heading = function_exists('get_field') && get_field('contact_form_heading', $post_id) ? get_field('contact_form_heading', $post_id) : 'Get In Touch';
$office_name = function_exists('get_field') && get_field('contact_office_name', $post_id) ? get_field('contact_office_name', $post_id) : 'STUDENT FINANCIAL AID OFFICE (SFAO)';
$office_address = function_exists('get_field') && get_field('contact_office_address', $post_id) ? get_field('contact_office_address', $post_id) : "ROOM # 4, GROUND FLOOR,\nOLD ADMINISTRATION BUILDING,\nUNIVERSITY OF KARACHI, KARACHI-75270";
$tel = function_exists('get_field') && get_field('contact_tel', $post_id) ? get_field('contact_tel', $post_id) : 'Telephone: 99261300-06 Ext: 2576';
$direct = function_exists('get_field') && get_field('contact_direct', $post_id) ? get_field('contact_direct', $post_id) : 'Direct: 99261383';
$email = function_exists('get_field') && get_field('contact_email', $post_id) ? get_field('contact_email', $post_id) : 'sfao@uok.edu.pk';
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

      <!-- Contact Section -->
      <section class="contact_section overflow-hidden ptb_80 clearfix">
        <div class="container_content">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="row justify-content-between">
                
                <!-- Contact Form Col -->
                <div class="col-lg-7 mb-4 mb-lg-0 bd_right">
                  <div class="section_intro m-13 m-lg-15 mb-4">
                    <h1 class="section_title h2" data-aos="fade-right">
                      <span class="fw_md d-block primary_color">
                        <?php echo esc_html($form_heading); ?>
                      </span>
                    </h1>
                    <p class="text-muted small">
                      <?php esc_html_e('Have questions regarding scholarship quotas, eligibility, or application deadlines? Send us a message and our team will respond promptly.', 'uok-sfao'); ?>
                    </p>
                  </div>

                  <div class="career-resume col-lg-10">
                    <!-- Error Alert -->
                    <div id="sfao-form-error" style="display:none; margin-bottom: 20px; border-radius: 8px; padding: 14px 18px; font-size: 0.95rem; background: #f8d7da; color: #842029; border: 1px solid #f5c2c7; line-height: 1.5;"></div>

                    <!-- Form Completion Success Box -->
                    <div id="sfao-completion-card" style="display:none; background: #f0faf0; border: 2px solid #379934; border-radius: 12px; padding: 36px 28px; text-align: center; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(55, 153, 52, 0.12);">
                      <div style="width: 64px; height: 64px; background: #379934; border-radius: 50%; color: #fff; font-size: 32px; line-height: 64px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-lg" style="font-size: 34px;"></i>
                      </div>
                      <h3 style="color: #1a3c2b; font-weight: 700; margin-bottom: 12px; font-size: 1.6rem;"><?php esc_html_e('Thank you!', 'uok-sfao'); ?></h3>
                      <p style="font-size: 1.05rem; color: #2d3748; max-width: 560px; margin: 0 auto 24px; line-height: 1.6; font-weight: 500;">
                        <?php esc_html_e('Thank you! Your message has been received successfully. The SFAO team will review your inquiry and get back to you shortly.', 'uok-sfao'); ?>
                      </p>
                      <button type="button" id="sfao-send-another-btn" class="btn btn_fill round_full px-4 py-2" style="font-size: 0.9rem;">
                        <i class="bi bi-arrow-repeat me-1"></i> <?php esc_html_e('Send Another Inquiry', 'uok-sfao'); ?>
                      </button>
                    </div>

                    <!-- Contact Form -->
                    <form id="sfao-lead-contact-form" method="post" novalidate>
                      <input type="hidden" name="action" value="uok_submit_lead">
                      <input type="hidden" name="lead_nonce" value="<?php echo esc_attr(wp_create_nonce('uok_contact_lead_action')); ?>">

                      <div class="row g-3">
                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold"><?php esc_html_e('Full Name', 'uok-sfao'); ?> <span class="text-danger">*</span></label>
                          <input type="text" name="full_name" class="form-control" placeholder="<?php esc_attr_e('e.g. Muhammad Ali', 'uok-sfao'); ?>" required />
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold"><?php esc_html_e('Email Address', 'uok-sfao'); ?> <span class="text-danger">*</span></label>
                          <input type="email" name="email" class="form-control" placeholder="<?php esc_attr_e('name@domain.com', 'uok-sfao'); ?>" required />
                        </div>
                      </div>

                      <div class="row g-3">
                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold"><?php esc_html_e('Phone / WhatsApp Number', 'uok-sfao'); ?> <span class="text-danger">*</span></label>
                          <input type="tel" name="phone" class="form-control" placeholder="<?php esc_attr_e('0300-1234567', 'uok-sfao'); ?>" required />
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold"><?php esc_html_e('Inquiry Topic / Program', 'uok-sfao'); ?></label>
                          <select name="subject" class="form-select form-control">
                            <option value="General Scholarship Inquiry"><?php esc_html_e('General Scholarship Inquiry', 'uok-sfao'); ?></option>
                            <option value="Need-Based Financial Aid (HEC / Sindh Zakat)"><?php esc_html_e('Need-Based Financial Aid (HEC / Sindh Zakat)', 'uok-sfao'); ?></option>
                            <option value="Merit-cum-Need Scholarship"><?php esc_html_e('Merit-cum-Need Scholarship', 'uok-sfao'); ?></option>
                            <option value="Ihsan Trust Interest-Free Loan"><?php esc_html_e('Ihsan Trust Interest-Free Loan', 'uok-sfao'); ?></option>
                            <option value="Application Status Tracking"><?php esc_html_e('Application Status Tracking', 'uok-sfao'); ?></option>
                            <option value="Document Submission Inquiry"><?php esc_html_e('Document Submission Inquiry', 'uok-sfao'); ?></option>
                            <option value="Donor / Organization Collaboration"><?php esc_html_e('Donor / Organization Collaboration', 'uok-sfao'); ?></option>
                          </select>
                        </div>
                      </div>

                      <div class="col mb-4">
                        <label class="form-label fw-bold"><?php esc_html_e('Your Message / Question', 'uok-sfao'); ?> <span class="text-danger">*</span></label>
                        <textarea name="message" rows="5" class="form-control" placeholder="<?php esc_attr_e('Please describe your question, department, enrollment year, or required guidance...', 'uok-sfao'); ?>" required></textarea>
                      </div>

                      <div class="d-flex align-items-center gap-3">
                        <button type="submit" id="sfao-submit-btn" class="btn btn_fill text-uppercase round_full px-5 py-3">
                          <span id="sfao-btn-text"><?php esc_html_e('Submit Inquiry', 'uok-sfao'); ?></span>
                          <span id="sfao-btn-spinner" class="spinner-border spinner-border-sm ms-2" role="status" style="display:none;"></span>
                        </button>
                      </div>
                    </form>

                    <!-- Client-Side AJAX Script -->
                    <script>
                      document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('sfao-lead-contact-form');
                        const completionCard = document.getElementById('sfao-completion-card');
                        const errorBox = document.getElementById('sfao-form-error');
                        const submitBtn = document.getElementById('sfao-submit-btn');
                        const btnText = document.getElementById('sfao-btn-text');
                        const btnSpinner = document.getElementById('sfao-btn-spinner');
                        const sendAnotherBtn = document.getElementById('sfao-send-another-btn');

                        if (!form) return;

                        // Ensure on page load/refresh form is displayed and completion card is hidden
                        form.style.display = 'block';
                        if (completionCard) completionCard.style.display = 'none';
                        if (errorBox) errorBox.style.display = 'none';

                        form.addEventListener('submit', function(e) {
                          e.preventDefault();

                          const name = form.querySelector('[name="full_name"]').value.trim();
                          const email = form.querySelector('[name="email"]').value.trim();
                          const msg = form.querySelector('[name="message"]').value.trim();

                          if (!name || !email || !msg) {
                            errorBox.style.display = 'block';
                            errorBox.innerHTML = '⚠️ Please complete all required fields (Name, Email, Message) before submitting.';
                            errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            return;
                          }

                          // Loading state
                          errorBox.style.display = 'none';
                          submitBtn.disabled = true;
                          btnSpinner.style.display = 'inline-block';
                          btnText.textContent = 'Submitting...';

                          const formData = new FormData(form);
                          const ajaxUrl = (typeof uok_ajax_obj !== 'undefined' && uok_ajax_obj.ajaxurl) ? uok_ajax_obj.ajaxurl : '<?php echo admin_url("admin-ajax.php"); ?>';

                          fetch(ajaxUrl, {
                            method: 'POST',
                            body: formData
                          })
                          .then(response => response.json())
                          .then(data => {
                            submitBtn.disabled = false;
                            btnSpinner.style.display = 'none';
                            btnText.textContent = 'Submit Inquiry';

                            if (data.success) {
                              // Hide form and display completion card
                              form.style.display = 'none';
                              form.reset();
                              if (completionCard) {
                                completionCard.style.display = 'block';
                                completionCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                              }
                            } else {
                              errorBox.style.display = 'block';
                              errorBox.innerHTML = '⚠️ ' + (data.data && data.data.message ? data.data.message : 'An error occurred. Please try again.');
                              errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                          })
                          .catch(err => {
                            submitBtn.disabled = false;
                            btnSpinner.style.display = 'none';
                            btnText.textContent = 'Submit Inquiry';
                            errorBox.style.display = 'block';
                            errorBox.innerHTML = '⚠️ Network error. Please check your connection and try again.';
                            errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                          });
                        });

                        if (sendAnotherBtn) {
                          sendAnotherBtn.addEventListener('click', function() {
                            if (completionCard) completionCard.style.display = 'none';
                            form.style.display = 'block';
                            form.reset();
                            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
                          });
                        }
                      });
                    </script>
                  </div>
                </div>

                <!-- Office Contact Info Col -->
                <div class="col-lg-4">
                  <aside>
                    <div class="contact_single" data-aos="fade-left">
                      <h2 class="contact_single_title h5 brand_500">
                        <?php esc_html_e('For further information please contact:', 'uok-sfao'); ?>
                      </h2>
                      <address>
                        <strong><?php echo esc_html($office_name); ?></strong><br>
                        <?php echo nl2br(esc_html($office_address)); ?>
                        <br><br>
                        <ul>
                          <li>
                            <i class="ri ri-phone-fill icon"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $tel)); ?>"><?php echo esc_html($tel); ?></a>
                          </li>
                          <li>
                            <i class="ri ri-phone-fill icon"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $direct)); ?>"><?php echo esc_html($direct); ?></a>
                          </li>
                          <li>
                            <i class="ri ri-mail-fill icon"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                          </li>
                        </ul>
                      </address>
                    </div>
                  </aside>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
