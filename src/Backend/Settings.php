<?php

namespace SmartNoses\Gpsnose\Backend;

use GpsNose\SDK\Mashup\GnPaths;

if (!defined('ABSPATH')) {
	die('');
}

class Settings
{
	/**
	 * __constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Add the admin-menu
	 *
	 * @return void
	 */
	public function admin_menu()
	{
		add_action('admin_init', [$this, 'admin_init']);
		add_action('admin_menu', function () {
			add_submenu_page(
				'options-general.php',
				'GpsNose Options',
				'GpsNose Options',
				'manage_options',
				'GpsNose',
				[$this, 'gpsnose_options_page_html']
			);
		});
	}

	/**
	 * Admin init
	 * This will register the settings for GpsNose
	 */
	public function admin_init()
	{
		register_setting('gpsnose', 'gpsnose_options');

		add_settings_section(
			'gpsnose_section_mashup',
			__('GpsNose WP-Plugin', 'gpsnose'),
			function () {
				echo "Place the GpsNose settings here";
			},
			'gpsnose'
		);

		add_settings_field(
			'gpsnose_validation_key',
			'Validation-Key',
			[$this, 'field_input'],
			'gpsnose',
			'gpsnose_section_mashup',
			[
				'label_for' => 'gpsnose_validation_key'
			],
		);

		add_settings_field(
			'gpsnose_mashup_name',
			'Mashup name',
			[$this, 'field_input'],
			'gpsnose',
			'gpsnose_section_mashup',
			[
				'label_for' => 'gpsnose_mashup_name'
			],
		);

		add_settings_field(
			'gpsnose_app_key',
			'App-Key',
			[$this, 'field_input'],
			'gpsnose',
			'gpsnose_section_mashup',
			[
				'label_for' => 'gpsnose_app_key'
			],
		);


		add_settings_section(
			'gpsnose_section_developers',
			__("GpsNose Development", "gpsnose"),
			function () {
				echo "Override the GpsNose URL (Only change this, if you know what you are doing!)";
			},
			'gpsnose'
		);

		add_settings_field(
			'gpsnose_home_url',
			'API-URL',
			[$this, 'field_input'],
			'gpsnose',
			'gpsnose_section_developers',
			[
				'label_for' => 'gpsnose_home_url',
				'placeholder' => GnPaths::$HomeUrl
			],
		);

		add_settings_field(
			'gpsnose_data_url',
			'DATA-URL',
			[$this, 'field_input'],
			'gpsnose',
			'gpsnose_section_developers',
			[
				'label_for' => 'gpsnose_data_url',
				'placeholder' => GnPaths::$DataUrl
			],
		);
	}

	/**
	 * Options page for gpsnose
	 */
	public function gpsnose_options_page_html()
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

	/**
	 * Returns a input-field
	 *
	 * @param array $args
	 * @return void
	 */
	function field_input($args)
	{
		$fieldName = $args['label_for'];
		$placeholder = $args['placeholder'];
		$value = Settings::get_value_for_option($fieldName);
		echo "<input id=\"{$fieldName}\" name=\"gpsnose_options[{$fieldName}]\" size=\"40\" type=\"text\" value=\"{$value}\" placeholder=\"{$placeholder}\" />";
	}

	/**
	 * Returns the value for a setting
	 *
	 * @param string $fieldName
	 * @return string|null
	 */
	public static function get_value_for_option(string $fieldName): ?string
	{
		$options = get_option('gpsnose_options');
		if (isset($options[$fieldName])) {
			return $options[$fieldName];
		}
		return null;
	}
}
