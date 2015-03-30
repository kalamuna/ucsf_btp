<?php
/**
 * @file
 * btp_basic_page.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function btp_basic_page_default_fe_block_settings() {
  $export = array();

  $export['version'] = '2.0';

  $export['views-sidebar_callouts-block'] = array(
    'cache' => -1,
    'css_class' => '',
    'custom' => 0,
    'delta' => 'sidebar_callouts-block',
    'module' => 'views',
    'node_types' => array(
      0 => 'page',
    ),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'bootstrap' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'bootstrap',
        'weight' => 0,
      ),
      'btp' => array(
        'region' => 'sidebar_second',
        'status' => 1,
        'theme' => 'btp',
        'weight' => -20,
      ),
      'seven' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'seven',
        'weight' => 0,
      ),
    ),
    'title' => '<none>',
    'visibility' => 0,
  );

  return $export;
}
