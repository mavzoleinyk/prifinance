<?php
/*
Template Name: page bank-account
Template Post Type: page
*/
?>
<?php get_header(); ?>
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
    </div>
  </div>
</div>

<?php the_post(); ?>
<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
      <h3 class="mainH"><?php _e('Bank account', 'prifinance') ?></h3>
    </div>
    <h1 class="the_title"><?php the_title() ?></h1>
    <div class="content">
      <table class="table table-banks">
        <thead>
        <tr>
          <th colspan="2"><?php _e('Name', 'prifinance-custom') ?></th>
          <th><?php _e('Account type', 'prifinance') ?></th>
          <th><?php _e('Account Opening Period', 'prifinance') ?></th>
          <th><?php _e('Price', 'prifinance') ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <?php $title = get_field('mini_title') ?? get_the_title(); ?>
          <td class="table-banks-title" aria-label="<?php _e('Name', 'prifinance-custom') ?>"><?php echo $title; ?></td>
          <td class="table-banks-btn" aria-label=""><div
                                                                  class="btn-get-offer"><?php _e('GET AN OFFER', 'prifinance') ?></div>
          </td>

          <td class="table-banks-type"
              aria-label="<?php _e('Сurrent account', 'prifinance') ?>"><?php the_field('account_type'); ?></td>
          <td class="table-banks-srok"
              aria-label="<?php _e('Account Opening Period', 'prifinance') ?>"><?php the_field('srok'); ?></td>

          <td class="table-banks-price"
              aria-label="<?php _e('Price', 'prifinance') ?>"><?php the_field('bank_price'); ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="content-text">
      <?php the_content(); ?>
    </div>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>
<?php
if (get_locale() == 'en_US') {
  ?>
  <section class="buy-centre">
    <div class="press-centre-inner fonbuycompany buycompany">
      <div class="container-xxl">
        <div class="row justify-content-center">
          <div class="col-md-10 col-xl-9">
            <div class="buycomptext">
              <h3 class="text-white buyh3">BUY A COMPANY</h3>
              <p>If you order a new company untill <b>31 of July</b>, opening a bank account is for <b>FREE</b></p>
              <div class="btn-get-offer-small btn-get-offer">Proceed to Order<img src="<?= ICONS_URI ?>right-arrow.svg" alt=""></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
} else {
  get_template_part('parts/buy-centre');
}
?>
<?php get_template_part('include/block-payment'); ?>
<?php get_footer(); ?>
