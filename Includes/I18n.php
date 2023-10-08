<?php

namespace Swizzbits\Gpsnose\Includes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since 1.0.0
 * @package Gpsnose
 * @subpackage Gpsnose/Includes
 * @author smart.nose <dev@gpsnose.com>
 */
class I18n
{
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain('gpsnose', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/');
	}
}
