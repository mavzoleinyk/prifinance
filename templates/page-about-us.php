<?php
/*
Template Name: page about-us
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
<?php
the_field('about-about');
the_field('about-wide');
the_field('about-preim');
team_multilanguage();
get_template_part('include/block-partners');
get_footer();
