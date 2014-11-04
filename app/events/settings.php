<?php

use Scholarship\Repositories\SettingRepository;

/**
 * Clear the cache if a setting change occurs.
 *
 * @TODO: Eventually turn this into a service provider in the Scholarship directory.
 */
Event::listen('settings.change', function($category)
{

  if ($category === 'general') {

    Cache::forget('setting.' . implode('.', SettingRepository::$pageQueryItems));

    Cache::forget('setting.' . implode('.', SettingRepository::$nominateQueryItems));

    foreach (SettingRepository::$individualQueryItems as $item) {
      Cache::forget('setting.' . $item);
    }

  } elseif ($category === 'meta_data') {

    Cache::forget('setting.' . implode('.', SettingRepository::$openGraphDataQueryItems));

    Cache::forget('setting.favicon');

  } else {

    Cache::forget('setting.' . $category);

  }

});
