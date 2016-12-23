<?php
$entity = $vars["entity"];

$icon = elgg_view("icon/default", ["entity" => $entity, "size" => "small"]);
$title = $entity->user["name"];

$date = elgg_view_friendly_time($entity->time_created);

$subtitle = "$date";

$params = array(
    "entity" => $vars["entity"],
    "title" => $title,
    "subtitle" => $subtitle,
    "metadata" => elgg_view("entity/components/process_access", ["entity" => $vars["entity"]])
);

$params = $params + $vars;
$body = elgg_view("object/elements/summary", $params);

echo elgg_view_image_block($icon, $body, $vars);
