<?php
$login_credentials = elgg_get_plugin_setting("login_credentials", "pleio");
?>

<?php echo elgg_view("output/url", array(
        "href" => "/login",
        "class" => "elgg-button-submit elgg-button",
        "text" => elgg_echo("login")
)); ?>

<?php if ($login_credentials === "yes"): ?>
    <div class="elgg-subtext">
        <?php echo elgg_view("output/url", array(
            "href" => "/login?login_credentials=true",
            "text" => elgg_echo("pleio:login_with_credentials")
        )); ?>
    </div>
<?php endif; ?>
