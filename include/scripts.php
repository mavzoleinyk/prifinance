<?php
add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method() {
  wp_enqueue_script('jquery');
  wp_enqueue_script('splide', get_template_directory_uri() . '/js/splide.min.js', [], null, true);
  wp_enqueue_script('metismenujs', get_template_directory_uri() . '/js/metismenujs.min.js', [], null, true);
  wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.js', [], null, true);
  wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', [], null, true);
  wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', [], null, true);
  wp_enqueue_script('tingle', get_template_directory_uri() . '/js/tingle.min.js', [], null, true);
  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', [], null, true);
  
  wp_localize_script(
    'main',
    'main_object',
    get_main_atts()
  );
}

function get_main_atts() {
  return [
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('main-nonce')
  ];
}
