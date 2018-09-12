<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://fb.me/michael.carl.hurley
 * @since      1.0.0
 *
 * @package    Ga_Leads_Goals
 * @subpackage Ga_Leads_Goals/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ga_Leads_Goals
 * @subpackage Ga_Leads_Goals/includes
 * @author     Michael Hurley <michael@whitefoxstudios.net>
 */
class Ga_Leads_Goals_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ga-leads-goals',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
