<?php 
/** 
 * @file 
 * Primary pre/preprocess functions and alterations.
 */ 
function btp_preprocess_html(&$vars) {
  global $theme_path;
  
  // Include admin.css in admin pages or where admin bits are exposed.
  $admin_pages = array('admin', 'node', 'user');
  if (in_array(arg(0), $admin_pages)) {
    drupal_add_css($theme_path . '/css/specifics/admin.css');
  }

  $livereload_port = 35729;
  drupal_add_js("document.write('<script src=\"http://' + (location.host || 'localhost').split(':')[0] + ':$livereload_port/livereload.js?snipver=1\"></' + 'script>')", array('type' => 'inline', 'scope' => 'footer', 'weight' => 9999));
}
