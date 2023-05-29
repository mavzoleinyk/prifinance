<?php
/*
Template Name: page category license
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
      <div class="circle bg-lighter"></div>
    </div>
    <h1 class="the_title"><?php echo get_term_current('licensetax')->name ?></h1>
    <div class="content">
      <?php get_template_part('parts/licensepost-with-image'); ?>
    </div>

    <div class="content-text">
      <?php the_content(); ?>
    </div>
    <?php get_template_part('include/block-text'); ?>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>


<?php get_template_part('include/block-partners'); ?>


<?php get_footer(); ?>
