<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/realsmartnose
 * @since             1.0.0
 * @package           Gpsnose
 *
 * @wordpress-plugin
 * Plugin Name:       GpsNose
 * Plugin URI:        https://www.gpsnose.com
 * Description:       GpsNose connects anonymous people to the real world using the web and mobiles
 * Version:           1.0.0
 * Author:            smart.nose
 * Author URI:        https://github.com/realsmartnose
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gpsnose
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die();
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('GPSNOSE_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gpsnose-activator.php
 */
function activate_gpsnose()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-gpsnose-activator.php';
    Gpsnose_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gpsnose-deactivator.php
 */
function deactivate_gpsnose()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-gpsnose-deactivator.php';
    Gpsnose_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_gpsnose');
register_deactivation_hook(__FILE__, 'deactivate_gpsnose');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-gpsnose.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_gpsnose()
{
    $plugin = new Gpsnose();
    $plugin->run();
}
run_gpsnose();
