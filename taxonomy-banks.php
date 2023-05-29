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

<?php $cat = get_queried_object(); ?>
<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>


    <h1 class="mainH"><?php echo $cat->name; ?></h1>


    <div class="content">

      <?php
      //НАЧАЛО СПИСКА


      $arg_posts = array(
        'post_type' => 'bank-account',
        'posts_per_page' => -1,
        'tax_query' => array(
          array(
            'taxonomy' => 'banks',
            'field' => 'term_id',
            'terms' => $cat->term_id,
          ),
        ),
      );
      $query = new WP_Query($arg_posts);


      if ($query->have_posts()) : ?>

        <table class="table table-banks">
          <thead>
          <tr>
            <th colspan="2"><?php _e('Name', 'prifinance') ?></th>
            <th><?php _e('Account type', 'prifinance') ?></th>
            <th><?php _e('Account Opening Period', 'prifinance') ?></th>
            <th><?php _e('Price', 'prifinance') ?></th>
          </tr>
          </thead>
          <tbody>
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <tr>
              <?php $title = get_field('mini_title') ?? get_the_title(); ?>
              <td class="table-banks-title" aria-label="<?php _e('Name', 'prifinance') ?>">

                <?php
                if (get_the_content()) {
                  ?>
                  <a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
                  <?php
                } else {
                  ?>
                  <?php echo $title; ?>
                  <?php
                }
                ?>
              </td>
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

          <?php endwhile;
          wp_reset_postdata(); ?>
          </tbody>
        </table>
      <?php endif;


      // КОНЕЦ
      ?>


    </div>


    <div class="content-text">
      <?php the_field('catetgory_description', $cat); ?>
    </div>


  </div>


  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>


<?php get_template_part('include/block-partners'); ?>


<?php get_footer(); ?>
