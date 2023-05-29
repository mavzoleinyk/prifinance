<?php   get_header(); ?>

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
      
      
      <?php the_field('home_banner', icl_object_id(427, 'page', true)) ?>


    </div>
  </div>
</div>

<?php the_field('home_banner-img', icl_object_id(427, 'page', true)) ?>


<?php the_field('home_about', icl_object_id(427, 'page', true)) ?>


<?php the_field('home_advantages', icl_object_id(427, 'page', true)) ?>




<?php get_template_part('include/block-news'); ?>

<?php get_template_part('include/block-testimonials'); ?>


<!-- доработать форму -->
<?php get_template_part('include/personal-offer-form'); ?>
<!-- ./доработать форму -->


<?php get_template_part('include/block-partners'); ?>


<?php echo do_shortcode('[best-offers]'); ?>


<?php get_template_part('include/block-payment'); ?>


<?php get_footer(); ?>
