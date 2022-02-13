<?php

namespace SmartNoses\Gpsnose\Frontend;

use SmartNoses\Gpsnose\Backend\Settings;

if (!defined('ABSPATH')) {
	die('');
}

class Header
{
	/**
	 * __constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Set the needed meta-tags
	 *
	 * @return void
	 */
	public function set_meta()
	{
		add_action('wp_head', [$this, 'gpsnose_validation_meta']);
	}

	/**
	 * Add the validation meta-tag
	 *
	 * @return void
	 */
	public function gpsnose_validation_meta()
	{
		$gpsnose_validation_key = Settings::get_value_for_option('gpsnose_validation_key');
		if ($gpsnose_validation_key) {
?>
			<meta name="gpsnose-validation-key" content="<?php echo $gpsnose_validation_key ?>" />
<?php
		}
	}
}
