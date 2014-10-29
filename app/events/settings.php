<?php

/**
 * Clear the cache if a setting change occurs.
 *
 * @TODO: Eventually turn this into a service provider in the Scholarship directory.
 */
Event::listen('settings.change', function($category)
{

  if ($category === 'general') {

    Cache::forget('setting.' . implode('.', Setting::$pageQueryItems));

    Cache::forget('setting.' . implode('.', Setting::$nominateQueryItems));

    foreach (Setting::$individualQueryItems as $item) {
      Cache::forget('setting.' . $item);
    }

  } elseif ($category === 'meta_data') {

    Cache::forget('setting.' . implode('.', Setting::$socialDataQueryItems));

    Cache::forget('setting.favicon');

  } else {

    Cache::forget('setting.' . $category);

  }

});
