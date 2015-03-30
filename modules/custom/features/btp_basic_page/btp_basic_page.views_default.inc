<?php
/**
 * @file
 * btp_basic_page.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function btp_basic_page_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'sidebar_callouts';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Sidebar callouts';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Sidebar callouts';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['query']['options']['distinct'] = TRUE;
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '5';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['row_plugin'] = 'fields';
  $handler->display->display_options['row_options']['hide_empty'] = TRUE;
  $handler->display->display_options['row_options']['default_field_elements'] = FALSE;
  /* Relationship: Content: Sidebar callout (field_btp_sidebar_callout) */
  $handler->display->display_options['relationships']['field_btp_sidebar_callout_value']['id'] = 'field_btp_sidebar_callout_value';
  $handler->display->display_options['relationships']['field_btp_sidebar_callout_value']['table'] = 'field_data_field_btp_sidebar_callout';
  $handler->display->display_options['relationships']['field_btp_sidebar_callout_value']['field'] = 'field_btp_sidebar_callout_value';
  $handler->display->display_options['relationships']['field_btp_sidebar_callout_value']['required'] = TRUE;
  $handler->display->display_options['relationships']['field_btp_sidebar_callout_value']['delta'] = '-1';
  /* Field: Content: Sidebar callout */
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['id'] = 'field_btp_sidebar_callout';
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['table'] = 'field_data_field_btp_sidebar_callout';
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['field'] = 'field_btp_sidebar_callout';
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['label'] = '';
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['settings'] = array(
    'edit' => '',
    'delete' => '',
    'add' => '',
    'description' => 0,
    'view_mode' => 'full',
  );
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['delta_offset'] = '0';
  $handler->display->display_options['fields']['field_btp_sidebar_callout']['multi_type'] = 'ul';
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Contextual filter: Content: Nid */
  $handler->display->display_options['arguments']['nid']['id'] = 'nid';
  $handler->display->display_options['arguments']['nid']['table'] = 'node';
  $handler->display->display_options['arguments']['nid']['field'] = 'nid';
  $handler->display->display_options['arguments']['nid']['default_action'] = 'default';
  $handler->display->display_options['arguments']['nid']['default_argument_type'] = 'node';
  $handler->display->display_options['arguments']['nid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['nid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['nid']['summary_options']['items_per_page'] = '25';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'page' => 'page',
  );

  /* Display: Block */
  $handler = $view->new_display('block', 'Block', 'block');
  $translatables['sidebar_callouts'] = array(
    t('Master'),
    t('Sidebar callouts'),
    t('more'),
    t('Apply'),
    t('Reset'),
    t('Sort by'),
    t('Asc'),
    t('Desc'),
    t('field collection item from field_btp_sidebar_callout'),
    t('All'),
    t('Block'),
  );
  $export['sidebar_callouts'] = $view;

  return $export;
}
