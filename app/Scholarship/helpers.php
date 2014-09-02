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
  return link_to_route('profile.show', $text, Auth::user()->id);
}


/**
 * A helper function to sort applicants
 */
function sort_applicants_by($column, $body)
{
  return link_to_route('applications', $body, ['sort_by' => $column]);
}


/**
 * Set a class on active menu items.
 * @TODO: maybe change name to setActiveClass to be more descriptive, and
 * attempt to streamline the function to work better between main app
 * styles and admin styles.
 */
function setActive($path, $segment = 1, $active = '-active')
{
  $pathSegment = Request::segment($segment);

  return $pathSegment === $path ? $active : '';
}


/**
 * Create custom stylesheet from values entered in Appearance settings.
 */
function createCustomStylesheet($styles)
{
  $output = ".primary-color { background-color: #$styles->primary_color; }";
  $output .= ".button.-default { background-color: #$styles->primary_color; color: #$styles->primary_color_contrast; }";
  $output .= "a { color: #$styles->primary_color; }";
  $output .= ".segment:first-of-type { border-bottom-color: #$styles->primary_color; }";
  $destination = app_path() . '/views/layouts/partials/custom-styles.blade.php';

  File::put($destination, $output);
}

