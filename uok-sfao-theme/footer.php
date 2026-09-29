<?php
/**
 * The Footer for UOK SFAO Theme (Latest Build)
 *
 * @package UOK_SFAO
 */

$theme_uri = get_template_directory_uri();

// ACF Theme Options for Newsletter
$newsletter_bg = function_exists('get_field') ? get_field('newsletter_bg', 'option') : null;
$newsletter_bg_url = ($newsletter_bg && is_array($newsletter_bg)) ? $newsletter_bg['url'] : $theme_uri . '/assets/images/uok/banner_sponsoser2.jpg';
$newsletter_subheading = uok_field('newsletter_subheading', '', 'option');
$newsletter_heading_1 = uok_field('newsletter_heading_1', 'Updates from Students', 'option');
$newsletter_heading_2 = uok_field('newsletter_heading_2', 'Financial Aid Office (SFAO)', 'option');
$newsletter_btn_text = uok_field('newsletter_btn_text', 'Remain Connected via SFAO Page', 'option');
$newsletter_btn_url = uok_field('newsletter_btn_url', home_url('/'), 'option');

// ACF Theme Options for Footer Info
$footer_logo = function_exists('get_field') ? get_field('footer_logo', 'option') : null;
$footer_logo_url = ($footer_logo && is_array($footer_logo)) ? $footer_logo['url'] : $theme_uri . '/assets/images/uok/footer-logo.png';
$footer_about_text = uok_field('footer_about_text', 'We Don\'t Just Work With Concrete And We Work With People <strong>We Are Approachable</strong>, With Even Our Highest Work', 'option');
$footer_facebook = uok_field('facebook_url', '', 'option');
$footer_youtube = uok_field('youtube_url', '', 'option');
$footer_instagram = uok_field('instagram_url', '', 'option');

