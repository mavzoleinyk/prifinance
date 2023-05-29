<?php
$query = $args['query'] ?? '';
$postObjects = getField('featured_propositions');
if (getField('hide_featured_propositions') || (empty($query) || !$query->have_posts()) && empty($postObjects)) return;
?>
<section class="best-offers">
  <div class="container-xxl text-center">
    <div class="header-circle">
      <div class="circle bg-purple"></div>
      <!-- <h2><?php _e('Pricelist', 'prifinance'); ?></h2> -->
    </div>
    <h3 class="text-white"><?php _e('Best Offers', 'prifinance'); ?></h3>
    <div class="splide__container-wrap">
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
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        if (!empty($query)) {
                            while ($query->have_posts()) : $query->the_post();
                                get_template_part('parts/best-offers-li');
                            endwhile;
                        } else {
                            foreach ($postObjects as $post): setup_postdata($post);
                                get_template_part('parts/best-offers-li');
                            endforeach;
                        }
                        wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
