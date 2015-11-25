<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '1');


require_once('class.php');

// a simple script to test the built-in webservice
require_once ('config.php' );

$path = str_replace( '/test.php', '/webservice.php', $_SERVER[REQUEST_URI]);
$url = $_SERVER[HTTP_HOST] . $path;
echo "<p>Service URL: " . $url . '</p>';

include ('functions.php');

$code = 'function test() { echo "this is it";}';

$lang = 'php';
echo $result = Pygmenter::get_pygment($code, $lang, null, '1', PYGMENT_DEFAULT_STYLE, null, $url);
?>