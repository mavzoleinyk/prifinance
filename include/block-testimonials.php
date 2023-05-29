<section class="testimonials">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-9">
        <div class="header-circle">
          <div class="circle bg-light c_circle"></div>
          <h2><?php the_field('testimonials-title', icl_object_id(427, 'page', true)) ?></h2>
        </div>
        <h3><?php the_field('testimonials-title2', icl_object_id(427, 'page', true)) ?></h3>
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
                    <div class="splide__slide__container mx-auto">
                      <a href="<?php the_sub_field('image-large'); ?>" target="_blank" data-fancybox="gallery"
                         class="certificate-background"><img src="<?php the_sub_field('image-large'); ?>" alt=""></a>
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
  </div>
</section>
