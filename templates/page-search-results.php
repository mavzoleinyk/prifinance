<?php
/*
Template Name: Page - Search Results
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
    <h1 class="the_title" style="margin-bottom: 62px;"><?php _e('Search Results', 'prifinance') ?></h1>
    <div class="content">
      <div class="search-input-block">
        <form class="search-input">
          <input type="text">
          <button type="submit">
            <img src="<?= get_template_directory_uri(); ?>/img/icons/search_btn.png" alt="">
          </button>
        </form>
      </div>
      <div class="search-result">
        <p>К сожалению, на ваш поисковый запрос ничего не найдено. <br>
          <a href="#">Возврат к списку</a></p>
        <p>К сожалению, на ваш поисковый запрос ничего не найдено. <br>
          <a href="#">Возврат к списку</a></p>
      </div>
      <div class="articles-list">
        <ul>
          <li class="articles-list-item">
            <a href="<?= get_post_permalink() ?>"><?php the_title(); ?></a>
            <p class="articles-list-item-description">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, modi?
            </p>
          </li>
          <li class="articles-list-item">
            <a href="<?= get_post_permalink() ?>"><?php the_title(); ?></a>
            <p class="articles-list-item-description">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, modi?
            </p>
          </li>
          <li class="articles-list-item">
            <a href="<?= get_post_permalink() ?>"><?php the_title(); ?></a>
            <p class="articles-list-item-description">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, modi?
            </p>
          </li>
          <li class="articles-list-item">
            <a href="<?= get_post_permalink() ?>"><?php the_title(); ?></a>
            <p class="articles-list-item-description">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam, modi?
            </p>
          </li>
        </ul>
        <?php get_template_part('include/feature-pagination', null, ['last_page' => $last_page]) ?>
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
