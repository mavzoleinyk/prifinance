<nav class="d-flex align-items-center">
  <?php if(!is_front_page()){ ?>
    <a href="/">
      <?php } ?>
    <img src="<?= IMAGES_URI ?>logo.svg" class="logo" alt="Private Finance Logo">
  <?php if(!is_front_page()){ ?>
  </a>
  <?php } ?>
  <span class="burger-menu-toggle ms-auto me-sm-4" style="cursor:pointer">
    <div class="burger-menu-btn">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </span>
  <button class="d-none d-sm-block btn btn-orange btn-call"><img src="<?= IMAGES_URI ?>btn-tel-img.svg" alt="">REQUEST A
    CALL
  </button>
  <nav class="burger-menu container-fluid" id="burgerMenu">
    <span class="burger-menu-toggle burger-menu-close" style="cursor:pointer">
      <div class="burger-menu-btn">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </span>
    <ul class="metismenu list-unstyled" id="headerMenuMob">
      <li>
        <button class="d-sm-none btn btn-orange btn-call"><img src="<?= IMAGES_URI ?>btn-tel-img.svg"
                                                               alt=""><?php the_field('top-nav-second_button', icl_object_id(427, 'page', true)) ?>
        </button>
      </li>
      <li><span class="call-us"><?php the_field('top-nav_tel', icl_object_id(427, 'page', true)) ?></span></li>
      <!-- <li><input class="d-block form-control input-search"></li> -->
      <li class="phone-menu">
        <?php renderPhoneMenu(true); ?>
      </li>

      <?php if (have_rows('top-nav-second_menus', icl_object_id(427, 'page', true))): while (have_rows('top-nav-second_menus', icl_object_id(427, 'page', true))) : the_row(); ?>

        <li>
          <a class="link-white text-decoration-none" href="<?php the_sub_field('link'); ?>" aria-expanded="false">
            <span class="list-icon"><img src="<?php the_sub_field('icon'); ?>" alt=""></span>
            <?php the_sub_field('text'); ?>
          </a>
        </li>

      <?php endwhile; else : endif; ?>

      <?php

      if (defined('ICL_LANGUAGE_CODE')) {
        $lang = ICL_LANGUAGE_CODE;
      }

      ?>

      <?php if ($lang === 'ru') : ?>
        <?php
        wp_nav_menu([
          'walker' => new True_Walker_Nav_Menu(),
          'container' => false,
          'items_wrap' => '%3$s',
          'list_item_class' => '',
          'link_class' => 'text-decoration-none',
          'theme_location' => 'primary',

        ]); ?>
      <?php endif; ?>

      <?php if ($lang === 'en'): ?>
        <?php
        wp_nav_menu([
          'walker' => new True_Walker_Nav_Menu(),
          'container' => false,
          'items_wrap' => '%3$s',
          'list_item_class' => '',
          'link_class' => 'text-decoration-none',
          'theme_location' => 'primary-en',

        ]); ?>
      <?php endif; ?>

    </ul>
  </nav>
</nav>
