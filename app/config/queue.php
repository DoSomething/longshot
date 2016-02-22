<?php

return [

    'default'     => 'redis',

    'connections' => [

        'redis' => [
          'driver' => 'redis',
          'queue'  => getenv('REDIS_QUEUE'),
        ],
    ],

    'failed' => [

      'database' => 'mysql', 'table' => 'failed_jobs',

    ],
];
