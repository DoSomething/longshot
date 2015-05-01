<?php

/**
 * Clear the cache if specified data type is updated.
 */
Event::listen('data.update', function($type, $id = null)
{

  if ($type === 'winners') {

    Cache::forget('data.scholarship' . $id . '.winners');

  }

});
