<section class="partners">
  <div class="container-fluid">
    <div class="header-circle">
      <div class="circle bg-light"></div>
      <span class="z_h2"><?php the_field('partners-title', icl_object_id(427, 'page', true)) ?></span>
    </div>
    <span class="z_h3"><?php the_field('partners-title2', icl_object_id(427, 'page', true)) ?></span>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="row row-partners justify-content-center align-items-center">
          <?php if (have_rows('partners-items', icl_object_id(427, 'page', true))): while (have_rows('partners-items', icl_object_id(427, 'page', true))) : the_row(); ?>
            <div class="col-auto">
              <div class="img-wrapper"><img src="<?php echo the_sub_field('logo'); ?>" alt=""></div>
            </div>
          <?php endwhile; else : endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
