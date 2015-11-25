<?php
include('config.php');

function bash_quote($string){
	// replace \ with \\ and ['] with ['\'']
  return str_replace(array("\\", "'"), array("\\\\","'\\''"), $string);
};

$code        = $_POST[PYGMENT_SERVICE_CODE_VAR];
$language    = $_POST[PYGMENT_SERVICE_LANGUAGE_VAR];
$linenos     = $_POST[PYGMENT_LINENOS_ATTRIBUTE];
$linenostart = $_POST[PYGMENT_LINENOSTART_ATTRIBUTE];
$style       = $_POST[PYGMENT_STYLE_ATTRIBUTE];
$hl_lines    = $_POST[PYGMENT_HL_LINES_ATTRIBUTE];
$secret      = $_POST[PYGMENT_SERVICE_SECRET_VAR];

if($secret !== PYGMENT_SERVICE_SECRET_KEY){
	echo '<p>Key mismatch.</p>';
	die;
}

// escape any escape characters
$code     = bash_quote($code);
$language = bash_quote($language);

$shell_command = "echo '$code' | pygmentize -O encoding=utf-8,style=$style,linenos=$linenos,linenostart=$linenostart,hl_lines='$hl_lines' -f html -l '$language'";
echo $output = shell_exec($shell_command);