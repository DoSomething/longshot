<?php

return [

    'default'     => 'redis',

    'connections' => [

        'redis' => array(
          'driver' => 'redis',
          'queue'  => getenv('REDIS_QUEUE'),
        ),
    ],

    'failed' => array(

      'database' => 'mysql', 'table' => 'failed_jobs',

    ),
];
