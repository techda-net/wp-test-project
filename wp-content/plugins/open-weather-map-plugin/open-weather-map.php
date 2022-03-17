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

if (!class_exists(OpenWeatherMap::class)) {
    class OpenWeatherMap
    {
        public function __construct()
        {
            //Plugin activation
            register_activation_hook(__FILE__, [$this, 'activate_plugin']);
            //register CPT
            add_action('init', [$this, 'register_cities_cpt']);
            //TODO register ACF fields
            //TODO include cpt templates
            //TODO Plugin deactivation
            //TODO unregister cpt
            //TODO unregister ACF fields
            //TODO Plugin uninstall
            //TODO class API open weather API with settings option
        }

        /**
         * Function called on plugin activation, will check if acf Plugin installed & activated
         *
         */
        function activate_plugin()
        {
            //check if acf installed & activated
            if (!is_plugin_active('advanced-custom-fields/acf.php')) {
                wp_die('Pls install & active ACF to use this Plugin!');
            }
            $this->register_cities_cpt();
            flush_rewrite_rules();
        }

        /**
         * register post type : cities
         */
        function register_cities_cpt()
        {
            $labels = [
                "name" => __("cities", "open-weather-map"),
                "singular_name" => __("city", "open-weather-map"),
            ];

            $args = [
                "label" => __("cities", "open-weather-map"),
                "labels" => $labels,
                "description" => "",
                "public" => true,
                "publicly_queryable" => true,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "has_archive" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "rewrite" => ["slug" => "cities", "with_front" => true],
                "query_var" => true,
                "supports" => ["title"],
                "show_in_graphql" => false,
            ];

            register_post_type("cities", $args);
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