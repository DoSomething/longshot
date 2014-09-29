<?php

/**
 * Clear the cache if a setting change occurs.
 *
 * @TODO: Eventually turn this into a service provider in the Scholarship directory.
 */
Event::listen('setting.change', function($category)
{
  Cache::forget('query.setting.' . $category);
});
