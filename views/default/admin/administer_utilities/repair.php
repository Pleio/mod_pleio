<p>
    <?php echo elgg_echo("admin:administer_utilities:repair:description"); ?>
</p>

<?php
echo elgg_view_module(
    "inline",
    elgg_echo("pleio:hidden_groups"),
    elgg_view("admin/administer_utilities/repair/hidden_groups")
);

echo elgg_view_module(
    "inline",
    elgg_echo("pleio:broken_plugins"),
    elgg_view("admin/administer_utilities/repair/broken_plugins")
);