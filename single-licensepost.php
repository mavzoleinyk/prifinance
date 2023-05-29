<?php get_header(); ?>

<?php the_post(); ?>

<div class="hero bg-white-png" style="background-image: url('<?php the_field('full-image') ?>')">
  
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

      <div class="col-xl-10">
        <div class="row row-text">
          <div class="col-sm-9 col-md-8 col-xxl-7 foundtrast">
            <h1 class="text-white"><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>


<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>

    <div class="content">
      
      
      <?php if (have_rows('contents')): while (have_rows('contents')) : the_row(); ?>

        <div class="content-text content-trust">
          <?php the_sub_field('content'); ?>
        </div>
      
      <?php endwhile; else : endif; ?>

    </div>

  </div>


  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>

</section>


<?php get_template_part('include/block-partners'); ?>


<link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
<script>
    new SimpleBar(document.querySelector('.foundtrast'));
</script>

<?php get_footer(); ?>
