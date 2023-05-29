<?php
// Parrotz theme options
$GLOBALS['acf_options'] = get_fields( 'options' );

function getOption($name) {
  global $acf_options;
  return $acf_options[$name] ?? '';
}
function getField($name, $post_id = false) {
  $field = (!empty($post_id)) ? get_field($name, $post_id) : get_field($name);
  return (!empty($field)) ? $field : '';
}
function getArrayField($array, $key) {
  return isset($array[$key]) && (!empty($array[$key])) ? $array[$key] : '';
}
