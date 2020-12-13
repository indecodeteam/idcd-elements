<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://facebook.com/InDecodeTeam
 * @since             1.0.0
 * @package           Idcd_Elements
 *
 * @wordpress-plugin
 * Plugin Name:       InDecode Elements
 * Plugin URI:        https://github.com/indecodeteam/idcd-element
 * Description:       Addons for Elementor from InDecode
 * Version:           1.0.0
 * Author:            InDecode Team
 * Author URI:        https://facebook.com/InDecodeTeam
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       idcd-elements
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
define( 'IDCD_ELEMENTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-idcd-elements-activator.php
 */
function activate_idcd_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-idcd-elements-activator.php';
	Idcd_Elements_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-idcd-elements-deactivator.php
 */
function deactivate_idcd_elements() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-idcd-elements-deactivator.php';
	Idcd_Elements_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_idcd_elements' );
register_deactivation_hook( __FILE__, 'deactivate_idcd_elements' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-idcd-elements.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_idcd_elements() {

	$plugin = new Idcd_Elements();
	$plugin->run();

}
run_idcd_elements();
