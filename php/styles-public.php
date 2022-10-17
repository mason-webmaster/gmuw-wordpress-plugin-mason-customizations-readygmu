<?php

/**
 * Enqueue custom public CSS
 */
add_action('wp_enqueue_scripts', function(){

  // Enqueue public styles. Enqueue additional css files here as needed.

  // Enqueue the custom stylesheets
  wp_enqueue_style(
    'gmuw_readygmu_custom_css', //stylesheet name
    plugin_dir_url( __DIR__ ).'css/custom-readygmu.css' //path to stylesheet
  );

});
