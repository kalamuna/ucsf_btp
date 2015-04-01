<?php 
/** 
 * @file 
 * Primary pre/preprocess functions and alterations.
 */
 
/**
 * Implements hook_preprocess_html
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

/**
 * Implements hook_preprocess_page
 */ 
function btp_preprocess_page(&$vars) {
  // Add fontawesome from the CDN.
  drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', 'external');
  
  // For some reason the navbar has a container class which conflicts with the
  // div directly inside it which also has a container class. Let's remove it.
  foreach ($vars['navbar_classes_array'] as $i => $val) {
    if ($val== 'container') {
      unset($vars['navbar_classes_array'][$i]);
    }
  }
  
  // Build the search block for printing directly in the page template.
  $vars['search_block'] = module_invoke('search', 'block_view', 'search');

  // Change the size of the content column.
  $vars['content_column_class'] = ' class="col-sm-8"';
  
  
  // Add the Bixby and UCSF logos into the bottom of the sidebar.
  btp_add_sidebar_logos($vars);
  
  // Manually add print, share and pdf links.
  btp_print_links($vars);
}

/**
 * Add the Bixby and UCSF logos into the bottom of the sidebar
 */
function btp_add_sidebar_logos(&$vars){
  $weight = 0;
  $children = element_children($vars['page']['sidebar_second']);
  foreach ($vars['page']['sidebar_second'] as $name => $block) {
    if (in_array($name, $children) && $block['#weight'] > $weight) {
      $weight = $block['#weight'];
    }
  }
  
  $bixby_text = t('Bixby Center for Global Reproductive Health');
  $bixby_image = theme_image(array(
    'path' => path_to_theme() . '/images/bixby-logo.svg',
    'alt' => $bixby_text,
    'attributes' => array(), // How does this bug still exist?!?!
  ));
  $bixby_link = l($bixby_image . '<span>' . $bixby_text . '</span>', 'http://bixbycenter.ucsf.edu', array(
    'html' => TRUE,
    'external' => TRUE,
  ));

  $ucsf_text = t('UCSF - University of Calafornia San Francisco');
  $ucsf_image = theme_image(array(
    'path' => path_to_theme() . '/images/ucsf-logo.svg',
    'alt' => $ucsf_text,
    'attributes' => array(), // How does this bug still exist?!?!
  ));
  $ucsf_link = l($ucsf_image . '<span>' . $ucsf_text . '</span>', 'http://www.ucsf.edu', array(
    'html' => TRUE,
    'external' => TRUE,
  ));
  
  $vars['page']['sidebar_second']['logos'] = array(
    '#prefix' => '<div class="logos">',
    '#suffix' => '</div>',
    '#theme' => 'item_list',
    '#weight' => $weight + 1, 
    '#items' => array(
      array(
        'data' => $bixby_link,
        'class' => array('bixby'),
      ),
      array(
        'data' => $ucsf_link,
        'class' => array('ucsf'),
      ),
    ),
  );
}

/**
 * Add the print, share and pdf links to the page. 
 *
 * Note that we're doing this manually because the print module is implemented
 * really badly and provides no easy way to customize the links.
 */ 
function btp_print_links(&$vars) {
  if (isset($vars['node'])) {
    // We are on a node page--build the links.
    $vars['btp_print_links'] = array(
      '#theme' => 'item_list',
      '#attributes' => array(
        'id' => 'print-share-pdf'
      ),
      '#items' => array(
        _btp_fa_icon('print') . print_insert_link(NULL, $vars['node'], 'corner'),
        _btp_fa_icon('envelope-o') . print_mail_insert_link(NULL, $vars['node'], 'corner'),
        _btp_fa_icon('file-pdf-o') . print_pdf_insert_link(NULL, $vars['node'], 'corner'),
      ),
    );
  }
}

/**
 * Theme function implementation for bootstrap_search_form_wrapper.
 *
 * Overriding bootstrap_bootstrap_search_form_wrapper to change the search 
 * button into a magnifying glass.
 */
function btp_bootstrap_search_form_wrapper($variables) {
  $output = '<div class="input-group">';
  $output .= $variables['element']['#children'];
  $output .= '<span class="input-group-btn">';
  $output .= '<button type="submit" class="btn btn-default">';
  // We can be sure that the font icons exist in CDN.
  if (theme_get_setting('bootstrap_cdn')) {
    $output .= _bootstrap_icon('search');
  }
  else {
    $output .= '<i class="fa fa-search"></i><span class="sr-only">Search</span>';
  }
  $output .= '</button>';
  $output .= '</span>';
  $output .= '</div>';
  return $output;
}

/**
 * Implements hook_preprocess_entity.
 */
function btp_preprocess_entity(&$vars, $hook){
  // Run entity-type-specific preprocess functions for the opt-in list of types.
  global $theme_key;
  $types = array('field_collection_item');
  if (in_array($vars['entity_type'], $types)) {
    $function = $theme_key . '_preprocess_' . $vars['entity_type'];
    if (function_exists($function)) {
      $function($vars, $hook);
    } 
  }
}

/**
 * Implements hook_preprocess_entity.
 */
function btp_preprocess_field_collection_item(&$vars){
  if ($vars['elements']['#bundle'] == 'field_btp_sidebar_callout') {
    // Set up variables for template that just have the fields values so we can
    // avoid all the markup. 
    $fields = array(
      'callout_title' => 'field_btp_sidebar_callout_title',
      'callout_text' => 'field_btp_sidebar_callout_text',
      'callout_attr' => 'field_btp_sidebar_callout_attr',
    );
    
    foreach ($fields as $var_name => $field_name) {
      if (isset($vars[$field_name])) {
        $vars[$var_name] = $vars[$field_name][0]['safe_value'];
      }
    }
  }
}

/**
 * Overrides theme_menu_link().
 */
function btp_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      
      // Add the caret inside of another link so that we can seperate the 
      // dropdown from the parent menu item link.
      $options = array(
        'html' => TRUE,
        'attributes' => array(
          'class' => array('dropdown', 'dropdown-toggle'),
          'data-toggle' => 'dropdown',
        ),
      );
      $element['#title'] .= l('<span class="caret"></span>', '#', $options);
      
      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['html'] = TRUE;
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

// ! Helper functions

/**
 * Return markup for a fontawesome icon.
 */
function _btp_fa_icon($name, $extra_attributes = NULL){
  // Set up the default FontAwesome classes.
  $attributes = array(
    'class' => array(
      'fa',
      'fa-' . $name
    ),
  );

  // Merge any extra attributes that were passed in.
  if ($extra_attributes) {
    $attributes = array_merge_recursive($extra_attributes, $attributes);
  }

  return '<i ' . drupal_attributes($attributes) . '></i>';
}
