<?php
/*
Template Name: page consultation
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

<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>
    <h1 class="the_title" style="margin-bottom: 62px;"><?php _e('Consultations', 'prifinance') ?></h1>
    <div class="content content-text">
      <div id="accordion">
        <?php if (have_rows('consults')):while (have_rows('consults')) : the_row(); ?>
          <h3><?php the_sub_field('title'); ?></h3>
          <div class="textaddbank"><?php the_sub_field('desc'); ?></div>
        <?php endwhile; else : endif; ?>
      </div>
    </div>
    <div class="content-text">
      <?php the_content(); ?>
    </div>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>
<?php get_template_part('include/block-payment'); ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#accordion").accordion({
            active: false,
            collapsible: true,
            heightStyle: "content"

        });
    });
</script>
<?php get_footer(); ?>
