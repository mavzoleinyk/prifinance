<?php
function shortcode_best_offers($atts) {
  ob_start();
  $atts = shortcode_atts([
    'post-type' => 'post',
  ], $atts);
  //НАЧАЛО СПИСКА
  $arg_posts = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => [
      'relation' => 'OR',
      [
        'key' => 'best-offer',
        'value' => true
      ],
    ]
  );
  $query = new WP_Query($arg_posts);
  if ($query->have_posts()) :
    get_template_part('parts/best-offers', null, ['query' => $query]);
  endif;
  return ob_get_clean();
}


