<?php
/**
 * Plugin Name:       Open Weather Map
 * Plugin URI:        https://techda.net
 * Description:       WP Plugin with custom cpt for cities
 * Version:           1.0.0
 * Requires at least: 5.8.3
 * Requires PHP:      7.4
 * Author:            Ahmed Dhaoui
 * Author URI:        https://techda.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       open-weather-map
 */

defined('ABSPATH') or die();

if (!class_exists()) {
    class OpenWeatherMap
    {
        public function __construct()
        {
            //TODO Plugin activation
            //TODO register CPT
            //TODO register ACF fields
            //TODO include cpt templates
            //TODO Plugin deactivation
            //TODO unregister cpt
            //TODO unregister ACF fields
            //TODO Plugin uninstall
            //TODO class API open weather API with settings option
        }

        function activate_plugin()
        {
            //TODO check if acf installed & activated
            flush_rewrite_rules();
        }

        function register_cities_cpt()
        {
        }

        function deactivate_plugin()
        {
            flush_rewrite_rules();
        }

        function uninstall_plugin()
        {
            //TODO clear Plugin Data
            //Delete CPT posts
            //Delete settings option
        }

    }

    new OpenWeatherMap();
}