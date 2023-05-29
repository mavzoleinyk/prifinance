<?php
$labels = array(
  'name' => _x('Articles', 'Post Type General Name', 'cybr'),
  'singular_name' => _x('Article', 'Post Type Singular Name', 'cybr'),
  'menu_name' => _x('Articles', 'Post Type Menu Name', 'cybr'),
  'all_items' => _x('All Articles', 'Post Type', 'cybr'),
  'view_item' => _x('View Article', 'Post Type', 'cybr'),
  'add_new_item' => _x('Add New Article', 'Post Type', 'cybr'),
  'add_new' => _x('Add New', 'Post Type', 'cybr'),
  'edit_item' => _x('Edit Article', 'Post Type', 'cybr'),
  'update_item' => _x('Update Article', 'Post Type', 'cybr'),
  'search_items' => _x('Search Articles', 'Post Type', 'cybr'),
  'not_found' => _x('No Articles found', 'Post Type', 'cybr'),
  'not_found_in_trash' => _x('No Articles found in Trash', 'Post Type', 'cybr'),
);
$args = array(
  'label' => _x('Article', 'Post Type Label', 'cybr'),
  'description' => _x('Article information pages', 'Post Type', 'cybr'),
  'labels' => $labels,
  'supports' => array(
    'title',
    'thumbnail',
    'author',
    'editor',
    'excerpt',
    'page-attributes',
    'comments',
    'custom-fields',
  ),
  'hierarchical' => true,
  'public' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'show_in_nav_menus' => true,
  'show_in_admin_bar' => true,
  'can_export' => true,
  'has_archive' => false,
  'exclude_from_search' => false,
  'publicly_queryable' => true,
  'menu_icon' => 'dashicons-text'
);

register_post_type('articles', $args);
