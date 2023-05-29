<?php
/*
Template Name: page contact
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


      </div>
    </div>
  </div>

<?php $count = 1; ?>
<?php the_post(); ?>

<?php if (have_rows('maps')): while (have_rows('maps')) : the_row(); ?>
  <section class="testimonials" class="<?php echo ($count % 2) ? 'testimonials' : 'application goals'; ?>">
    <div class="container-xxl">
      <div class="row justify-content-center">
        <div class="col-md-10 col-xl-9">
          
          <?php if ($count === 1) : ?>
            <div class="header-circle">
              <div class="circle bg-light c_circle"></div>

            </div>

            <h1 class="the_title" style="margin-bottom: 62px;"><?php _e('Contacts', 'prifinance') ?></h1>
          <?php endif; ?>

          <div class="contact">
            
            <?php the_sub_field('iframe'); ?>


            <div class="blockcontanct">


              <ul class="list-unstyled contactlist">
                <?php the_sub_field('contact-list'); ?>
              </ul>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <?php $count++; ?>
<?php endwhile; else : endif; ?>


<?php get_template_part('include/block-partners'); ?>


<?php get_footer(); ?>
