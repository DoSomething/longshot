<?php

/**
 * Clear the cache if a setting change occurs.
 *
 * @TODO: Eventually turn this into a service provider in the Scholarship directory.
 */
Event::listen('setting.change', function($category)
{
  if ($category === 'general') {
    Cache::forget('query.setting.' . implode('.', Setting::$pageQueryItems));

    Cache::forget('query.setting.' . implode('.', Setting::$nominateQueryItems));

    foreach (Setting::$individualQueryItems as $item) {
      Cache::forget('query.setting.' . $item);
    }

  } else {

    Cache::forget('query.setting.' . $category);

  }
});
