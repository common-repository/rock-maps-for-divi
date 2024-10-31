<?php
/**
 * Plugin Name: Rock Maps for Divi
 * Plugin URI: https://www.elegantthemes.com/marketplace/divi-rock-maps/
 * Description: Rock Maps for Divi is a powerful Divi plugin that allows you to create custom maps with multiple markers and custom popups.
 * Version: 1.0.1
 * Author: Quaira
 * Author URI: https://quaira.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dirm-divi-rock-maps
 * Domain Path: /languages
 * Requires PHP: 7.4
 *
 * @package DiviRockMaps
 */

if ( ! defined( 'DIRM_OPTIONS_PREFIX' ) ) {
	/**
	 * Options prefix constant for saving plugin settings
	 */
	define( 'DIRM_OPTIONS_PREFIX', 'divi_dirm' );
}
if ( ! defined( 'DIRM_PLUGIN_PATH' ) ) {
	/**
	 * Plugin path constant
	 */
	define( 'DIRM_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}
if ( ! function_exists( 'dirm_initialize_extension' ) ) {
	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */
	function dirm_initialize_extension() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-dirm-divirockmaps.php';
	}

	add_action( 'divi_extensions_init', 'dirm_initialize_extension' );
}


if ( ! function_exists( 'dirm_activate' ) ) {
	/**
	 * Perform plugin activation tasks.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function dirm_activate() {
		$map_provider_option        = DIRM_OPTIONS_PREFIX . '_map_provider';
		$map_provider_option_exists = et_get_option( $map_provider_option );
		if ( ! $map_provider_option_exists ) {
			et_update_option( $map_provider_option, 'leaflet' );
		}
		$expose_all_acf_group_fields_to_rest_api_option        = DIRM_OPTIONS_PREFIX . '_expose_all_acf_group_fields_to_rest_api';
		$expose_all_acf_group_fields_to_rest_api_option_exists = et_get_option( $expose_all_acf_group_fields_to_rest_api_option );
		if ( ! $expose_all_acf_group_fields_to_rest_api_option_exists ) {
			et_update_option( $expose_all_acf_group_fields_to_rest_api_option, 'on' );
			if ( 'on' === et_get_option( $expose_all_acf_group_fields_to_rest_api_option ) ) {
				dirm_update_rest_api_for_acf_group_fields( true );
			}
		}
	}

	register_activation_hook( __FILE__, 'dirm_activate' );
}
if ( ! function_exists( 'dirm_update_rest_api_for_acf_group_fields' ) ) {
	/**
	 * Enable REST API for ACF group fields.
	 *
	 * @param bool $value The value to set for the show_in_rest property.
	 *
	 * @return void
	 */
	function dirm_update_rest_api_for_acf_group_fields( bool $value ): void {
		// Check if ACF plugin is active.
		if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
			// Enable REST API for all group fields.
			if ( function_exists( 'acf_get_field_groups' ) ) {
				$field_groups = acf_get_field_groups();
				foreach ( $field_groups as $group ) {
					$group['show_in_rest'] = $value;
					acf_update_field_group( $group );
				}
			}
		}
	}
}
if ( ! function_exists( 'dirm_add_to_head' ) ) {
	/**
	 * Remove partial compatibility message
	 *
	 * @return void
	 */
	function dirm_add_to_head(): void {
		if ( is_user_logged_in() ) {
			echo '<style>.et-fb-modal__support-notice {display: none !important;}</style>';
		}
	}

	add_action( 'wp_head', 'dirm_add_to_head' );
	add_action( 'admin_head', 'dirm_add_to_head' );
}

if ( ! function_exists( 'dirm_check_acf_rest_api_option' ) ) {
	/**
	 * Check if the ACF REST API option has changed.
	 *
	 * @param mixed $et_option_name The name of the option to update.
	 * @param mixed $et_option_new_value The new value of the option.
	 *
	 * @return void
	 */
	function dirm_check_acf_rest_api_option( $et_option_name, $et_option_new_value ) {
		if ( DIRM_OPTIONS_PREFIX . '_expose_all_acf_group_fields_to_rest_api' === $et_option_name ) {
			// Call the function to enable REST API for ACF fields.
			$value = 'on' === $et_option_new_value;
			dirm_update_rest_api_for_acf_group_fields( $value );
		}
	}

	// Hook into the et_epanel_update_option action to check if the option value has changed.
	add_action( 'et_epanel_update_option', 'dirm_check_acf_rest_api_option', 10, 3 );
}
