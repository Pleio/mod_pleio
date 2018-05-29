<?php
$dbprefix = elgg_get_config("dbprefix");
$access_id = (int) ACCESS_PUBLIC;

$subtype = get_subtype_id("object", "plugin");

$result = get_data("SELECT e.guid, oe.title FROM {$dbprefix}entities e JOIN {$dbprefix}objects_entity oe ON e.guid = oe.guid WHERE e.type = 'object' AND e.subtype = '{$subtype}' AND e.enabled = 'no'");
if ($result) {
    $count = count($result);

    $dir = elgg_get_plugins_path();
    $physical_plugins = elgg_get_plugin_ids_in_dir($dir);

    foreach ($result as $plugin) {
        if (!in_array($plugin->title, $physical_plugins)) {
            // plugin is deleted
            $count--;
        }
    }
} else {
    $count = 0;
}
?>

<?php if ($count > 0): ?>
    Er zijn problemen met <?php echo $count; ?> plugin(s).

    <?php echo elgg_view("output/confirmlink", [
        "href" => "/action/admin/repair_broken_plugins",
        "text" => "Repareer kapotte plugins",
        "class" => "elgg-button elgg-button-submit",
        "is_action" => true
    ]); ?>

<?php else: ?>
    Er zijn geen problemen gevonden.
<?php endif; ?>
