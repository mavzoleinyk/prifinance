<?php  get_header(); ?>


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


<!-- после вывода категорий-->
<?php var_dump(do_shortcode('[best-offers]')); ?>
<section class="best-offers">
  <div class="container-xxl text-center">
    <div class="header-circle">
      <div class="circle bg-purple"></div>
      <h1 class="mainH"><?php _e('Pricelist', 'prifinance'); ?></h1>
    </div>
    <h3 class="text-white"><?php _e('Best Offers', 'prifinance'); ?></h3>
    <div class="splide__wrapper mx-auto">
      <div class="splide splide--slide splide--ltr splide--draggable is-active" id="bestOffersSplide"
           style="visibility: visible;">
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev" aria-controls="bestOffersSplide-track"
                  aria-label="Go to last slide">
            <img src="<?= IMAGES_URI ?>arrow-left.svg" alt="">
          </button>
          <button class="splide__arrow splide__arrow--next" aria-controls="bestOffersSplide-track"
                  aria-label="Next slide">
            <img src="<?= IMAGES_URI ?>arrow-right.svg" alt="">
          </button>
        </div>
        <div class="splide__track" id="bestOffersSplide-track">
          <ul class="splide__list" id="bestOffersSplide-list" style="transform: translateX(0px);">
            <li class="splide__slide d-flex justify-content-center is-active is-visible" id="bestOffersSplide-slide01"
                aria-hidden="false" tabindex="0" style="margin-right: 20px; width: 255px;">
              <div class="offer">
                <div class="offer-country"><img src="<?= IMAGES_URI ?>icon.svg" alt=""></div>
                <div class="offer-heading">in Ireland</div>
                <div class="offer-price d-flex align-items-center justify-content-center"><span>from</span> 1125
                  <span>$</span></div>
                <p class="offer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                <div class="offer-action">
                  <button class="btn btn-sm btn-orange">LET’S TRY</button>
                </div>
              </div>
            </li>
            <li class="splide__slide d-flex justify-content-center is-visible" id="bestOffersSplide-slide02"
                aria-hidden="false" tabindex="0" style="margin-right: 20px; width: 255px;">
              <div class="offer">
                <div class="offer-country"><img src="<?= IMAGES_URI ?>icon-gb.svg" alt=""></div>
                <div class="offer-heading">in United Kingdom</div>
                <div class="offer-price d-flex align-items-center justify-content-center"><span>from</span> 900
                  <span>$</span></div>
                <p class="offer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                <div class="offer-action">
                  <button class="btn btn-sm btn-orange">LET’S TRY</button>
                </div>
              </div>
            </li>
            <li class="splide__slide d-flex justify-content-center is-visible" id="bestOffersSplide-slide03"
                aria-hidden="false" tabindex="0" style="margin-right: 20px; width: 255px;">
              <div class="offer">
                <div class="offer-country"><img src="<?= IMAGES_URI ?>icon-cad.svg" alt=""></div>
                <div class="offer-heading">in Canada</div>
                <div class="offer-price d-flex align-items-center justify-content-center"><span>from</span> 1150
                  <span>$</span></div>
                <p class="offer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                <div class="offer-action">
                  <button class="btn btn-sm btn-orange">LET’S TRY</button>
                </div>
              </div>
            </li>
            <li class="splide__slide d-flex justify-content-center is-visible" id="bestOffersSplide-slide04"
                aria-hidden="false" tabindex="0" style="margin-right: 20px; width: 255px;">
              <div class="offer">
                <div class="offer-country"><img src="<?= IMAGES_URI ?>icon-au.svg" alt=""></div>
                <div class="offer-heading">in Australia</div>
                <div class="offer-price d-flex align-items-center justify-content-center"><span>from</span> 750
                  <span>$</span></div>
                <p class="offer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                <div class="offer-action">
                  <button class="btn btn-sm btn-orange">LET’S TRY</button>
                </div>
              </div>
            </li>
            <li class="splide__slide d-flex justify-content-center" id="bestOffersSplide-slide05"
                style="margin-right: 20px; width: 255px;">
              <div class="offer">
                <div class="offer-country"><img src="<?= IMAGES_URI ?>icon-ua.svg" alt=""></div>
                <div class="offer-heading">in Ukraine</div>
                <div class="offer-price d-flex align-items-center justify-content-center"><span>from</span> 700
                  <span>$</span></div>
                <p class="offer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                  incididunt ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                <div class="offer-action">
                  <button class="btn btn-sm btn-orange">LET’S TRY</button>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ./после вывода категорий-->

<?php get_template_part('include/block-payment'); ?>


<?php get_footer(); ?>
