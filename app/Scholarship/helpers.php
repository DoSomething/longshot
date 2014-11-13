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
  $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
  return link_to_route('applications.index', $body, ['sort_by' => $column, 'direction' => $direction]);
}

/**
 * A helper function to sort applicants
 */
function filter_applicants_by($status, $body)
{
  return link_to_route('applications.index', $body, ['filter_by' => $status]);
}

function filter_winners_by($status, $body)
{
  return link_to_route('admin.winner.index', $body, ['filter_by' => $status]);
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

  $output = '';

  if (isset($styles->primary_color)) {
    $output .= "a { color: #$styles->primary_color; }";

    $output .= ".bg-primary-color { background-color: #$styles->primary_color; }";
    $output .= ".text-primary-color { color: #$styles->primary_color; }";
    $output .= ".border-primary-color { border-color: #$styles->primary_color; }";

    $output .= ".button.-link { color: #$styles->primary_color; }";
    $output .= ".button.-default { background-color: #$styles->primary_color; " . (isset($styles->primary_color_contrast) ? "color: #$styles->primary_color_contrast;" : "") . "}";
    $output .= ".button.-small { background-color: #$styles->primary_color; " . (isset($styles->primary_color_contrast) ? "color: #$styles->primary_color_contrast;" : "") . "}";

    $output .= "#button-main-nav:hover, #button-main-nav:focus { color: #$styles->primary_color; }";
    $output .= ".main-nav a { color: #$styles->primary_color; }";
    $output .= ".main-nav .__menu li span { border-color: #$styles->primary_color; }";

    $output .= ".banner + .segment { border-color: #$styles->primary_color; }";

    $output .= ".segment--introduction > .wrapper { border-color: #$styles->primary_color; }";
    $output .= ".segment--detailed-list .__title:before { background-color: #$styles->primary_color; }";
    $output .= ".segment--timeline ul:before, .segment--timeline ul li:after { background-color: #$styles->primary_color; }";
    $output .= ".segment--timeline ul li:before { border-color: #$styles->primary_color; }";
    $output .= ".segment--checklist { border-color: #$styles->primary_color; }";

    $output .= ".callout--scholarship > .wrapper:before, .callout--scholarship > .wrapper:after { border-color: #$styles->primary_color; }";

    $output .= ".card figcaption { background-color: #$styles->primary_color; }";
  }

  if (isset($styles->primary_color_contrast)) {
    $output .= "#button-main-nav { color: #$styles->primary_color_contrast; }";
  }

  if (isset($styles->primary_color_interaction)) {
    $output .= ".button.-default:hover, .button.-default:active { background-color: #$styles->primary_color_interaction }";
    $output .= ".button.-small:hover, .button.-small:active { background-color: #$styles->primary_color_interaction }";
  } else {
    $output .= ".button.-default:hover, .button.-default:active { background-color: #$styles->primary_color }";
    $output .= ".button.-small:hover, .button.-small:active { background-color: #$styles->primary_color }";
  }

  Cache::forever('custom.styles', $output);
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
  return ucwords(str_replace('_', ' ', $text));
}


/**
 * Return a string formatted from snake_case to Title Case with spaces.
 */
function snakeCaseToKebabCase($text)
{
  return str_replace('_', '-', $text);
}


/**
 * Return a string formatted to Kebab Case and all lowercased.
 */
function stringtoKebabCase($text)
{
  $symbols = ["'", "’", ":"];
  $text = str_replace($symbols, '', $text);
  $text = str_replace(' ', '-', strtolower($text));
  return $text;
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


/**
 * If title supplied, output an ID for tag.
 */
function output_id($title) {
  if (!empty($title)) {
    return 'id="' . stringtoKebabCase($title) . '"';
  }

  return false;
}


/**
 * Return the year from a date string value retrieved from mysql.
 * @param  string $date Date as string ('2014-11-13').
 * @return string
 */
function output_date_year($date) {
  return date('Y', strtotime($date));
}



/**
 * Return a year period from provided start and end years.
 * @param  string $start       Start date as string; format('2014-11-13');
 * @param  string $end         End date as string; format('2014-11-13');
 * @param  integer $time_travel Set the start and end date back or forward a specified number.
 * @return string
 */
function output_year_period($start, $end, $time_travel = NULL)
  {
    $start = output_date_year($start);
    $end   = output_date_year($end);

    if ($time_travel) {
      $start = (string) ($start + $time_travel);
      $end   = (string) ($end + $time_travel);
    }

    if ($start === $end) {
      return $end;
    }

    return $start.'-'.$end;
  }


/**
 * Add a class to the body to indicate current section of app.
 */
function bodyClass()
{
  $segmentOne = Request::segment(1);
  $path = Request::path();

  if ($path === '/') {
    return 'section--home';
  }

  return 'section--' . $segmentOne;
}


/**
 * Add a metric prefix to unit of measure.
 */
function useMetricPrefix($unit)
{
  return $unit / 1000 . 'k';
}
