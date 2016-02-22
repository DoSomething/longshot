<?php

return [

  'path' => storage_path().'/dumps/',

  'mysql' => [
    'dump_command_path'    => '/usr/bin/',
    'restore_command_path' => '/usr/bin/',
    ],

  's3' => [
    'path' => getenv('S3_PATH'),
    ],
  ];
