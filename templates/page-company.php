<?php
/*
Template Name: page company
Template Post Type: page
*/
?>



<?php get_header(); ?>


<div class="hero">

  <?php get_template_part('include/top-nav'); ?>

  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-xxl-10 mx-auto">

        <header class="d-none d-xl-block-custom">
          <?php get_template_part('include/top-nav-second'); ?>
          <?php get_template_part('include/top-nav-menu'); ?>
        </header>

        <header class="d-xl-none-custom">
          <?php get_template_part('include/top-nav-menu_mobile'); ?>
        </header>
      </div>
    </div>
  </div>
</div>


<section class="main">
  <div class="content-wrap">

    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>
    <h1 class="the_title registration-bank-page-title" ><?php _e('Country of incorporation', 'prifinance') ?></h1>
    <div class="content">
      <?php
      //НАЧАЛО СПИСКА

      $arg_cat = array(
        'taxonomy' => 'category',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 1,
        'exclude' => '',
        'include' => '',
        //'include'      => array( 69, 74, 70,26 ),
      );
      $categories = get_categories($arg_cat);
      if ($categories) {
        foreach ($categories as $cat) {
          $arg_posts = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'meta_key' => 'mini_title',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $cat->term_id,
              ),
            ),
          );
          $query = new WP_Query($arg_posts);


          if ($query->have_posts()) : ?>
            <p class="registration-bank-title"><a href="<?php echo get_category_link($cat->term_id); ?>">
                <?php // echo $cat->name; ?>
                <?php the_field('category_title-mini', $cat); ?>
              </a></p>

            <table class="table table-company-category">
              <thead>
              <tr>
                <th colspan="2"><?php _e('Country of incorporation', 'prifinance') ?></th>
                <th><?php _e('Registration fee', 'prifinance') ?></th>

              </tr>
              </thead>
              <tbody>
              <?php while ($query->have_posts()) : $query->the_post();
                $title = get_field('mini_title') ? get_field('mini_title') : get_the_title();
                $prices = get_table_prices();
                ?>
                <tr>
                  <td class="table-company-category-title"
                      aria-label="<?php _e('Country of incorporation', 'prifinance') ?>"><a
                      href="<?php the_permalink(); ?>"><?php echo $title; ?></a></td>
                  <td class="table-company-category-btn" aria-label=""><div
                                                                          class="btn-get-offer"><?php _e('GET AN OFFER', 'prifinance') ?></div>
                  </td>
                  <td
                    aria-label="<?php _e('Registration fee', 'prifinance') ?>"><?= $prices['total_cost'] ?></td>
                </tr>

              <?php endwhile;
              wp_reset_postdata(); ?>
              </tbody>
            </table>
          <?php endif;
        }
      }
      // КОНЕЦ
      ?>
    </div>
    <div class="content-text">
      <?php the_content(); ?>
    </div>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>

<?php get_template_part('parts/steps'); ?>
<?php get_template_part('include/block-partners'); ?>


<?php get_footer(); ?>
