<?php
/*
Template Name: page fintech
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

<div class="container-xxl hero-img-container clearfix">
  <img src="<?= IMAGES_URI ?>ft1.svg" class="hero-img" alt="">
</div>

<?php the_field('crypto-form'); ?>

<?php the_field('crypto-services'); ?>

<?php the_field('crypto-selling'); ?>


<section class="best-offers page-fintech">
  <div class="container-xxl">
    <div class="row justify-content-md-center">
      <div class="col-md-10 col-xl-10">
        <div class="header-circle">
          <div class="circle bg-light"></div>
          <h1 class="mainH"><?php the_field('crypto-obmen-header'); ?></h1>
        </div>
        <h3><?php the_field('crypto-obmen-desc'); ?></h3>
        <div class="splide__wrapper mx-auto">
          <div class="splide" id="strany">
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
                <?php
                $posts = get_field('crypto-obmen-postsID'); ?>
                <?php if ($posts) : foreach ($posts as $post) : setup_postdata($post) ?>
                  <li class="splide__slide d-flex justify-content-center">
                    <div class="offer fintech-offer">
                      <div class="offer-country"><img src="<?php the_field('flag'); ?>" alt="<?php the_title(); ?>"></div>
                      <div class="fintech-offer-inner">
                        <div class="card-img-category"
                             style="background-image:url('<?php the_field('preview-image'); ?>');"></div>
                        <h3 class="the_title" style="margin-bottom: 62px; text-align: left; font-size: 2.75rem !important;"><?php the_title(); ?></h3>
                        <div class="fintech-offer-more">
                          <a href="<?php the_permalink(); ?>"
                             class="trastbutton btn"><?php _e('More Detailes', 'prifinance') ?></a>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php endforeach;
                  wp_reset_postdata(); endif; ?>

              </ul>
            </div>
          </div>
        </div>
        <p class="afterslider"><?php the_field('crypto-obmen-desc2'); ?></p>
      </div>
    </div>
  </div>
</section>

<section class="testimonials videophoto">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-9">
        <!-- <div class="header-circle">
            <div class="circle bg-light"></div>

        </div> -->
        <h3><?php the_field('crypto-videos-and-photos-title'); ?></h3>
        <div class="masonry-grid">
          <?php if (have_rows('videos-and-photos')):while (have_rows('videos-and-photos')) : the_row(); ?>
            <?php
            $video = get_sub_field('video');
            $image = get_sub_field('photo');
            $masonry_type = get_sub_field('masonry_type');
            ?>

            <?php if (!empty($video)): ?>
              <div class="masonry-item <?= implode($masonry_type, ' ') ?>">
                <a href="//www.youtube.com/embed/<?php echo $video; ?>" data-fancybox="gallery">
                  <img src="//i3.ytimg.com/vi/<?php echo $video; ?>/hqdefault.jpg" alt="">
                  <span class="youtube-play"></span>
                </a>
              </div>
            <?php endif; ?>

            <?php if (!empty($image)): ?>
              <div class="masonry-item <?= implode($masonry_type, ' ') ?>">
                <a href="<?php echo $image; ?>" data-fancybox="gallery">
                  <img src="<?php echo $image; ?>" alt="">
                </a>
              </div>
            <?php endif; ?>


          <?php endwhile; else : endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="testimonials taem">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-10">
        <div class="header-circle">
          <div class="circle bg-light"></div>
          <h2><?php the_field('crypto-command-title'); ?></h2>
        </div>
        <h3><?php the_field('crypto-command-subtitle'); ?></h3>
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
