<?php
/**
 * Template Name: Contact Us Page (Latest Build)
 * Mirrors contact.html of the static site. Submissions are saved as Leads (inc/leads-handler.php).
 *
 * @package UOK_SFAO
 */

get_header();

$banner_title   = uok_field('contact_banner_title', 'Contact Us');
$banner_image   = uok_img_field('contact_banner_image', 'uok/contact-us.jpg');
$form_heading   = uok_field('contact_form_heading', 'Get In Touch');
$office_name    = uok_field('contact_office_name', 'STUDENT FINANCE AID OFFICE');
$office_address = uok_field('contact_office_address', "ROOM # 4, GROUND FLOOR,\nOLD ADMINISTRATION BUILDING\nUNIVERSITY OF KARACHI, KARACHI-75270");
$tel            = uok_field('contact_tel', 'Telephone: 99261300-06 Extension: 2576');
$direct         = uok_field('contact_direct', 'Direct: 99261383');
$email          = uok_field('contact_email', 'sfao@uok.edu.pk');

$departments = array('Computer Science', 'Business Administration', 'Commerce', 'Mathematics', 'Physics', 'English', 'Media Science');
?>

    <main role="main" class="home_content nav_space clearfix">

       <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">
            <img src="<?php echo esc_url($banner_image); ?>" alt="<?php echo esc_attr($banner_title); ?>" class="img-fluid w-100">

            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php echo esc_html($banner_title); ?></h1>
            </div>

          </div>
        </div>
      </section>

      <section class="contact_section overflow-hidden ptb_80 clearfix">
        <div class="container_content">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="row justify-content-between">
                <div class="col-lg-7 mb-4 mb-lg-0 bd_right">
                  <div class="section_intro m-13 m-lg-15">
                    <h1 class="section_title h2" data-aos="fade-right">
                      <span class="fw_md d-block primary_color">
                        <?php echo esc_html($form_heading); ?>
                      </span>
                    </h1>
                  </div>

                  <div class="career-resume col-lg-9">

                    <div id="sfao-form-error" style="display:none; margin-bottom: 20px; border-radius: 8px; padding: 14px 18px; background: #f8d7da; color: #842029; border: 1px solid #f5c2c7;"></div>

                    <form action="" id="contactForm">
                      <input type="hidden" name="action" value="uok_submit_lead">
                      <input type="hidden" name="lead_nonce" value="<?php echo esc_attr(wp_create_nonce('uok_contact_lead_action')); ?>">

                      <div class="col">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" required />
                      </div>

                      <div class="col">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required />
                      </div>

                    <!-- Department -->
                    <div class="col">
                      <label class="form-label">Department</label>

                      <select class="form-control" id="departmentSelect" name="department" required>
                        <option value="">Select Department</option>
                        <?php foreach ($departments as $dept) : ?>
                        <option><?php echo esc_html($dept); ?></option>
                        <?php endforeach; ?>
                        <option value="other">Other</option>
                      </select>
                    </div>

                    <!-- Other Department Field -->
                    <div class="col mt-3 d-none" id="otherDepartmentField">
                      <label class="form-label">
                        Enter Your Department
                      </label>

                      <input type="text" class="form-control" id="otherDepartmentInput" name="other_department" placeholder="Type your department" />
                    </div>

                      <!-- Student ID -->
                      <div class="col">
                        <label class="form-label">Student ID / Roll Number (if available)</label>
                        <input type="text" name="student_id" class="form-control" />
                      </div>

                      <!-- Optional Phone -->
                      <div class="col">
                        <label class="form-label">
                          Contact Number
                          <small>(Optional)</small>
                        </label>

                        <input type="tel" name="phone" class="form-control" />
                      </div>

                      <!-- Message -->
                      <div class="col">
                        <label class="form-label">
                          Message
                          <small id="charCounter">(0 / 350 characters)</small>
                        </label>

                        <textarea id="messageBox" name="message" rows="7" class="form-control" placeholder="Write your message..." maxlength="350"
                          required></textarea>
                      </div>

                      <p class="mt-4">
                        <input type="submit" value="Send" class="btn btn_fill text-uppercase" />
                      </p>

                    </form>

                  </div>
                </div>

                <div class="col-lg-4">
                  <aside>

                    <div class="contact_single" data-aos="fade-left">
                      <h2 class="contact_single_title h5 brand_500">
                        For further information please contact:
                      </h2>
                      <address>
                        <?php echo esc_html($office_name); ?>

                        <?php echo esc_html($office_address); ?>

                        <ul>
                          <li>
                            <i class="ri ri-phone-fill icon"></i>
                            <a href="tel:+9299261300 "><?php echo esc_html($tel); ?>
                            </a>
                          </li>
                          <li>
                            <i class="ri ri-phone-fill icon"></i>
                            <a href="tel:+92<?php echo esc_attr(preg_replace('/\D/', '', $direct)); ?>"><?php echo esc_html($direct); ?></a>
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

  <div class="sfao-modal" id="successModal">
    <div class="sfao-modal-content">

      <div class="success-icon">
        ✓
      </div>

      <h2>Message Submitted Successfully</h2>

      <p>
        Thank you for contacting the
        <strong>Student Financial Aid Office (SFAO)</strong>.
        <br />
        Your message has been received successfully.
        Our team will get back to you shortly.
      </p>

      <button class="btn btn_fill" id="closeModal">
        Close
      </button>

    </div>
  </div>

<script>
  (function () {
    var contactForm = document.getElementById('contactForm');
    var messageBox = document.getElementById('messageBox');
    var charCounter = document.getElementById('charCounter');
    var departmentSelect = document.getElementById('departmentSelect');
    var otherDepartmentField = document.getElementById('otherDepartmentField');
    var otherDepartmentInput = document.getElementById('otherDepartmentInput');
    var successModal = document.getElementById('successModal');
    var closeModal = document.getElementById('closeModal');
    var errorBox = document.getElementById('sfao-form-error');
    var submitBtn = contactForm.querySelector('[type="submit"]');

    messageBox.addEventListener('input', function () {
      charCounter.innerText = '(' + this.value.length + ' / 350 characters)';
    });

    departmentSelect.addEventListener('change', function () {
      if (this.value === 'other') {
        otherDepartmentField.classList.remove('d-none');
        otherDepartmentInput.setAttribute('required', true);
      } else {
        otherDepartmentField.classList.add('d-none');
        otherDepartmentInput.removeAttribute('required');
        otherDepartmentInput.value = '';
      }
    });

    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      errorBox.style.display = 'none';
      submitBtn.disabled = true;

      fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', { method: 'POST', body: new FormData(contactForm) })
        .then(function (response) { return response.json(); })
        .then(function (data) {
          submitBtn.disabled = false;
          if (!data.success) {
            errorBox.textContent = (data.data && data.data.message) ? data.data.message : 'An error occurred. Please try again.';
            errorBox.style.display = 'block';
            return;
          }
          successModal.classList.add('active');
          contactForm.reset();
          charCounter.innerText = '(0 / 350 characters)';
          otherDepartmentField.classList.add('d-none');
        })
        .catch(function () {
          submitBtn.disabled = false;
          errorBox.textContent = 'Network error. Please check your connection and try again.';
          errorBox.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', function () {
      successModal.classList.remove('active');
    });

    successModal.addEventListener('click', function (e) {
      if (e.target === successModal) {
        successModal.classList.remove('active');
      }
    });
  })();
</script>

<?php
get_footer();
