<nav class="nav-last">
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
      'items_wrap' => '<ul class="list-unstyled list-inline mb-0"><li class="list-inline-item"><ul class="d-inline-block metismenu list-unstyled list-inline mb-0 %2$s" id="headerMenuHover">%3$s</ul></li></ul>',
      'list_item_class' => 'list-inline-item',
      'link_class' => 'text-decoration-none',
      'theme_location' => 'primary',
    
    ]); ?>
  <?php endif; ?>
  
  <?php if ($lang === 'en'): ?>
    <?php
    wp_nav_menu([
      'walker' => new True_Walker_Nav_Menu(),
      'container' => false,
      'items_wrap' => '<ul class="list-unstyled list-inline mb-0"><li class="list-inline-item"><ul class="d-inline-block metismenu list-unstyled list-inline mb-0 %2$s" id="headerMenuHover">%3$s</ul></li></ul>',
      'list_item_class' => 'list-inline-item',
      'link_class' => 'text-decoration-none',
      'theme_location' => 'primary-en',
    
    ]); ?>
  
  <?php endif; ?>


</nav>
