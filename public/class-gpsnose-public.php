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
            wp_enqueue_style($this->plugin_name . '2', plugin_dir_url(__FILE__) . 'Mashup/Libs/bootstrap/css/bootstrap.min.css', array(), $this->version, 'all');
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

        if (isset($options['load-js-jquery']) && $options['load-js-jquery']) {
            wp_enqueue_script($this->plugin_name . '-jquery', plugin_dir_url(__FILE__) . 'Mashup/Libs/jquery/jquery.min.js', array(), $this->version, false);
        }

		if (isset($options['load-js-bootstrap']) && $options['load-js-bootstrap']) {
            wp_enqueue_script($this->plugin_name . '-bootstrap', plugin_dir_url(__FILE__) . 'Mashup/Libs/bootstrap/js/bootstrap.min.js', array(), $this->version, false);
        }

        if (isset($options['load-js-language']) && $options['load-js-language']) {
            wp_enqueue_script($this->plugin_name . '-language', plugin_dir_url(__FILE__) . 'Mashup/Language/en.js', array(), $this->version, false);
        }

        if (isset($options['load-js-bignumber']) && $options['load-js-bignumber']) {
            wp_enqueue_script($this->plugin_name . '-bignumber', plugin_dir_url(__FILE__) . 'Mashup/Libs/bignumber-rev4/bignumber.min.js', array(), $this->version, true);
        }

        if (isset($options['load-js-moment']) && $options['load-js-moment']) {
            wp_enqueue_script($this->plugin_name . '-moment', plugin_dir_url(__FILE__) . 'Mashup/Libs/moment/moment.min.js', array(), $this->version, true);
        }

        if (isset($options['load-js-numeral']) && $options['load-js-numeral']) {
            wp_enqueue_script($this->plugin_name . '-numeral', plugin_dir_url(__FILE__) . 'Mashup/Libs/numeral/numeral.min.js', array(), $this->version, true);
        }

        if (isset($options['load-js-imagesloaded']) && $options['load-js-imagesloaded']) {
            wp_enqueue_script($this->plugin_name . '-imagesloaded', plugin_dir_url(__FILE__) . 'Mashup/Libs/imagesloaded/imagesloaded.pkgd.min.js', array(
                'jquery'
            ), $this->version, true);
        }

        if (isset($options['load-js-masonry']) && $options['load-js-masonry']) {
            wp_enqueue_script($this->plugin_name . '-masonry', plugin_dir_url(__FILE__) . 'Mashup/Libs/masonry-layout/masonry.pkgd.min.js', array(
                'jquery'
            ), $this->version, true);
        }

        if (isset($options['load-js-knockout']) && $options['load-js-knockout']) {
            wp_enqueue_script($this->plugin_name . '-knockout', plugin_dir_url(__FILE__) . 'Mashup/Libs/knockout/knockout-latest.js', array(
                'jquery'
            ), $this->version, true);
        }
        wp_add_inline_script($this->plugin_name . '-knockout', 'var gn_data = {Settings: {}, Community:{Tagname:"%ieslibrary.com"}};');

        if (isset($options['load-js-maframework']) && $options['load-js-maframework']) {
            wp_enqueue_script($this->plugin_name . '-maframework', plugin_dir_url(__FILE__) . 'Mashup/Js/maframework.min.js', array(
                'jquery'
            ), $this->version, true);
        }

        if (isset($options['load-js-gpsnose-ko']) && $options['load-js-gpsnose-ko']) {
            wp_enqueue_script($this->plugin_name . '-gpsnose-ko', plugin_dir_url(__FILE__) . 'Mashup/Js/gpsnose.knockout.js', array(
                'jquery'
            ), $this->version, true);
        }
    }
}
