<?php
$dbprefix = elgg_get_config("dbprefix");

$i = 0;

$subtype = get_subtype_id("object", "plugin");
$result = get_data("SELECT e.guid, oe.title FROM {$dbprefix}entities e JOIN {$dbprefix}objects_entity oe ON e.guid = oe.guid WHERE e.type = 'object' AND e.subtype = '{$subtype}' AND e.enabled = 'no'");

$dir = elgg_get_plugins_path();
$physical_plugins = elgg_get_plugin_ids_in_dir($dir);

access_show_hidden_entities(true);

if ($result) {
    foreach ($result as $plugin) {
        if (!in_array($plugin->title, $physical_plugins)) {
            // plugin is deleted
            continue;
        }


        $plugin = get_entity($plugin->guid);

        if (!$plugin) {
            continue;
        }

        $plugin->enable();
        $plugin->setPrivateSetting("elgg:internal:priority", "latest");

        $i++;
    }
}

system_message("Probleem opgelost voor {$i} plugin(s).");

forward(REFERER);