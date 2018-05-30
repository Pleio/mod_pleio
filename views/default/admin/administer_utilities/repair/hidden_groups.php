<?php
$dbprefix = elgg_get_config("dbprefix");
$access_id = (int) ACCESS_PUBLIC;

$result = get_data_row("SELECT COUNT(*) AS count FROM {$dbprefix}groups_entity ge JOIN elgg_entities e ON ge.guid = e.guid WHERE e.type = 'group' AND e.access_id != {$access_id}");
if ($result) {
    $count = $result->count;
} else {
    $count = 0;
}
?>

<?php if ($count > 0): ?>
    Er zijn problemen met <?php echo $count; ?> groep(en).

    <?php echo elgg_view("output/confirmlink", [
        "href" => "/action/admin/repair_hidden_groups",
        "text" => "Repareer verborgen groepen",
        "class" => "elgg-button elgg-button-submit",
        "is_action" => true
    ]); ?>

<?php else: ?>
    Er zijn geen problemen gevonden.
<?php endif; ?>
