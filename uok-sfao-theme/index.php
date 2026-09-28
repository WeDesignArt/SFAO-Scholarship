<?php
/**
 * The main template file (Latest Build)
 *
 * @package UOK_SFAO
 */

get_header();
?>

    <div class="nav_space"></div>
    <main role="main" class="home_content clearfix py-5">
      <div class="container my-5">
        <?php if (have_posts()) : ?>
          <div class="row">
            <?php while (have_posts()) : the_post(); ?>
              <div class="col-md-6 mb-4">
                <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 shadow-sm border-0'); ?>>
                  <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                      <?php the_post_thumbnail('medium_large', array('class' => 'card-img-top')); ?>
                    </a>
                  <?php endif; ?>
                  <div class="card-body">
                    <h3 class="card-title h5"><a href="<?php the_permalink(); ?>" class="text-reset text-decoration-none"><?php the_title(); ?></a></h3>
                    <div class="card-text text-muted mb-3"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="btn btn-link px-0"><?php esc_html_e('Read More', 'uok-sfao'); ?> &rarr;</a>
                  </div>
                </article>
              </div>
            <?php endwhile; ?>
          </div>

          <div class="pagination-wrapper my-4">
            <?php
              the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '<i class="bi bi-chevron-left"></i>',
                'next_text' => '<i class="bi bi-chevron-right"></i>',
              ));
            ?>
          </div>
        <?php else : ?>
          <div class="alert alert-info"><?php esc_html_e('No posts found.', 'uok-sfao'); ?></div>
        <?php endif; ?>
      </div>
    </main>

<?php
get_footer();
