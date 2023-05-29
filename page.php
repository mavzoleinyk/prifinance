<?php get_header(); ?>
<?php get_template_part('parts/hero'); ?>

<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>
    <div class="content">
      <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="content-text">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>
<?php get_template_part('include/block-partners'); ?>
<?php get_footer(); ?>
