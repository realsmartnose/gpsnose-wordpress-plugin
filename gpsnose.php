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

$settings = new Settings('gpsnose');

// Add the Options-Page to the backend
add_action('admin_menu', function () {
	add_submenu_page(
		'tools.php',
		'GpsNose Options',
		'GpsNose Options',
		'manage_options',
		'GpsNose',
		'gpsnose_options_page_html'
	);
});

/**
 * Options page for gpsnose
 */
function gpsnose_options_page_html()
{
	// check user capabilities
	if (!current_user_can('manage_options')) {
		return;
	}
?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields('gpsnose');
			do_settings_sections('gpsnose');
			submit_button(__('Save Settings', 'textdomain'));
			?>
		</form>
	</div>
	<?php
}

// Add meat-tag to header
add_action('wp_head', function () use ($settings) {
	$gpsnose_validation_key = $settings->get_value_for_option('gpsnose_validation_key');
	if ($gpsnose_validation_key) {
	?>
		<meta name="gpsnose-validation-key" content="<?php echo $gpsnose_validation_key ?>" />
<?php
	}
});

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
