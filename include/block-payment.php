<section class="payment">
  <div class="container-fluid">
    <div class="header-circle">
      <div class="circle bg-light"></div>
      <!--            <h2>--><?php //the_field('payment-title', icl_object_id(427, 'page', true)) ?><!--</h2>-->
    </div>
    <h3><?php the_field('payment-title2', icl_object_id(427, 'page', true)) ?></h3>
    <div class="row row-logos g-0 justify-content-center align-items-center">
      
      
      <?php if (have_rows('payment-items', icl_object_id(427, 'page', true))): while (have_rows('payment-items', icl_object_id(427, 'page', true))) : the_row(); ?>

        <div class="col-auto">
          <div class="img-wrapper"><img src="<?php echo the_sub_field('logo'); ?>" alt=""></div>
        </div>
      
      <?php endwhile; else : endif; ?>


    </div>
  </div>
</section>
