<?php 
/*
Template Name: page 404
Template Post Type: page
*/
get_header(); ?>


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
<!-- <section class="testimonials banc-f"> -->
<section class="main">
  <div class="content-wrap" style="width: 100%;">
  
    <div class="content" style="font-size: 9em; text-align: center">
     404
    </div>
    <div class="content-text" style="text-align: center; font-size: 2em;">
     страница не найдена
    </div>
  </div>
 
</section>
<?php
get_footer();
?>
