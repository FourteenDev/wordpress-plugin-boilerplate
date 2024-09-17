<?php

/**
 * Plugin Name:     WordPress Plugin Boilerplate
 * Plugin URI:      https://GitHub.com/FourteenDev/wordpress-plugin-boilerplate
 * Description:     A boilerplate plugin for WordPress.
 * Version:         1.1.0
 * Author:          Fourteen Development
 * Author URI:      https://Fourteen.dev/
 * License:         MIT
 * License URI:     https://opensource.org/license/mit/
 * Text Domain:     wordpress-boilerplate-plugin
 * Domain Path:     /languages
 */

use WordPressBoilerplatePlugin\Core;

if (!defined('ABSPATH')) return;

define('FDWPBP_VERSION', '1.1.0');
define('FDWPBP_FILE', __FILE__);
define('FDWPBP_URL', plugin_dir_url(FDWPBP_FILE));
define('FDWPBP_DIR', plugin_dir_path(FDWPBP_FILE));
define('FDWPBP_BASENAME', plugin_basename(FDWPBP_FILE));
define('FDWPBP_SETTINGS_SLUG', 'fdwpbp');
define('FDWPBP_OPTIONS_KEY_DB_VERSION', 'fdwpbp_db_version');

require_once 'vendor/autoload.php';
require_once 'functions.php';

function FDWPBP()
{
	return Core::getInstance();
}
FDWPBP();
