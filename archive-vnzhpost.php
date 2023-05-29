<?php get_header(); ?>


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


<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
      <!-- <div class="header-circle-title"><?php _e('Creation of', 'prifinance') ?></div> -->
    </div>
    <h1><?php _e('Citizenship', 'prifinance') ?><?php if(get_query_var('paged')>0){echo " <span style=\"display:none\">".get_query_var('paged')."</span>";}?></h1>
    <div class="content">
      <ul class="list-unstyled trustslist block-grid">
        
        <?php
        //НАЧАЛО СПИСКА
        
        $arg_cat = array(
          'taxonomy' => 'vnzh',
          'orderby' => 'name',
          'order' => 'ASC',
          'hide_empty' => 1,
          'exclude' => '',
          'include' => '',
        );
        $categories = get_categories($arg_cat);
        if ($categories) {
          foreach ($categories as $cat) {
            $arg_posts = array(
              'post_type' => 'vnzhpost',
              'posts_per_page' => -1,
                'meta_query' => array(
                    'relation' => 'AND',
                    'order_number' => array(
                        'key' => 'order_number',
                        'compare' => 'EXISTS',
                    ),
                ),
              'meta_key' => 'order_number',
              'orderby' =>'meta_value_num',
              'order' => 'ASC',


              'tax_query' => array(
                array(
                  'taxonomy' => 'vnzh',
                  'field' => 'term_id',
                  'terms' => $cat->term_id,
                ),
              ),
            );
            $query = new WP_Query($arg_posts);
            if ($query->have_posts()) : ?>
              <?php while ($query->have_posts()) : $query->the_post(); ?>
                <li>
                  <img src="<?php the_field('flag'); ?>" class="flagtrasts">
                  <div class="trust-item-inner">
                    <div class="card-img-category"
                         style="background-image:url('<?php the_field('preview-image'); ?>');">
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <a href="<?php the_permalink(); ?>"
                       class="trastbutton btn"><?php _e('More Detailes', 'prifinance') ?></a>
                  </div>
                </li>

              <?php endwhile;
              wp_reset_postdata(); ?>

            <?php endif;
          }
        }  // КОНЕЦ  ?>


      </ul>

    </div>
    <?php if(get_query_var('paged')<1){?>
    <div class="content-text">
      <?php foreach ($categories as $cat) {
        the_field('catetgory_description', $cat);
      } ?>

    </div>
    <?php } ?>


  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>


<?php get_template_part('include/block-partners'); ?>


<?php get_footer(); ?>
