<?php
$dbprefix = elgg_get_config("dbprefix");
$access_id = (int) ACCESS_PUBLIC;

$i = 0;

$rows = get_data("SELECT e.guid FROM {$dbprefix}groups_entity ge JOIN elgg_entities e ON ge.guid = e.guid WHERE e.type = 'group' AND e.access_id != {$access_id}");

if ($rows) {
    foreach ($rows as $row) {
        $group = get_entity($row->guid);
        if (!$group) {
            continue;
        }

        $group->access_id = ACCESS_PUBLIC;
        $group->save();
        $i++;
    }
}

system_message("Probleem opgelost voor {$i} groep(en).");

forward(REFERER);