<?php
require_once( 'config.php' );
if(class_exists('Pygmenter') != true){
	class Pygmenter{
		public static $code_count = -1;
		
		public static function get_pygment($code, $language, $linenos, $linenostart,
																			 $style, $hl_lines, $service_url = PYGMENT_SERVICE_URL){
			$curl = curl_init();
			#var_dump($service_url);

			curl_setopt($curl, CURLOPT_URL, $service_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1);

			$post_data = array(
					PYGMENT_SERVICE_CODE_VAR      => $code,
					PYGMENT_SERVICE_LANGUAGE_VAR  => $language,
					PYGMENT_LINENOS_ATTRIBUTE     => $linenos,
					PYGMENT_LINENOSTART_ATTRIBUTE => $linenostart,
					PYGMENT_STYLE_ATTRIBUTE       => $style,
					PYGMENT_HL_LINES_ATTRIBUTE    => $hl_lines
			);
		
			// add the included webservice secret key only if defined
			if (defined('PYGMENT_SERVICE_SECRET_KEY') && defined('PYGMENT_SERVICE_SECRET_VAR')){
				$post_data[PYGMENT_SERVICE_SECRET_VAR] = PYGMENT_SERVICE_SECRET_KEY;
			}

			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);

			$output = curl_exec($curl);

			#$troubleshoot = curl_getinfo($curl);
			curl_close($curl);

			return '<div class="pygment ' . PYGMENT_BLOCK_EXTRA_CLASSES . '">' . $output . '</div>';
		}
	}
}