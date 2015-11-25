<?php 
/*
Plugin Name: Pygment It
Plugin URI: https://github.com/glaucocustodio/pygment_it
Description: Syntax highlighting with Pygments. Usage: [code language="ruby"]code here[/code]
Version: 0.2
Author: Glauco Custódio
Author URI: http://glaucocustodio.com
*/
define('DEFAULT_THEME', 'monokai');
define('DEFAULT_THEME_OPTION_NAME', 'pei-default-theme');
define('PYGMENT_THEME', get_option(DEFAULT_THEME_OPTION_NAME, DEFAULT_THEME));
define('PYGMENT_INS_OPTION_NAME', 'pei-pygment-ins');
define('PYGMENT_INS', get_option(PYGMENT_INS_OPTION_NAME, 'a'));
define('DEFAULT_LANGUAGE_OPTION_NAME', 'pei-default-language');
define('PYGMENT_DEFAULT_LANGUAGE', get_option(DEFAULT_LANGUAGE_OPTION_NAME, 'html'));

require_once('config.php');

require_once('functions.php');

require_once('admin_menu.php');

add_filter('no_texturize_shortcodes', 'exclude_code');
add_shortcode(PYGMENT_SHORTCODE_NAME, 'prettify_code');
add_action('wp_enqueue_scripts', 'add_pygment_stylesheet');