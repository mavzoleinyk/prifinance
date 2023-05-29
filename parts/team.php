<?php
$rows_option = isset($args['prefix']) ? $args['prefix'] . '_experts' : 'experts';

if (have_rows($rows_option, 'option')): while (have_rows($rows_option, 'option')) : the_row();
?>
<section class="testimonials coachtallin">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-9">
        <div class="header-circle">
          <div class="circle bg-light"></div>
          <span class="z_h2"><?php the_sub_field('about-photos-title'); ?></span>
        </div>
        <span class="z_h3"><?php the_sub_field('about-photos-title2'); ?></span>
          
          <?php the_sub_field('about-photos-desc'); ?>
        <div class="masonry masonry--about masonry-flex">
            <?php if (get_sub_field('about-photos')): while (has_sub_field('about-photos')):
                $image = get_sub_field('photo');
                ?>
              <div class="masonry-item">
                <div>
                  <img src="<?php echo $image; ?>" alt="">
                    <?php if (!empty(get_sub_field('name'))): ?>
                      <p><?php the_sub_field('name'); ?> <span><?php the_sub_field('position'); ?></span></p>
                    <?php endif; ?>
                </div>
              </div>
            <?php endwhile; else : endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; else : endif;
