<?php
/**
 * @file
 * btp_news.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function btp_news_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function btp_news_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_image_default_styles().
 */
function btp_news_image_default_styles() {
  $styles = array();

  // Exported image style: news_block.
  $styles['news_block'] = array(
    'label' => 'News block',
    'effects' => array(
      2 => array(
        'name' => 'square_crop',
        'data' => array(),
        'weight' => -10,
      ),
      1 => array(
        'name' => 'image_scale',
        'data' => array(
          'width' => 230,
          'height' => '',
          'upscale' => 1,
        ),
        'weight' => -9,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function btp_news_node_info() {
  $items = array(
    'news' => array(
      'name' => t('News'),
      'base' => 'node_content',
      'description' => t('Content type to create News.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
