<?php
/**
 * Plugin Name:       Flex Quiz
 * Plugin URI:        https://github.com/simsonasLT/flex-quiz
 * Description:       Ultra-customizable WordPress quiz plugin with progressive questions, category icon progress bars, live admin preview, advanced scoring, analytics, and beautiful modern UI.
 * Version:           2.0.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            simsonasLT
 * Author URI:        https://github.com/simsonasLT
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       flex-quiz
 * Domain Path:       /languages
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FLEX_QUIZ_VERSION', '2.0.0' );
define( 'FLEX_QUIZ_FILE', __FILE__ );
define( 'FLEX_QUIZ_PATH', plugin_dir_path( __FILE__ ) );
define( 'FLEX_QUIZ_URL', plugin_dir_url( __FILE__ ) );
define( 'FLEX_QUIZ_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Simple PSR-4 style autoloader for FlexQuiz namespace.
 */
spl_autoload_register( function ( string $class ): void {
	$prefix = 'FlexQuiz\\';
	$base   = FLEX_QUIZ_PATH . 'includes/';

	if ( strncmp( $prefix, $class, strlen( $prefix ) ) !== 0 ) {
		return;
	}

	$relative = substr( $class, strlen( $prefix ) );
	$file     = $base . str_replace( '\\', '/', $relative ) . '.php';

	if ( file_exists( $file ) ) {
		require $file;
	}
} );

/**
 * Bootstrap.
 */
function flex_quiz_init(): void {
	$plugin = new FlexQuiz\Plugin();
	$plugin->init();
}
add_action( 'plugins_loaded', 'flex_quiz_init' );

register_activation_hook( __FILE__, function (): void {
	$post_types = new FlexQuiz\Post_Types();
	$post_types->register();
	flush_rewrite_rules();

	$defaults = [
		'default_progress_style' => 'icons',
		'default_theme'          => 'modern',
		'enable_analytics'       => true,
		'enable_certificates'    => false,
		'guest_attempts'         => true,
		'store_ip'               => false,
	];
	add_option( 'flex_quiz_settings', $defaults );
} );

register_deactivation_hook( __FILE__, function (): void {
	flush_rewrite_rules();
} );
