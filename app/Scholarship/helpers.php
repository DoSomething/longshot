<?php
# View Helper Functions


/**
 * Output form errors within specified markup.
 * @param  string $attribute Type Attribute specifying field name.
 * @param  object $errors    Validation errors object.
 * @return string            Output of markup for displaying the error.
 */
function errorsFor($attribute, $errors) {
  return $errors->first($attribute, '<span class="error">:message</span>');
}


/**
 * Output a link to a User's profile page.
 * @param  string $text Text to output for link.
 * @return string       Output of markup for profile link.
 */
function link_to_profile($text = 'Profile')
{
  return link_to_route('profile', $text, Auth::user()->id);
}
