<?php

return array(

  'path' => storage_path() . '/dumps/',

  'mysql' => array(
    'dump_command_path' => '/usr/bin/',
    'restore_command_path' => '/usr/bin/',
    ),

  's3' => array(
    'path' => getenv('S3_PATH'),
    ),
  );
