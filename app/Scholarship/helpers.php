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
 * Add a class to the field group to indicate it is invalid due to errors.
 * @param  string $attribute Type Attribute specifying field name.
 * @param  object $errors    Validation errors object.
 * @return string            Class to add if field group is invalid.
 */
function setInvalidClass($attribute, $errors) {
  if ($errors->has($attribute))
  {
    return '-invalid';
  }

  return null;
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
  return link_to_route('applications.index', $body, ['sort_by' => $column]);
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
  $styles = (object) $styles;

  $output = ".bg-primary-color { background-color: #$styles->primary_color; }";
  $output .= ".text-primary-color { color: #$styles->primary_color; }";
  $output .= ".border-primary-color { border-color: #$styles->primary_color; }";
  $output .= ".button.-default { background-color: #$styles->primary_color; color: #$styles->primary_color_contrast; }";
  $output .= "a { color: #$styles->primary_color; }";
  // @TODO: decide whether still need below rule or can just use the newly added border-primary-color class!
  // $output .= ".segment:first-of-type { border-bottom-color: #$styles->primary_color; }";
  $destination = app_path() . '/views/layouts/partials/custom-styles.blade.php';

  File::put($destination, $output);
}


/**
 * Return the path to public directory containing uploaded images.
 */
function uploadedContentPath($type = '')
{
  return public_path() . '/content/' . $type;
}


/**
 * Return a string formatted from snake_case to Title Case with spaces.
 */
function snakeCaseToTitleCase($text)
{
  return $output = ucwords(str_replace('_', ' ', $text));
}


/**
 * Return a string formatted from snake_case to Title Case with spaces.
 */
function snakeCaseToKebabCase($text)
{
  return $output = str_replace('_', '-', $text);
}


/**
 * Return a string formatted to Kebab Case and all lowercased.
 */
function stringtoKebabCase($text)
{
  return $output = str_replace(' ', '-', strtolower($text));
}


/**
 *
 */
function fieldsAreComplete($fields, $optional = array())
{
  // Are all fields filled out?
  $empty_fields = array();
  foreach ($fields as $key => $field)
  {
    if (empty($field) && !in_array($key, $optional)) {
       $empty_fields[$key] = $field;
    }
  }
  // If we have no empty fields, the app is complete
  if (empty($empty_fields)) {
    return TRUE;
  }
  return FALSE;
}


/**
 * Return name of block type and consider specific conditions.
 */
function outputBlock($block)
{
  if ($block->block_type === 'steps-vertical' || $block->block_type === 'steps-horizontal') {
    return 'steps';
  }

  return $block->block_type;
}
