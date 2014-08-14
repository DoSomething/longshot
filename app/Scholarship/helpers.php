<?php
# View Helper Functions


/**
 * Output form errors within specified markup.
 * @param  [String] $attribute Type Attribute specifying field name.
 * @param  [Object] $errors    Validation errors object.
 * @return [String]            Output of markup for displaying the error.
 */
function errorsFor($attribute, $errors) {
  return $errors->first($attribute, '<span class="error">:message</span>');
}
