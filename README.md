# HTML Purifier for Elgg #
This plugin provides alternative support to HTMLawed for filtering user input.  
It is supposedly more secure, but also probably slower.

See http://htmlpurifier.org/ for details about configuring HTML Purifier as well as comparisons
with other filtering tools.

## Customizing the configuration ##
This plugin ships with the default configuration of HTMLPurifier.  If you'd like to customize
this configuration in an upgrade-safe way, you can use the provided plugin hook like so:

```php
elgg_register_plugin_hook_handler('config', 'htmlpurifier', 'foo');

function foo($hook, $type, $config) {
	$config->set(...);
	
	return $config;
}
```