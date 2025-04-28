<?php

/**
 * Plugin Name: WordPress Plugin Boilerplate
 * Plugin URI:  https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate
 * Description: A boilerplate plugin for WordPress.
 * Version:     2.1.0
 * Author:      Fourteen Development
 * Author URI:  https://Fourteen.dev/
 * License:     MIT
 * License URI: https://opensource.org/license/mit/
 * Text Domain: wordpress-boilerplate-plugin
 * Domain Path: /languages
 */

use WordPressBoilerplatePlugin\Container;
use WordPressBoilerplatePlugin\Core;

if (!defined('ABSPATH')) return;

define('FDWPBP_VERSION', '2.1.0');
define('FDWPBP_FILE', __FILE__);
define('FDWPBP_URL', plugin_dir_url(FDWPBP_FILE));
define('FDWPBP_DIR', plugin_dir_path(FDWPBP_FILE));
define('FDWPBP_BASENAME', plugin_basename(FDWPBP_FILE));
define('FDWPBP_MENUS_SLUG', 'fdwpbp');
define('FDWPBP_OPTIONS_KEY_DB_VERSION', 'fdwpbp_db_version');

require_once 'vendor/autoload.php';
require_once 'functions.php';

// Uncomment this to check for a required plugin/function before calling the core class
/* if (!function_exists('get_field'))
{
	add_action('admin_notices', function ()
	{
		?>
		<div class="notice notice-error">
			<p><?php esc_html_e('WordPress Plugin Boilerplate: Please enable ACF plugin!', 'wordpress-boilerplate-plugin'); ?></p>
		</div>
		<?php
	});
	return;
} */

// Initialize container and bind Core class
$fdwpbpContainer = new Container();
$fdwpbpContainer->singleton(Container::class, function() use ($fdwpbpContainer) { return $fdwpbpContainer; });
$fdwpbpContainer->singleton(Core::class);

// Initialize the core
$core = $fdwpbpContainer->make(Core::class);

function FDWPBP()
{
	global $fdwpbpContainer;
	return $fdwpbpContainer->make(Core::class);
}
FDWPBP();
