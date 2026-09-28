<?php
/**
 * The template for displaying 404 pages (not found) - Latest Build
 *
 * @package UOK_SFAO
 */

get_header();
?>

    <div class="nav_space"></div>
    <main role="main" class="home_content clearfix">
      <section class="nofound py-5 text-center my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <h1 class="display-1 fw-bold text-success mb-3">404</h1>
              <h2 class="h3 fw-bold mb-4"><?php esc_html_e('Oops! Page Not Found', 'uok-sfao'); ?></h2>
              <p class="gray_7 mb-4">
                <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'uok-sfao'); ?>
              </p>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn_fill round_full px-5 py-3">
                <?php esc_html_e('Back To Home', 'uok-sfao'); ?>
              </a>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php
get_footer();
