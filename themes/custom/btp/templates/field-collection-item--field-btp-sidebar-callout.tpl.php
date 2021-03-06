<?php

/**
 * @file
 * Custom theme implementation for field collection items in field_btp_sidebar_callout.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <h2><?php if (isset($callout_title)) print $callout_title; ?></h2>
  <blockquote>
      <p><?php if (isset($callout_text)) print $callout_text; ?></p>
      
      <footer>
        <cite><?php if (isset($callout_attr)) print $callout_attr; ?></cite>
      </footer>
      
      <?php 
        // Hide all the fields because we've already printed their values 
        // but still print $content just in case anyone adds something in 
        // the future.
      ?>
      <?php hide($content['field_btp_sidebar_callout_title']); ?>
      <?php hide($content['field_btp_sidebar_callout_text']); ?>
      <?php hide($content['field_btp_sidebar_callout_attr']); ?>
      <?php print render($content); ?>
  </blockquote>
</div>
