<?php
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// ini_set('display_errors', '1');

define('PYGMENT_CACHE_VAR', 'pygment_cache');
define('PYGMENT_CACHE_HASH_VAR', 'pygment_cache_hash');
define('PYGMENT_HASH', 'crc32b');
define('PYGMENT_SHORTCODE_NAME', 'code');

define('PYGMENT_SERVICE_CODE_VAR', 'code');
define('PYGMENT_SERVICE_LANGUAGE_VAR', 'lang');

define('PYGMENT_LANGUAGE_ATTRIBUTE', 'language');
define('PYGMENT_LINENOS_ATTRIBUTE', 'linenos');
define('PYGMENT_LINENOSTART_ATTRIBUTE', 'linenostart');
define('PYGMENT_STYLE_ATTRIBUTE', 'style');
define('PYGMENT_HL_LINES_ATTRIBUTE', 'hl_lines');

define('PYGMENT_DEFAULT_STYLE', 'colorful');
define('PYGMENT_DEFAULT_LINENOSTART', '1');
define('CACHE_ENABLED', TRUE);

define('PYGMENT_EXTERNAL_WEBSERVICE_URL', 'http://pygments.appspot.com/');
define('PYGMENT_SERVICE_SECRET_VAR', 'secret');
define('PYGMENT_SERVICE_SECRET_KEY', 'MZ##l}`AJ15HqG/:12Qi{o]}DG_/^xD5?#WZGiR5D-^=BI6.+#YC?VBK%]Z8BZAr');

if(PYGMENT_INS == 'a'){
  if(function_exists('plugins_url')){
    #$starttime = microtime(true);
    # Check if pygments is installed, if not, call external webservice
    $out = shell_exec('command -v pygmentize');
    #$endtime = microtime(true);
    #echo $time_taken = $endtime-$starttime;
    
    if(!$out){
      // external webservice
      define('PYGMENT_SERVICE_URL', PYGMENT_EXTERNAL_WEBSERVICE_URL);
    }else{
      // built in webservice
      define('PYGMENT_SERVICE_URL', plugins_url('/webservice.php', __FILE__ ));
    }
  }else{
    // external webservice
    define('PYGMENT_SERVICE_URL', PYGMENT_EXTERNAL_WEBSERVICE_URL);
  }
}elseif(PYGMENT_INS == 'y'){
  // built in webservice
  define('PYGMENT_SERVICE_URL', plugins_url('/webservice.php', __FILE__ ));
}else{
  // external webservice
  define('PYGMENT_SERVICE_URL', PYGMENT_EXTERNAL_WEBSERVICE_URL);
}


define('PYGMENT_STYLE_NAME', 'pygment-style');
define('PYGMENT_BLOCK_EXTRA_CLASSES', 'code');

// set to false to hide a notice when the pygmented
// HTML is first retrieved from the webservice. Use
// to help trouble shoot (or to set your mind at ease
// as to when the webservice is being contacted).
define('DISPLAY_WEBSERVICE_NOTICE', FALSE);
