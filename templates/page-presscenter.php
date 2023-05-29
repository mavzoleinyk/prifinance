<?php
/*
Template Name: page press centr
Template Post Type: page
*/
get_header();
?>

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
      <div class="col-xl-10">
        <div class="row row-text">
          <div class="col-sm-9 col-md-8 col-xxl-7 pressheadcontact-col">
            <h1 class="text-white"><?php _e('Learn more about us from news and articles', 'prifinance') ?><br><span
                class="text-accent text-primary"><?php _e('Press center', 'prifinance') ?> </span></h1>
            <ul class="pressheadcontact list-unstyled">
              <li>
                <img src="<?= IMAGES_URI ?>pico1.svg" alt="">
                <p>+7 495 133 94 64<br><span>ПН-ПТ с 09:00 до 19:00</span></p>
              </li>
              <li>
                <img src="<?= IMAGES_URI ?>pico2.svg" alt="">
                <p>Елена Никитина<br><span>ПРЕСС-СЕКРЕТАРЬ</span></p>
              </li>
              <li>
                <img src="<?= IMAGES_URI ?>pico3.svg" alt="">
                <p>pr@prifinance.com</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-xxl hero-img-container clearfix">
  <img src="<?= IMAGES_URI ?>press-hero-img.png" class="hero-img" alt="">
</div>
<?php
$blocks = get_field('blocks-press-centr');

get_template_part('include/articles', null, [
  'cssClass' => 'testimonials',
  'type' => 'video',
  'block' => $blocks[0]
]);
get_template_part('include/articles', null, [
  'cssClass' => 'testimonials',
  'type' => 'text',
  'block' => $blocks[1],
]);
get_template_part('include/block-partners');
get_footer();
?>
