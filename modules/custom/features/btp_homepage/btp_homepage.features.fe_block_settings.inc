<?php
/**
 * @file
 * btp_homepage.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function btp_homepage_default_fe_block_settings() {
  $export = array();

  $export['version'] = '2.0';

  $export['views-slider-slider_block'] = array(
    'cache' => -1,
    'css_class' => '',
    'custom' => 0,
    'delta' => 'slider-slider_block',
    'module' => 'views',
    'node_types' => array(),
    'pages' => '',
    'roles' => array(),
    'themes' => array(
      'bootstrap' => array(
        'region' => 'content',
        'status' => 1,
        'theme' => 'bootstrap',
        'weight' => 0,
      ),
      'btp' => array(
        'region' => 'content',
        'status' => 1,
        'theme' => 'btp',
        'weight' => -18,
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
