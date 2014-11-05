<?php

/**
 * View composer that sets global variables for all pages.
 */
View::composer(['layouts.master', 'status.review'], 'Scholarship\Composers\PageComposer');
