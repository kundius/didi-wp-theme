<?php

add_action('after_setup_theme', function () {
  require_once('vendor/autoload.php');
});

include 'inc/ajax.php';
include 'inc/register-post-types.php';
include 'inc/carbon-fields.php';
include 'inc/theme.php';
include 'inc/assets.php';
include 'inc/menu.php';
include 'inc/seo.php';
