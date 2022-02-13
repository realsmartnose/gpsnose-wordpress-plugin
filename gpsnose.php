<?php

/**
 * Plugin Name: GpsNose
 * Plugin URI:  https://www.gpsnose.com/
 * Description: Extension to integrate GpsNose into WordPress - GpsNose connects anonymous people to the real world using the web and mobiles
 * Version:     1.0.0
 * Author:      Juergen Furrer
 * Author URI:  https://www.gpsnose.com/
 */

require "vendor/autoload.php";

use SmartNoses\Gpsnose\Backend\Settings;
use SmartNoses\Gpsnose\Frontend\Header;

$settings = new Settings('gpsnose');
$settings->admin_menu();

$header = new Header();
$header->set_meta();


/*
$debug_tags = [];
add_action('all', function ($tag) {
    global $debug_tags;
    if (in_array($tag, $debug_tags)) {
        return;
    }
    $debug_tags[] = $tag;
    echo "<pre style=\"color:red\">{$tag}</pre>";
});
*/
