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
      <!-- <h2><?php _e('Creation of', 'prifinance') ?></h2> -->
    </div>
    <h1 class="mainH"><?php _e('Founds and trasts', 'prifinance') ?></h1>
    <div class="content">


      <ul class="list-unstyled trustslist block-grid">
        
        <?php
        //НАЧАЛО СПИСКА
        
        $arg_cat = array(
          'taxonomy' => 'fondi',
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
              'post_type' => 'fondi-i-trusti',
              'posts_per_page' => -1,
              'tax_query' => array(
                array(
                  'taxonomy' => 'fondi',
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
    <div class="content-text">
      <?php foreach ($categories as $cat) {
        the_field('catetgory_description', $cat);
      } ?>

    </div>


  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>


<?php get_template_part('include/block-partners'); ?>


<?php get_footer(); ?>
