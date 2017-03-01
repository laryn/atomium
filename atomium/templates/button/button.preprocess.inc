<?php

/**
 * @file
 * button.preprocess.inc
 */

/**
 * Implements hook_preprocess_button().
 */
function atomium_preprocess_button(&$variables) {
  $element = $variables['element'];
  // This allows us to modify the type of button we want.
  $element['#attributes']['type'] = $element['#button_type'] ?: 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }

  $variables['attributes_array'] = $element['#attributes'];
}