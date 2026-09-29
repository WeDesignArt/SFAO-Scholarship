<?php
/**
 * Front Page Template — mirrors index.html of the static site.
 * Every ACF field falls back to the static text via uok_field().
 *
 * @package UOK_SFAO
 */

get_header();

$hero_desktop = uok_img_field('hero_image_desktop', 'main_homepage.jpg');
$hero_mobile  = uok_img_field('hero_image_mobile', 'main_homepage.jpg');

$about_title = uok_field('about_title', 'Student Financial Aid Office, University of Karachi (SFAO)');
$about_desc  = uok_field('about_description', 'The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the <strong>Honorable Vice Chancellor, University of Karachi, Prof. Dr. Muhammad Tufail Jokhio,</strong> for his steadfast support and visionary leadership. His dedication to educational excellence has been a source of inspiration and instrumental to our success.');

$vc_image   = uok_img_field('vc_image', 'pic-vc.jpg');
$vc_heading = uok_field('vc_heading', 'Message from Honorable Vice Chancellor');
$vc_name    = uok_field('vc_name', 'Prof. Dr. Muhammad Tufail Jokhio');
$vc_message = uok_field('vc_message', 'As the Vice Chancellor of the University of Karachi, I believe that one of the major challenges facing our student’s while pursing high quality education is the financial burden .Here I strongly advocate that the University of Karachi is actively minimizing the of tuition fees of meritorious students and thus making education accessible through the free ship scholarships or merit-need based scholarships offered at the Students Financial Aid Office (SFAO). University of Karachi founding mission is rooted on social equity where academic potential and not financial status, dictates one’s success where financial assistance is an investment to our student’s future growth and development in society. <br> To ensure comprehensive financial coverage, our SFAO works closely with external donors, government institutions, and philanthropic organizations. We are honored to collaborate with key entities like the Higher Education Commission, the Sindh Education Endowment Fund, the Professional Education Foundation, Pakistan Baitul-Maal ,Balochistan Education Endowment Fund , University of Karachi Alumni Association (UKAHA)-USA, Mitsubishi UFJ Foundation Scholarship. Additionally, through specialized programs like the Need-Cum-Merit Based Scholarship out of Provincial Zakat and Ushr Funds, Government of Sindh we provide critical tuition relief to eligible local students. These strategic collaborations allow us to expand our financial safety net every year, offering substantial relief to thousands of undergraduate and postgraduate students. I want to convey my deepest gratitude to our donor partners and alumni networks whose generosity fuels these life-changing grants.');

$ic_image   = uok_img_field('incharge_image', 'pic-ic.jpg');
$ic_heading = uok_field('incharge_heading', 'Message from Student Financial Aid Office (SFAO) In charge');
$ic_name    = uok_field('incharge_name', 'Prof. Dr. Ziasma Haneef Khan');
$ic_message = uok_field('incharge_message', 'The SFAO serves as a crucial bridge, connecting bright and deserving students with generous national and international donor organizations. Our mission is to ensure that financial support empowers students to achieve their academic dreams. Through this partnership, students not only receive the aid they need but also have the opportunity to showcase their academic growth and excellence.');

