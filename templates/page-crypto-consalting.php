<?php
/*
Template Name: page crypto consalting
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


<div class="container-xxl hero-img-container clearfix page-crypto-consalting">
  <img src="<?= IMAGES_URI ?>afterfonico.png" class="hero-img" alt="">
</div>

<section class="advantages">
  <div class="container-xxl">
    <div class="row justify-content-md-center">
      <div class="col-md-10 col-xl-10">
        
        <?php the_field('crypto-form'); ?>
        
        <?php the_field('crypto-services'); ?>
      </div>
    </div>

  </div>
</section>

<section class="best-offers">
  <div class="container-xxl">
    <div class="row justify-content-md-center">
      <div class="col-md-10 col-xl-10">
        <div class="header-circle">
          <div class="circle bg-light"></div>

        </div>
        <h1 class="the_title" style="margin-bottom: 62px;"><?php the_field('crypto-obmen-header'); ?></h1>
        <p><?php the_field('crypto-obmen-desc'); ?></p>

        <div class="splide__wrapper mx-auto">
          <div class="splide" id="bestOffersSplides">
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
                        <div class="offer-alt">
                            <div class="offer-country"><img src="<?php the_field('flag'); ?>" alt=""></div>
                            <div class="offer-title-alt"><?= get_field('mini_title') ?: get_the_title() ?></div>
                            <div class="offer-text-alt">
                                <?= get_field('service_description', false, false) ?>
                            </div>
                            <div class="offer-price-alt">
                                <?= get_field('price') ?>
                            </div>
                            <?php
                            $services = get_field('services');
                            if (!empty($services)) { ?>
                                <div class="offer-include-alt">
                                    <ul>
                                        <?php foreach ($services as $service) { ?>
                                            <li><?= $service['text'] ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php }
                            ?>
                            <!-- <div class="offer-heading"><?php the_field('mini_title'); ?></div>
                      <p
                        class="offer-text"><?php echo mb_strimwidth(strip_tags(get_the_content(), null), 0, 600, "..."); ?></p> -->
                            <div class="offer-alt-action">
                                <a href="<?php the_permalink(); ?>"
                                   class="btn btn-sm btn-orange"><?php _e('More Detailes', 'prifinance') ?></a>
                            </div>
                        </div>
                    </li>
                <?php endforeach;
                  wp_reset_postdata(); endif; ?>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php the_field('crypto-mining'); ?>

<?php the_field('crypto-pravovoy'); ?>

<?php the_field('crypto-why'); ?>

<?php the_field('crypto-selling'); ?>


<section class="testimonials videophoto">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-9">
        <div class="header-circle title-align-center">
          <div class="circle bg-light"></div>
          <h3><?php the_field('crypto-videos-and-photos-title'); ?></h3>
        </div>
        <div class="masonry-grid">
          <?php if (have_rows('videos-and-photos')):while (have_rows('videos-and-photos')) : the_row(); ?>
            <?php
            $video = get_sub_field('video');
            $image = get_sub_field('photo');
            $masonry_type = get_sub_field('masonry_type');
            ?>
            
            <?php if (!empty($video)): ?>
              <div class="masonry-item  <?= implode($masonry_type, ' ') ?>">
                <a href="//www.youtube.com/embed/<?php echo $video; ?>" data-fancybox="gallery">
                  <img src="//i3.ytimg.com/vi/<?php echo $video; ?>/hqdefault.jpg" alt="">
                  <span class="youtube-play"></span>
                </a>
              </div>
            <?php endif; ?>
            
            <?php if (!empty($image)): ?>
              <div class="masonry-item  <?= implode($masonry_type, ' ') ?>">
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
         <span class="z_h2"><?php the_field('crypto-command-title'); ?></span>
        </div>
       <span class="z_h3"><?php the_field('crypto-command-subtitle'); ?></span>
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
