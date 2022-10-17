<?php

/**
 * Summary: php file which implements the custom shortcodes
 */


// Add shortcodes on init
add_action('init', function(){

    // Add shortcodes. Add additional shortcodes here as needed.

    // Add example shortcode
    add_shortcode(
        'gmuw_readygmu_shortcode', //shortcode label (use as the shortcode on the site)
        'gmuw_readygmu_shortcode' //callback function
    );

    // latest mason alert shortcode
    add_shortcode(
        'gmuw_readygmu_latest_mason_alert', //shortcode label (use as the shortcode on the site)
        'gmuw_readygmu_latest_mason_alert' //callback function
    );

});

// Define shortcode callback functions. Add additional shortcode functions here as needed.

// Define example shortcode
function gmuw_readygmu_shortcode(){

    // Determine return value
    $content='set what the shortcode will do/say...';

    // Return value
    return $content;

}

// Latest Mason alert
function gmuw_readygmu_latest_mason_alert(){

    // Determine return value
    $content='';

    // Get XML file
    $masonalert = simplexml_load_file('http://www.getrave.com/rss/gmu/channel2');
    // Calc info
    $alerthumantime = $masonalert->channel->item->pubDate;
    $alertdescription = $masonalert->channel->item->description;
    $alertcomputertime = strtotime($alerthumantime);
    $timenow = time();
    $time24hrsago = time() -86400;

    // Should we output alert info?
    if(check_range($timenow, $alertcomputertime, $time24hrsago)) {
        $content.=$alerthumantime . $alertdescription;
    } else {
        $content.='<div class="gmuw-readygmu-latest-mason-alert"><p><strong>No Mason Alerts within the last 24 hours.</strong></p> <p>To receive Mason Alerts on your mobile device, please register at <a href="http://ready.gmu.edu/masonalert/">alert.gmu.edu</a>.</p></div>';
    };

    // Return value
    return $content;

}

// Check range for latest Mason alert
function check_range($timenow, $alertcomputertime, $time24hrsago) {
  return (($timenow >= $alertcomputertime) && ($time24hrsago <= $alertcomputertime));
}
