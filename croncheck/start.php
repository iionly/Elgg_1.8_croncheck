<?php

elgg_register_event_handler('init','system','croncheck_init');

function croncheck_init() {

	elgg_register_plugin_hook_handler('cron', 'minute', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'fiveminute', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'fifteenmin', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'halfhour', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'hourly', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'daily', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'weekly', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'monthly', 'croncheck_monitor');
	elgg_register_plugin_hook_handler('cron', 'yearly', 'croncheck_monitor');

	elgg_register_admin_menu_item('administer', 'cron', 'statistics');
}

function croncheck_monitor($hook, $entity_type, $returnvalue, $params) {
	elgg_set_plugin_setting("latest_" . $entity_type . "_ts", time(), "croncheck");
}
