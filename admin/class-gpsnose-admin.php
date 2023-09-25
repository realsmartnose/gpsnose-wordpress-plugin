<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/realsmartnose
 * @since      1.0.0
 *
 * @package    Gpsnose
 * @subpackage Gpsnose/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package Gpsnose
 * @subpackage Gpsnose/admin
 * @author smart.nose <dev@gpsnose.com>
 */
class Gpsnose_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since 1.0.0
     * @access private
     * @var string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since 1.0.0
     * @access private
     * @var string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name
     *            The name of this plugin.
     * @param string $version
     *            The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Gpsnose_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Gpsnose_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/gpsnose-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Gpsnose_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Gpsnose_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/gpsnose-admin.js', array(
            'jquery'
        ), $this->version, false);
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since 1.0.0
     */
    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE: Alternative menu locations are available via WordPress administration menu functions.
         *
         * Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_options_page('GpsNose Functions Setup', 'GpsNose', 'manage_options', $this->plugin_name, array(
            $this,
            'display_plugin_setup_page'
        ));
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since 1.0.0
     */
    public function add_action_links($links)
    {
        /*
         * Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
         */
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>'
        );
        return array_merge($settings_link, $links);
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since 1.0.0
     */
    public function display_plugin_setup_page()
    {
        include_once ('partials/gpsnose-admin-display.php');
    }

    /**
     * Validate input in settings
     *
     * @since 1.0.0
     * @param array $input
     * @return mixed[]
     */
    public function validate($input)
    {
        $valid = array();

        $valid['mashup'] = $input['mashup'];
        $valid['app-key'] = $input['app-key'];

        $valid['load-css-bootstrap'] = (isset($input['load-css-bootstrap']) && $input['load-css-bootstrap'] ? '1' : '0');
        $valid['load-css-gpsnose'] = (isset($input['load-css-gpsnose']) && $input['load-css-gpsnose'] ? '1' : '0');

        $valid['load-js-bootstrap'] = (isset($input['load-js-bootstrap']) && $input['load-js-bootstrap'] ? '1' : '0');
        $valid['load-js-language'] = (isset($input['load-js-language']) && $input['load-js-language'] ? '1' : '0');

        $valid['load-js-bignumber'] = (isset($input['load-js-bignumber']) && $input['load-js-bignumber'] ? '1' : '0');
        $valid['load-js-moment'] = (isset($input['load-js-moment']) && $input['load-js-moment'] ? '1' : '0');
        $valid['load-js-numeral'] = (isset($input['load-js-numeral']) && $input['load-js-numeral'] ? '1' : '0');
        $valid['load-js-imagesloaded'] = (isset($input['load-js-imagesloaded']) && $input['load-js-imagesloaded'] ? '1' : '0');
        $valid['load-js-masonry'] = (isset($input['load-js-masonry']) && $input['load-js-masonry'] ? '1' : '0');
        $valid['load-js-knockout'] = (isset($input['load-js-knockout']) && $input['load-js-knockout'] ? '1' : '0');
        $valid['load-js-maframework'] = (isset($input['load-js-maframework']) && $input['load-js-maframework'] ? '1' : '0');
        $valid['load-js-gpsnose-ko'] = (isset($input['load-js-gpsnose-ko']) && $input['load-js-gpsnose-ko'] ? '1' : '0');

        return $valid;
    }

    /**
     * Update GpsNose settings
     *
     * @since 1.0.0
     */
    public function options_update()
    {
        // TODO: Update subcomms?
        register_setting($this->plugin_name, $this->plugin_name, array(
            $this,
            'validate'
        ));
    }
}
