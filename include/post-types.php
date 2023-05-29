<?php
add_action('init', 'register_post_types');

function register_post_types() {
  include_once 'post-type-media.php';
  include_once 'post-type-articles.php';
}

// Hide columns
add_filter('manage_articles_posts_columns', function ($columns) {
  unset($columns['comments']);
  return $columns;
});
// Set sortable columns
add_filter("manage_edit-articles_sortable_columns", function () {
  return array(
    'title' => 'title',
  );
});
