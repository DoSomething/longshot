<?php

/**
 * View composer that sets global variables for all pages.
 */

$views = [
  'layouts.master',
  'pages.home',
  'status.review',
  'admin.layouts.partials.footer'
];

View::composer($views, 'Scholarship\Composers\PageComposer');
