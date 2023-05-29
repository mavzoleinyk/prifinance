<?php
/*
Template Name: page bank-account
Template Post Type: page
*/
get_header(); ?>
<div class="hero">
  <?php get_template_part('include/top-nav'); ?>
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-xxl-10 mx-auto">
        <header class="d-none d-xl-block">
          <?php get_template_part('include/top-nav-second'); ?>
          <?php get_template_part('include/top-nav-menu'); ?>
        </header>
        <header class="d-xl-none">
          <?php get_template_part('include/top-nav-menu_mobile'); ?>
        </header>
      </div>
    </div>
  </div>
</div>
<?php $cat = get_queried_object(); ?>
<section class="main">
  <div class="content-wrap">
    <div class="category-heading">
        <div class="header-circle">
            <div class="circle bg-light"></div>
        </div>
        <h1 class="the_title"><?= $cat->name; ?><?php if(get_query_var('paged')>0){echo " <span style=\"display:none\">".get_query_var('paged')."</span>";}?></h1>
    </div>
    <div class="content">
      <?php
      //НАЧАЛО СПИСКА

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
        <table class="table table-company-category">
          <thead>
          <tr>
            <th colspan="2"><?php _e('Country of incorporation', 'prifinance') ?></th>
            <?php
            $taxonomyId = get_queried_object()->term_id;
            $with_table_prices = get_field('with_table_prices', 'options');
            $showTablePrice = in_array($taxonomyId, $with_table_prices);
            ?>
            <th><?php _e('Registration fee', 'prifinance') ?></th>
            <?php if ($showTablePrice) { ?>
              <th><?php _e('Apostilled package', 'prifinance') ?></th>
              <th><?php _e('Nominee service', 'prifinance') ?></th>
              <th><?php _e('Annual renewal', 'prifinance') ?></th>
              <th><?php _e('Accounting', 'prifinance') ?></th>
            <?php } ?>
          </tr>
          </thead>
          <tbody>
          <?php while ($query->have_posts()) : $query->the_post();
            $title = get_field('mini_title') ? get_field('mini_title') : get_the_title();
            $prices = get_table_prices();
            ?>
          <?php //!$showTablePrice ? 'width: 50%' : ''  ?>
            <tr>
              <td class="table-company-category-title"
                  aria-label="<?php _e('Country of incorporation', 'prifinance') ?>"><a
                  href="<?php the_permalink(); ?>"><?= $title; ?></a></td>
              <td class="table-company-category-btn" aria-label=""><div
                                                                      class="btn-get-offer"><?php _e('GET AN OFFER', 'prifinance') ?></div>
              </td>
              <td
                aria-label="<?php _e('Registration fee', 'prifinance') ?>"><?= $prices['total_cost'] ?></td>
              <?php if ($showTablePrice) { ?>
                <td
                  aria-label="<?php _e('Apostilled package', 'prifinance') ?>"><?= $prices['apostilled'] ?></td>
                <td
                  aria-label="<?php _e('Nominee service', 'prifinance') ?>"><?= $prices['nominee'] ?></td>
                <td
                  aria-label="<?= _e('Annual renewal', 'prifinance') ?>"><?= $prices['annual'] ?></td>
                <td
                  aria-label="<?php _e('Accounting', 'prifinance') ?>" class="accounting"><img
                    src="<?= IMAGES_URI . (get_field('reporting') ? 'check' : 'close') ?>.svg"></td>
              <?php } ?>
            </tr>
          <?php endwhile;
          wp_reset_postdata(); ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
    <div class="c_section testimonials">
      <div class="col-md-12 col-xl-12">
        <div class="header-circle">
          <div class="circle bg-light c_circle"></div>
          <h2><?php the_field('testimonials-title', icl_object_id(427, 'page', true)) ?></h2>
        </div>
        <h3 class="mainH"><?php the_field('testimonials-title2', icl_object_id(427, 'page', true)) ?></h3>
        <div class="splide__wrapper mx-auto">
          <div class="splide" id="testimonialsSplide">
            <div class="splide__arrows">
              <button class="splide__arrow splide__arrow--prev">
                <img src="<?= IMAGES_URI ?>arrow-left.svg" alt="">
              </button>
              <button class="splide__arrow splide__arrow--next">
                <img src="<?= IMAGES_URI ?>arrow-right.svg" alt="">
              </button>
            </div>
            <div class="splide__track">
              <ul class="splide__list">
                <?php if (have_rows('testimonials-items', icl_object_id(427, 'page', true))): while (have_rows('testimonials-items', icl_object_id(427, 'page', true))) : the_row(); ?>
                  <li class="splide__slide">
                    <div class="splide__slide__container">
                      <a href="<?php the_sub_field('image-large'); ?>" target="_blank" class="certificate-background"
                         data-fancybox="gallery"><img
                          src="<?php the_sub_field('image-large'); ?>" alt=""></a>
                      <div class="splide__slide__caption">
                        <div><?php the_sub_field('title'); ?></div>
                        <div><?php the_sub_field('desc'); ?></div>
                      </div>
                    </div>
                  </li>
                <?php endwhile; else : endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
     <?php if(get_query_var('paged')<1){?>
    <div class="content-text">
      <?php the_field('catetgory_description', $cat); ?>
    </div>
    <?php } ?>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>
<?php
get_template_part('include/block-partners');
get_footer();
?>
