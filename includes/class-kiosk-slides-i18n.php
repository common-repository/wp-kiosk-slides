<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.enformio.at
 * @since      1.0.0
 *
 * @package    Enformio_Kiosk_Slides
 * @subpackage Enformio_Kiosk_Slides/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Enformio_Kiosk_Slides
 * @subpackage Enformio_Kiosk_Slides/includes
 * @author     ENFORMIO <office@enformio.at>
 */
class Enformio_Kiosk_Slides_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'kiosk-slides',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
