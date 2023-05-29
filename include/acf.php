<?php
// Add Theme Options
if (function_exists('acf_add_options_page')) {
  acf_add_options_sub_page(array(
    'page_title' => 'Настройки категорий компаний',
    'menu_title' => 'Настройки категорий компаний',
    'parent_slug' => 'edit.php',
    'menu_slug' => 'category_settings',
  ));
}
