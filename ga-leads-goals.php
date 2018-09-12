<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://fb.me/michael.carl.hurley
 * @since             1.0.0
 * @package           Ga_Leads_Goals
 *
 * @wordpress-plugin
 * Plugin Name:       GA Call, Email + Form conversion goals
 * Plugin URI:        ga-leads-goals
 * Description:       This plugin will convert plain text phone #s & emails to links and send events to GA when clicked, phone clicks/taps send (lead, click, call {anchor_text}) email clicks/taps send (lead, click, email {anchor_text}) form submissions are tracked on page load if the url matches /thank/ regular expression.
 * Version:           1.0.0
 * Author:            Michael Hurley
 * Author URI:        https://fb.me/michael.carl.hurley
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ga-leads-goals
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ga-leads-goals-activator.php
 */
function activate_ga_leads_goals() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ga-leads-goals-activator.php';
	Ga_Leads_Goals_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ga-leads-goals-deactivator.php
 */
function deactivate_ga_leads_goals() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ga-leads-goals-deactivator.php';
	Ga_Leads_Goals_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ga_leads_goals' );
register_deactivation_hook( __FILE__, 'deactivate_ga_leads_goals' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ga-leads-goals.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ga_leads_goals() {

	$plugin = new Ga_Leads_Goals();
	$plugin->run();

}
run_ga_leads_goals();
