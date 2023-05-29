<nav class="nav-first d-flex align-items-center">
<?php if(!is_front_page()){ ?>
  <a href="/">
    <?php } ?>
    <img
      src="<?php the_field('top-nav-second_logo', icl_object_id(427, 'page', true)) ?>" class="logo"
      alt="Private Finance Logo">
<?php if(!is_front_page()){ ?>
    </a>
    <?php } ?>
  <ul class="metismenu list-unstyled list-inline mb-0 ms-auto" id="headerMenu">
    <li class="list-inline-item me-0"><img src="<?= IMAGES_URI ?>icon-24.svg" class="list-icon me-0" alt=""></li>
    <li class="list-inline-item phone-menu">
      <?php renderPhoneMenu(); ?>
    </li>
    <?php if (have_rows('top-nav-second_menus', icl_object_id(427, 'page', true))): while (have_rows('top-nav-second_menus', icl_object_id(427, 'page', true))) : the_row(); ?>
      <li class="list-inline-item">
        <a class="link-white text-decoration-none" href="<?php the_sub_field('link'); ?>" aria-expanded="false"><img
            src="<?php the_sub_field('icon'); ?>" class="list-icon" alt=""><?php the_sub_field('text'); ?></a>
      </li>
    <?php endwhile; else : endif; ?>
  </ul>
  <button class="btn btn-orange btn-call"><img src="<?= IMAGES_URI ?>btn-tel-img.svg"
                                               alt=""><?php the_field('top-nav-second_button', icl_object_id(427, 'page', true)) ?>
  </button>
</nav>
