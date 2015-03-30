<?php
/**
 * @file
 * btp_news.features.fe_block_settings.inc
 */

/**
 * Implements hook_default_fe_block_settings().
 */
function btp_news_default_fe_block_settings() {
  $export = array();

  $export['version'] = '2.0';

  $export['views-news-news_block'] = array(
    'cache' => -1,
    'css_class' => '',
    'custom' => 0,
    'delta' => 'news-news_block',
    'module' => 'views',
    'node_types' => array(),
    'pages' => 'news
about-us
team
partners
contact
evidence
our-research
our-findings
implications
publications',
    'roles' => array(),
    'themes' => array(
      'bootstrap' => array(
        'region' => 'content',
        'status' => 1,
        'theme' => 'bootstrap',
        'weight' => 1,
      ),
      'btp' => array(
        'region' => 'sidebar_second',
        'status' => 1,
        'theme' => 'btp',
        'weight' => -17,
      ),
      'seven' => array(
        'region' => '',
        'status' => 0,
        'theme' => 'seven',
        'weight' => 0,
      ),
    ),
    'title' => 'Latest news',
    'visibility' => 0,
  );

  return $export;
}
