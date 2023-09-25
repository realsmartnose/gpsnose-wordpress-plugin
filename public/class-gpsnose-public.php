<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/realsmartnose
 * @since      1.0.0
 *
 * @package    Gpsnose
 * @subpackage Gpsnose/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package Gpsnose
 * @subpackage Gpsnose/public
 * @author smart.nose <dev@gpsnose.com>
 */
class Gpsnose_Public
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
     *            The name of the plugin.
     * @param string $version
     *            The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {
        $options = get_option($this->plugin_name);

        if (isset($options['load-css-bootstrap']) && $options['load-css-bootstrap']) {
            wp_enqueue_style($this->plugin_name . '1', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $this->version, 'all');
        }
        if (isset($options['load-css-gpsnose']) && $options['load-css-gpsnose']) {
            wp_enqueue_style($this->plugin_name . '2', plugin_dir_url(__FILE__) . 'Mashup/Css/style.min.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
        $options = get_option($this->plugin_name);

        if (isset($options['load-js-bootstrap']) && $options['load-js-bootstrap']) {
            wp_enqueue_script($this->plugin_name . '0', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(
                'jquery'
            ), $this->version, false);
        }

        if (isset($options['load-js-language']) && $options['load-js-language']) {
            wp_enqueue_script($this->plugin_name . '1', plugin_dir_url(__FILE__) . 'Mashup/Language/en.js', array(), $this->version, false);
        }

        if (isset($options['load-js-bignumber']) && $options['load-js-bignumber']) {
            wp_enqueue_script($this->plugin_name . '2', plugin_dir_url(__FILE__) . 'Mashup/Libs/bignumber-rev4/js/bignumber.min.js', array(), $this->version, true);
        }

        if (isset($options['load-js-moment']) && $options['load-js-moment']) {
            wp_enqueue_script($this->plugin_name . '3', plugin_dir_url(__FILE__) . 'Mashup/Libs/moment/2.17.1/moment.min.js', array(), $this->version, true);
        }

        if (isset($options['load-js-numeral']) && $options['load-js-numeral']) {
            wp_enqueue_script($this->plugin_name . '4', plugin_dir_url(__FILE__) . 'Mashup/Libs/Numeral-js/2.0.6/numeral.min.js', array(), $this->version, true);
        }

        if (isset($options['load-js-imagesloaded']) && $options['load-js-imagesloaded']) {
            wp_enqueue_script($this->plugin_name . '5', plugin_dir_url(__FILE__) . 'Mashup/Libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js', array(
                'jquery'
            ), $this->version, true);
        }

        if (isset($options['load-js-masonry']) && $options['load-js-masonry']) {
            wp_enqueue_script($this->plugin_name . '6', plugin_dir_url(__FILE__) . 'Mashup/Libs/masonry/4.2.1/masonry.pkgd.min.js', array(
                'jquery'
            ), $this->version, true);
        }

        if (isset($options['load-js-knockout']) && $options['load-js-knockout']) {
            wp_enqueue_script($this->plugin_name . '7', plugin_dir_url(__FILE__) . 'Mashup/Libs/knockout/3.4.2/knockout.js', array(
                'jquery'
            ), $this->version, true);
        }

        wp_add_inline_script($this->plugin_name . '8', 'var gn_data = {};');

        if (isset($options['load-js-maframework']) && $options['load-js-maframework']) {
            wp_enqueue_script($this->plugin_name . '9', plugin_dir_url(__FILE__) . 'Mashup/Js/maframework.min.js', array(
                'jquery'
            ), $this->version, true);
        }

        if (isset($options['load-js-gpsnose-ko']) && $options['load-js-gpsnose-ko']) {
            wp_enqueue_script($this->plugin_name . '10', plugin_dir_url(__FILE__) . 'Mashup/Js/gpsnose.knockout.js', array(
                'jquery'
            ), $this->version, true);
        }
    }
}
