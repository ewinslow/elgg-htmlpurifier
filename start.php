<?php
/**
 * Elgg HTML Purifier tag filtering.
 */

/**
 * Initialize plugin
 */
function htmlpurifier_init() {
	elgg_register_plugin_hook_handler('validate', 'input', 'htmlpurifier_filter_tags', 1);
}

/**
 * htmLawed filtering of tags, called on a plugin hook
 *
 * @param mixed $var Variable to filter
 * @return mixed
 */
function htmlpurifier_filter_tags($hook, $entity_type, $input, $params) {
	require_once dirname(__FILE__) . '/vendors/htmlpurifier-4.5.0-lite/library/HTMLPurifier.auto.php';
	
	$htmlpurifier_config = HTMLPurifier_Config::createDefault();
	$htmlpurifier_config->set('HTML', 'Nofollow', true);
	$htmlpurifier_config = elgg_trigger_plugin_hook('config', 'htmlpurifier', NULL, $htmlpurifier_config);
    $purifier = new HTMLPurifier($htmlpurifier_config);
    
	if (!is_array($input)) {
		
	    return $purifier->purify($input);

	} else {
		
		array_walk_recursive($input, 'htmlpurifierArray', $purifier);

		return $input;
		
	}
}

/**
 * wrapper function for htmlpurifier for handling arrays
 */
function htmlpurifierArray(&$v, $k, HTMLPurifier &$purifier) {
	$v = $purifier->purify($v);
}



elgg_register_event_handler('init', 'system', 'htmlpurifier_init');
