<?php
/**
 * Template Name: Stories Page (Latest Build)
 * Mirrors stories.html of the static site; empty ACF fields fall back to the static text.
 *
 * @package UOK_SFAO
 */

get_header();

$banner_title = uok_field('stories_banner_title', 'Stories');
$banner_image = function_exists('get_field') ? get_field('stories_banner_image') : null;
$heading      = uok_field('stories_heading', 'Student Financial Aid Office, University of Karachi (SFAO)');
$subheading   = uok_field('stories_subheading', 'The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the <strong>Honorable Vice Chancellor, University of Karachi, Prof. Dr. Muhammad Tufail Jokhio,</strong> for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.');
?>

    <main role="main" class="home_content nav_space clearfix">

      <section class="section-1 home_hero_slider overflow-hidden">
        <div class="container_content">
          <div class="image-container-top">

            <?php if (is_array($banner_image) && !empty($banner_image['url'])) : ?>
              <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_title); ?>" class="img-fluid w-100">
            <?php endif; ?>

            <div class="overlay-top d-flex flex-column justify-content-center align-items-center text-center">
              <h1 class="text-white h1 mb-4"><?php echo esc_html($banner_title); ?></h1>
            </div>

          </div>
        </div>
      </section>
      <section class="ptb_80 clearfix inner_about color-limegreeen overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40">
                <h2 class="section_title h2 divider_heading center"><?php echo esc_html($heading); ?></h2>
              </div>
              <div class="gray_7">
                <p><?php echo wp_kses_post($subheading); ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="sfao-events-section overflow-hidden ptb_80">
        <div class="container">
          <div class="text-sfao-events" data-aos="fade-up">
            <h2 class="section_title h2 divider_heading center text-center">
              SFAO Events
            </h2>
          </div>
          <div class="image-collage">
            <div class="row" data-aos="fade-left">

              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url(uok_img('uok/img1.png')); ?>" class="img-fluid w-100">
                </div>
              </div>

              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url(uok_img('uok/img2.png')); ?>" class="img-fluid w-100">
                </div>
              </div>

              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url(uok_img('uok/img3.png')); ?>" class="img-fluid w-100">
                </div>
              </div>

              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url(uok_img('uok/img4.png')); ?>" class="img-fluid w-100">
                </div>
              </div>

              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url(uok_img('uok/img5.png')); ?>" class="img-fluid w-100">
                </div>
              </div>

              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url(uok_img('uok/img6.png')); ?>" class="img-fluid w-100">
                </div>
              </div>

            </div>
          </div>
          <div class="seemore" data-aos="fade-up">
            <a href="<?php echo esc_url(uok_page_url('events')); ?>" class="btn btn_fill round_full">See More</a>
          </div>
        </div>
      </section>

      <section class="section  section_content_left clearfix overflow-hidden ptb_40">
        <div class="container_content bg_light_logo">
          <div class="row align-items-center">
            <div class="col-lg-5 order-md-2" data-aos="fade-left">
              <div class="section_image ">
                <img src="<?php echo esc_url(uok_img('pic-vc.jpg')); ?>" alt="immersive" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-right">
                <h2 class="section_content_title divider_heading align-sm-center h2">
                  Message from Honorable Vice Chancellor
                </h2>

                <div class="sub_title h4 my-4 text-cen primary_color">
                  Prof. Dr. Muhammad Tufail
                </div>

                <div class="gray_7 section_para">
                  <p>
                    As the Vice Chancellor of the University of Karachi, I believe that one of the major challenges
                    facing our student’s while pursing high quality education is the financial burden .Here I strongly
                    advocate that the University of Karachi is actively minimizing the of tuition fees of meritorious
                    students and thus making education accessible through the free ship scholarships or merit-need based
                    scholarships offered at the Students Financial Aid Office (SFAO). University of Karachi founding
                    mission is rooted on social equity where academic potential and not financial status, dictates one’s
                    success where financial assistance is an investment to our student’s future growth and development
                    in society. <br>

                    To ensure comprehensive financial coverage, our SFAO works closely with external donors, government
                    institutions, and philanthropic organizations. We are honored to collaborate with key entities like
                    the Higher Education Commission, the Sindh Education Endowment Fund, the Professional Education
                    Foundation, Pakistan Baitul-Maal ,Balochistan Education Endowment Fund , University of Karachi
                    Alumni Association (UKAHA)-USA, Mitsubishi UFJ Foundation Scholarship. Additionally, through
                    specialized programs like the Need-Cum-Merit Based Scholarship out of Provincial Zakat and Ushr
                    Funds, Government of Sindh we provide critical tuition relief to eligible local students. These
                    strategic collaborations allow us to expand our financial safety net every year, offering
                    substantial relief to thousands of undergraduate and postgraduate students. I want to convey my
                    deepest gratitude to our donor partners and alumni networks whose generosity fuels these
                    life-changing grants.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section section_content_right clearfix overflow-hidden ptb_40">
        <div class="container_content">
          <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
              <div class="section_image pt-5 pt-md-0">
                <img src="<?php echo esc_url(uok_img('pic-ic.jpg')); ?>" alt="immersive" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-left">
                <h2 class="section_content_title divider_heading align-sm-center h2">
                  Message from Student Financial Aid Office (SFAO) In charge
                </h2>

                <div class="sub_title h4 my-4 text-cen primary_color">
                  Prof. Dr. Ziasma Haneef Khan
                </div>

                <div class="gray_7 section_para">
                  <p>
                    The SFAO serves as a crucial bridge, connecting bright and deserving students with
                    generous national and international donor organizations.
                    Our mission is to ensure that financial support empowers
                    students to achieve their academic dreams. Through this
                    partnership, students not only receive the aid they need
                    but also have the opportunity to showcase their academic
                    growth and excellence.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="ptb_40 clearfix inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40" data-aos="fade-up">
                <h2 class="section_title h2 stories_heading divider_heading center">Appreciation</h2>
              </div>
              <div data-aos="fade-left">

                <div class="gray_7">
                  <p>The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the
                    Honorable Vice Chancellor, University of Karachi, Prof. Khalid M. Iraqi, for his steadfast support
                    and
                    visionary leadership. His dedication to educational excellence has been a source of inspiration and
                    instrumental to our success.</p>
                </div>
                <div class="gray_7">
                  <p>We are extremely thankful to all our scholarship donor organizations for empowering students
                    through their generous support. Your dedication to fostering educational opportunities has
                    transformed lives, enabling students to pursue their dreams without financial barriers. Thank you
                    for shaping a brighter, more equitable future through your belief in the power of education.</p>
                </div>
                <div class="gray_7">
                  <p>SFAO extends its heartfelt gratitude to IO Digital for their exceptional creative partnership.
                    Designed with absolute
                    precision, this beautiful space has been crafted to best serve the evolving needs of our vibrant
                    community. We sincerely
                    appreciate their dedication to bringing this vision to life, ensuring a seamless and inspiring
                    experience for everyone
                    who visits.</p>
                </div>
                <div class="gray_7">
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
