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