$app_heading = uok_field('appreciation_heading', 'Appreciation');
$events_title = uok_field('events_section_title', 'SFAO Events');
$faq_title    = uok_field('faq_section_title', 'Frequently Asked Questions (FAQs) for University Scholarships');
$faq_subtitle = uok_field('faq_section_subtitle', 'Only when different values, experiences and perspectives are met with free and open discourse can education be truly transformative..');
?>

    <main role="main" class="home_content nav_space clearfix">
      <!-- hero start -->
      <section class="home_hero_slider hero-font ">
        <div class="container_content ">
          <div class="hero_wrapper">
            <picture>
              <source media="(max-width: 767.98px)" srcset="<?php echo esc_url($hero_mobile); ?>" />
              <img src="<?php echo esc_url($hero_desktop); ?>" alt="Hero Image" class="w-100 d-block" />
            </picture>
          </div>
        </div>
      </section>
      <!-- hero end -->

      <!-- ===== NEWS TICKER (Theme Settings > News Ticker) ===== -->
      <?php
        $ticker_items = uok_field('ticker_items', array(), 'option');
        $ticker_texts = array();
        foreach ((array) $ticker_items as $t_item) {
          if (!empty($t_item['ticker_text'])) $ticker_texts[] = $t_item['ticker_text'];
        }
        if (empty($ticker_texts)) {
          $ticker_texts = array('Haier Pakistan Funded Scholarship 2026&#8211;27 &mdash; Applications must be submitted no later than October 15, 2026.');
        }
      ?>
      <div class="sfao-ticker-bar">
        <div class="sfao-ticker-label">
          <span>&#128227;</span> SFAO News
        </div>
        <div class="sfao-ticker-track-wrapper">
          <div class="sfao-ticker-track">
            <?php // The scroll animation moves -50%, so the list is rendered twice for a seamless loop. ?>
            <?php for ($pass = 0; $pass < 2; $pass++) : foreach ($ticker_texts as $t_text) : ?>
              <span class="sfao-ticker-item"><?php echo wp_kses_post($t_text); ?></span>
            <?php endforeach; endfor; ?>
          </div>
        </div>
      </div>
      <!-- ===== NEWS TICKER END ===== -->

      <!-- about home start -->
      <section class="ptb_80 clearfix inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40">
                <h2 class="section_title h2 divider_heading center">
                  <?php echo esc_html($about_title); ?>
                </h2>
              </div>

              <div class="gray_7">
                <p><?php echo wp_kses_post($about_desc); ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- about home end -->

      <!-- vc start -->
      <section class="section  section_content_left clearfix overflow-hidden ptb_40">
        <div class="container_content bg_light_logo">
          <div class="row align-items-center">
            <div class="col-lg-5 order-md-2" data-aos="fade-left">
              <div class="section_image ">
                <img src="<?php echo esc_url($vc_image); ?>" alt="immersive" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-right">
                <h2 class="section_content_title divider_heading align-sm-center h2">
                  <?php echo esc_html($vc_heading); ?>
                </h2>

                <div class="sub_title h4 my-4 text-cen primary_color">
                  <?php echo esc_html($vc_name); ?>
                </div>

                <div class="gray_7 section_para">
                  <p><?php echo wp_kses_post($vc_message); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- vc end -->

      <!-- incharge  start -->
      <section class="section section_content_right clearfix overflow-hidden ptb_40">
        <div class="container_content">
          <div class="row align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
              <div class="section_image pt-5 pt-md-0">
                <img src="<?php echo esc_url($ic_image); ?>" alt="immersive" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-left">
                <h2 class="section_content_title divider_heading align-sm-center h2">
                  <?php echo esc_html($ic_heading); ?>
                </h2>

                <div class="sub_title h4 my-4 text-cen primary_color">
                  <?php echo esc_html($ic_name); ?>
                </div>

                <div class="gray_7 section_para">
                  <p><?php echo wp_kses_post($ic_message); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- incharge  end -->

      <!-- shcolarships start -->
      <section class="ptb_40 clearfix overflow-hidden bg_light_logo">
        <div class="container_content">
          <section class="pt_60 text-center">
            <div class="section_intro mb_60 fw_md h4 col-lg-9 col-xl-8 mx-auto text-center" data-aos="fade-left">
              <h2 class="section_title h2 divider_heading center">
                Scholarship Opportunities
              </h2>

              <div class="gray_7 col-lg-12 d-inline-block">
                <p>
                  Since 2006, the University has grown student support from Rs. 6 million to over Rs. 200 million,
                  benefiting 2,000+ students through merit and need-based aid. The program also expanded postgraduate
                  scholarships and continues to focus on inclusivity and long-term sustainability.
                </p>
              </div>
            </div>
          </section>

          <div class="col-xl-10 col-lg-11 mx-auto">
            <div class="scholarship_cards_container">
              <div class="row g-4 ps-2 ps-lg-0">
                <?php
                  // Scholarships with a "Home Page Position" (1, 2, 3...), in that order.
                  $home_scholarships = get_posts(array(
                    'post_type'      => 'scholarship',
                    'posts_per_page' => 3,
                    'meta_key'       => 'home_position',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'ASC',
                    'meta_query'     => array(array('key' => 'home_position', 'value' => 0, 'compare' => '>', 'type' => 'NUMERIC')),
                  ));
                  foreach ($home_scholarships as $sch) :
                    $closed = strtolower((string) get_field('scholarship_status', $sch->ID)) !== 'open';
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="icon_box_single bordered round_xl" data-aos="fade-up">
                    <div class="icon_box_single_header">
                      <h2 class="icon_box_single_header_title">
                        <?php echo esc_html(uok_field('home_card_title', get_the_title($sch), $sch->ID)); ?>
                      </h2>
                    </div>

                    <div class="icon_box_single_footer">
                      <a href="<?php echo esc_url(get_permalink($sch)); ?>" class="btn btn_fill round_xl<?php echo $closed ? ' btn-apply-closed' : ''; ?>"><?php echo $closed ? 'Applications Closed' : 'View Details'; ?></a>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <div class="seemore mt-4 text-center" data-aos="fade-up">
                <a href="<?php echo esc_url(get_post_type_archive_link('scholarship') . '#scholarship-section'); ?>" class="btn btn_fill round_full">See More
                  Scholarships</a>
              </div>
            </div>

          </div>
        </div>
      </section>
      <!-- shcolarships end -->

      <!-- ================= AWARDEES SECTION ================= -->
      <section class="sfao-awardees-section ptb_80 overflow-hidden">
        <div class="container">
          <div class="section_intro mb_40 text-center" data-aos="fade-up">
            <h2 class="section_title h2 divider_heading center">
              Scholarship Awardees
            </h2>
            <p class="gray_7 col-lg-7 mx-auto">
              SFAO proudly congratulates the students selected for the
              <strong>Scholarships 2025&#8211;26</strong>.
              Your dedication and hard work have earned this recognition.
            </p>
          </div>

          <div class="row g-4 justify-content-center" data-aos="fade-up">
            <?php
              $awardees = get_posts(array('post_type' => 'awardee', 'posts_per_page' => 4));
              if ($awardees) :
                foreach ($awardees as $aw) :
                  $initials = uok_field('awardee_initials', strtoupper(substr($aw->post_title, 0, 2)), $aw->ID);
            ?>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="awardee-card">
                <div class="awardee-avatar"><?php echo esc_html($initials); ?></div>
                <div class="awardee-name"><?php echo esc_html($aw->post_title); ?></div>
                <div class="awardee-scholarship"><?php echo wp_kses_post(uok_field('awardee_program', '', $aw->ID)); ?></div>
                <div class="awardee-badge">Congratulations!</div>
              </div>
            </div>
            <?php endforeach; else : ?>
            <!-- Awardee 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="awardee-card">
                <div class="awardee-avatar">AK</div>
                <div class="awardee-name">Ahmed Khan</div>
                <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                <div class="awardee-badge">Congratulations!</div>
              </div>
            </div>
            <!-- Awardee 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="awardee-card">
                <div class="awardee-avatar">SF</div>
                <div class="awardee-name">Sara Fatima</div>
                <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                <div class="awardee-badge">Congratulations!</div>
              </div>
            </div>
            <!-- Awardee 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="awardee-card">
                <div class="awardee-avatar">MH</div>
                <div class="awardee-name">Muhammad Hassan</div>
                <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                <div class="awardee-badge">Congratulations!</div>
              </div>
            </div>
            <!-- Awardee 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="awardee-card">
                <div class="awardee-avatar">FN</div>
                <div class="awardee-name">Fatima Noor</div>
                <div class="awardee-scholarship">Mitsubishi UFJ Foundation<br>Scholarship 2025&#8211;26</div>
                <div class="awardee-badge">Congratulations!</div>
              </div>
            </div>
            <?php endif; ?>
          </div>

          <div class="seemore mt-4 text-center" data-aos="fade-up">
            <a href="<?php echo esc_url(uok_page_url('awardees')); ?>" class="btn btn_fill round_full">See All Awardees</a>
          </div>
        </div>
      </section>
      <!-- ================= AWARDEES SECTION END ================= -->

      <section class="ptb_40 clearfix sfao_appreciation inner_about overflow-hidden">
        <div class="container">
          <div class="row g-0 justify-content-center">
            <div class="col-11 text-center">
              <div class="section_intro m-13 m-lg-15 mb_40" data-aos="fade-up">
                <h2 class="section_title h2  stories_heading divider_heading center">
                  <?php echo esc_html($app_heading); ?>
                </h2>
              </div>

              <div data-aos="fade-right">
                <?php if (function_exists('have_rows') && have_rows('appreciation_paragraphs')) : ?>
                  <?php while (have_rows('appreciation_paragraphs')) : the_row(); ?>
                    <div class="gray_7">
                      <p><?php echo wp_kses_post(get_sub_field('paragraph_text')); ?></p>
                    </div>
                  <?php endwhile; ?>
                <?php else : ?>
                <div class="gray_7">
                  <p>The Student Financial Aid Office, University of Karachi, extends its deepest gratitude to the
                    Honorable Vice Chancellor, University of Karachi, Prof. Dr. Muhammad Tufail Jokhio, for his
                    steadfast support and visionary leadership. His dedication to educational excellence has been a
                    source of inspiration and instrumental to our success.</p>
                </div>
                <div class="gray_7">
                  <p>We are extremely thankful to all our scholarship donor organizations for empowering students
                    through their generous support. Your dedication to fostering educational opportunities has
                    transformed lives, enabling students to pursue their dreams without financial barriers. Thank you
                    for shaping a brighter, more equitable future through your belief in the power of education.</p>
                </div>
                <div class="gray_7">
                  <p>SFAO extends its heartfelt gratitude to IO Digital for their exceptional creative partnership.
                    Designed with absolute precision, this beautiful space has been crafted to best serve the evolving
                    needs of our vibrant community. We sincerely appreciate their dedication to bringing this vision to
                    life, ensuring a seamless and inspiring experience for everyone who visits.</p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="sfao-events-section overflow-hidden color-limegreeen ">
        <div class="container">
          <div class="text-sfao-events" data-aos="fade-up">
            <h2 class="section_title h2 divider_heading center text-center">
              <?php echo esc_html($events_title); ?>
            </h2>
          </div>
          <div class="image-collage">
            <div class="row" data-aos="fade-left">
              <?php
                $gallery = uok_field('sfao_events_gallery', array());
                $event_imgs = array();
                foreach ((array) $gallery as $img) {
                  if (!empty($img['url'])) $event_imgs[] = $img['url'];
                }
                if (empty($event_imgs)) {
                  foreach (array('sfao-events-26-1.png', 'sfao-events-26-2.png', 'sfao-events-26-3.jpeg', 'sfao-events-26-4.png', 'sfao-events-26-5.jpeg') as $file) {
                    $event_imgs[] = uok_img('uok/events-26/' . $file);
                  }
                }
                foreach ($event_imgs as $url) :
              ?>
              <div class="col-md-4">
                <div class="image-box">
                  <img src="<?php echo esc_url($url); ?>" class="img-fluid w-100">
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="seemore" data-aos="fade-up">
            <a href="<?php echo esc_url(uok_page_url('events')); ?>" class="btn btn_fill round_full">See More</a>
          </div>
        </div>
      </section>

      <section class="section section_content_left clearfix overflow-hidden ptb_60" id="faq">
        <div class="container_content">
          <div class="row align-items-center">
            <div class="col-lg-5 order-md-2" data-aos="fade-left">
              <div class="section_image custom-size">
                <img src="<?php echo esc_url(uok_img('dpa.jpg')); ?>" alt="immersive" />
              </div>
            </div>

            <div class="col-lg-7">
              <div class="section_content" data-aos="fade-right">
                <h2 class="section_content_title divider_heading h2">
                  <?php echo esc_html($faq_title); ?>
                </h2>

                <div class="gray_7">
                  <p><?php echo esc_html($faq_subtitle); ?></p>
                </div>

                <article class="faq_accord">
                  <?php
                    $faqs = array();
                    if (function_exists('have_rows') && have_rows('faq_items')) {
                      while (have_rows('faq_items')) {
                        the_row();
                        $faqs[] = array(get_sub_field('faq_question'), get_sub_field('faq_answer'));
                      }
                    } else {
                      $faqs = array(
                        array('How many scholarship slots are available, and what is the award amount for Sindh HEC indigenous?', '63 scholarship slots are provided in 2023-24. Each successful candidate is rewarded Rs. 230,000.'),
                        array('How long is the HEC need-based scholarship duration, and what is the award amount?', 'As per HEC policy subject to allocation and release of funds for this purpose.'),
                        array('Which departments/faculties are eligible for the Bismillah Bibi & Mrs. Talat Jamil Scholarship?', 'Merit-based scholarships for students in departments under the faculties of Science & Pharmacy. Morning Program students are eligible.'),
                        array('Where can I find details about the scholarship interview, including time and venue?', 'All the information will be available on the Karachi University website. <a href="https://uok.edu.pk/sfao/scholarships.php ">https://uok.edu.pk/sfao/scholarships.php</a>'),
                      );
                    }
                    foreach ($faqs as $i => $faq) :
                  ?>
                  <div class="faq_single">
                    <h5 class="faq_single_title btn_faq<?php echo $i === 0 ? ' active' : ''; ?>">
                      <span><?php echo esc_html($faq[0]); ?></span>
                      <i class="bi bi-plus-lg"></i>
                    </h5>
                    <div class="faq_single_content">
                      <?php echo wp_kses_post($faq[1]); ?>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

<?php
get_footer();
