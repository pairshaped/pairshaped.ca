<?php
require_once('class.php');

function webservice_notice($cache){
	if(DISPLAY_WEBSERVICE_NOTICE === TRUE){
		$cache .= '<p style="font-size:small;">Pygmented code retrieved from webservice.</p>';
	}
	return $cache;
}

function prettify_code($attributes, $content=''){
  $content = str_replace('&#038;', '&', $content); // already encoded by WP
  
	Pygmenter::$code_count++;
	$cache_var = PYGMENT_CACHE_VAR . '_' . Pygmenter::$code_count;
	$cache_hash_var = PYGMENT_CACHE_HASH_VAR . '_' . Pygmenter::$code_count;
	global $post;

	$defaults = array(
		PYGMENT_LANGUAGE_ATTRIBUTE    => PYGMENT_DEFAULT_LANGUAGE,
		PYGMENT_LINENOS_ATTRIBUTE     => null,
		PYGMENT_LINENOSTART_ATTRIBUTE => PYGMENT_DEFAULT_LINENOSTART,
		PYGMENT_STYLE_ATTRIBUTE       => PYGMENT_DEFAULT_STYLE,
		PYGMENT_HL_LINES_ATTRIBUTE    => null
	);

	extract(shortcode_atts($defaults, $attributes));

	if(CACHE_ENABLED){
		$hash       = hash(PYGMENT_HASH, $content . $language . $linenostart . $hl_lines . $linenos);
		$cache      = get_post_meta($post->ID, $cache_var, $single = TRUE);
		$cache_hash = get_post_meta($post->ID, $cache_hash_var, $single = TRUE);

		if($cache_hash != $hash){
			$cache = Pygmenter::get_pygment($content, $language, $linenos, $linenostart, $style, $hl_lines);
			update_post_meta($post->ID, $cache_var, $cache);
			update_post_meta($post->ID, $cache_hash_var, $hash);
			$cache = webservice_notice($cache);
		}
	}else{
		$cache = Pygmenter::get_pygment($content, $language, $linenos, $linenostart, $style, $hl_lines);
		$cache = webservice_notice($cache);
	}

	return $cache;
}

function exclude_code( $excluded_shortcodes ) {
	$excluded_shortcodes[] = PYGMENT_SHORTCODE_NAME;

	// While we're at it, remove autop and replace it with a lower priority
	// so that it runs after shortcodes.
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 12 );
	return $excluded_shortcodes;
}

function add_pygment_stylesheet() {
	wp_register_style(PYGMENT_STYLE_NAME, plugins_url('css/' . PYGMENT_THEME . '.css', __FILE__));
	wp_enqueue_style(PYGMENT_STYLE_NAME);
}