<?php
/*
Template Name: page AML audit
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
      <?php the_field('crypto-header'); ?>

    </div>
  </div>
</div>


<?php the_field('aml-code'); ?>


<section class="testimonials taem">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-10">
        <div class="header-circle">
          <div class="circle bg-light"></div>
          <h3 class="mainH"><?php the_field('crypto-command-title'); ?></h3>
        </div>
        <h1 class="the_title" style="margin-bottom: 62px;"><?php the_field('crypto-command-subtitle'); ?></h1>
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
                <?php if (have_rows('commands')):while (have_rows('commands')) : the_row(); ?>

                  <li class="splide__slide">
                    <div class="splide__slide__container mx-auto">
                      <img src="<?php the_sub_field('photo'); ?>" alt="">
                      <div class="splide__slide__caption">
                        <div class="nameemp"><?php the_sub_field('name'); ?></div>
                        <div class="text"><?php the_sub_field('position'); ?></div>
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
  </div>
</section>

<?php get_template_part('include/block-clients'); ?>


<?php get_footer(); ?>