$footer_address = uok_field('footer_address', 'Administration Building (Old), Ground Floor, Room #04, University of Karachi – 75270', 'option');
$footer_phone = uok_field('footer_phone', '+92-21-99261383', 'option');
$footer_email = uok_field('footer_email', 'sfao@uok.edu.pk', 'option');
$copyright_text = uok_field('copyright_text', 'University of Karachi | All Rights Reserved.', 'option');
?>

    <!-- newsletter start -->
    <section class="section-5 overflow-hidden clearfix clear position-relative">
      <div class="image-container-bottom">
        <img src="<?php echo esc_url($newsletter_bg_url); ?>" alt="<?php echo esc_attr($newsletter_subheading ?: 'Newsletter'); ?>" class="img-fluid w-100" />

        <div class="overlay-bottom d-flex flex-column justify-content-center align-items-center text-center">
          <?php if (!empty($newsletter_subheading)): ?>
            <h5 class="text-white"><?php echo esc_html($newsletter_subheading); ?></h5>
          <?php endif; ?>
          <?php if (!empty($newsletter_heading_1)): ?>
            <h2 class="text-white"><?php echo esc_html($newsletter_heading_1); ?></h2>
          <?php endif; ?>
          <?php if (!empty($newsletter_heading_2)): ?>
            <h2 class="text-white"><?php echo esc_html($newsletter_heading_2); ?></h2>
          <?php endif; ?>
          <a href="<?php echo esc_url($newsletter_btn_url); ?>" class="btn btn_fill round_full">
            <?php echo esc_html($newsletter_btn_text); ?>
          </a>
        </div>
      </div>
    </section>
    <!-- newsletter end -->

    <!-- footer start -->
    <footer class="uok-footer overflow-hidden">
      <div class="container">
        <div class="row align-items-start">

          <!-- Logo & About -->
          <div class="col-md-4 mb-4">
            <img src="<?php echo esc_url($footer_logo_url); ?>" alt="University of Karachi" class="footer-logo mb-3">

            <p class="footer-text">
              <?php echo wp_kses_post($footer_about_text); ?>
            </p>

            <?php if ($footer_facebook || $footer_youtube || $footer_instagram) : ?>
            <div class="social-icons mt-3">
              <?php if (!empty($footer_facebook)): ?>
                <a href="<?php echo esc_url($footer_facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <?php endif; ?>
              <?php if (!empty($footer_youtube)): ?>
                <a href="<?php echo esc_url($footer_youtube); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
              <?php endif; ?>
              <?php if (!empty($footer_instagram)): ?>
                <a href="<?php echo esc_url($footer_instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>

          <!-- Divider -->
          <div class="col-md-1 ">
            <div class="vertical-line"></div>
          </div>

          <!-- Contact Info -->
          <div class="col-md-3 mb-4">
            <h5 class="footer-heading"><?php esc_html_e('Contact Info', 'uok-sfao'); ?></h5>
            <ul class="footer-list">
              <li>
                <span class="icon-circle"><i class="bi bi-geo-alt-fill"></i></span>
                <span><?php echo esc_html($footer_address); ?></span>
              </li>
              <li>
                <span class="icon-circle"><i class="bi bi-telephone-fill"></i></span>
                <?php echo esc_html($footer_phone); ?>
              </li>
              <li>
                <span class="icon-circle"><i class="bi bi-envelope"></i></span>
                <?php echo esc_html($footer_email); ?>
              </li>
            </ul>
          </div>

          <!-- Divider -->
          <div class="col-md-1 ">
            <div class="vertical-line"></div>
          </div>

          <!-- Quick Links -->
          <div class="col-md-3">
            <h5 class="footer-heading"><?php esc_html_e('Quick Links', 'uok-sfao'); ?></h5>
            <div class="row">
              <div class="col-6">
                <?php
                  if (has_nav_menu('footer_links_1')) {
                    wp_nav_menu(array(
                      'theme_location' => 'footer_links_1',
                      'container'      => false,
                      'items_wrap'     => '<ul class="footer-links">%3$s</ul>',
                    ));
                  } else {
                    echo '<ul class="footer-links">';
                    echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="bi bi-check-circle-fill me-2"></i>Home</a></li>';
                    echo '<li><a href="' . esc_url(uok_page_url('about-us')) . '"><i class="bi bi-check-circle-fill me-2"></i>About Us</a></li>';
                    echo '<li><a href="' . esc_url(uok_page_url('stories')) . '"><i class="bi bi-check-circle-fill me-2 "></i>Stories</a></li>';
                    echo '<li><a href="' . esc_url(get_post_type_archive_link('scholarship')) . '"><i class="bi bi-check-circle-fill me-2 "></i>Scholarships</a></li>';
                    echo '</ul>';
                  }
                ?>
              </div>
              <div class="col-6">
                <?php
                  if (has_nav_menu('footer_links_2')) {
                    wp_nav_menu(array(
                      'theme_location' => 'footer_links_2',
                      'container'      => false,
                      'items_wrap'     => '<ul class="footer-links">%3$s</ul>',
                    ));
                  } else {
                    echo '<ul class="footer-links">';
                    echo '<li><a href="' . esc_url(uok_page_url('contact-us')) . '"><i class="bi bi-check-circle-fill me-2 "></i>Contact Us</a></li>';
                    echo '</ul>';
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="section-6">
        <div class="bottom-bar">
          <div class="container text-center text-white py-4">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo esc_html($copyright_text); ?></p>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer end -->

  </div>
  <!-- main holder end -->

  <!-- mobile offcanvas menu overlay -->
  <div class="content_overlay_wrapper overlay_filter" data-lenis-prevent>
    <article class="offcanvas_content">
      <div class="overlay_content_holder">
        <div class="overlay_content sm_menu">
          <?php
            if (has_nav_menu('primary_menu')) {
              wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'container'      => false,
                'items_wrap'     => '<ul>%3$s</ul>',
              ));
            } else {
              echo '<ul>';
              echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
              echo '<li><a href="' . esc_url(uok_page_url('about-us')) . '">About Us</a></li>';
              echo '<li><a href="' . esc_url(uok_page_url('stories')) . '">Stories</a></li>';
              echo '<li><a href="' . esc_url(get_post_type_archive_link('scholarship')) . '">Scholarships</a></li>';
              echo '<li><a href="' . esc_url(uok_page_url('contact-us')) . '">Contact Us</a></li>';
              echo '</ul>';
            }
          ?>
        </div>
      </div>
    </article>
  </div>

  <button class="btn btn_bkt" id="btnTop" type="button" aria-label="Go to top">
    <i class="ri-arrow-up-s-line"></i>
    <span><?php esc_html_e('Go to top', 'uok-sfao'); ?></span>
  </button>

  <?php wp_footer(); ?>
</body>
</html>
