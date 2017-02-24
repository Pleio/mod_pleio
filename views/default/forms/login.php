<?php
$login_credentials = elgg_get_plugin_setting("login_credentials", "pleio");
$idp = elgg_get_plugin_setting("idp", "pleio");
$idp_name = elgg_get_plugin_setting("idp_name", "pleio");
?>

<p>
    <?php echo elgg_view("output/url", array(
            "href" => "/login",
            "class" => "elgg-button-submit elgg-button",
            "text" => $idp && $idp_name ? elgg_echo("pleio:settings:login_through", [$idp_name]) : elgg_echo("login")
    )); ?>
</p>

<?php if ($login_credentials === "yes"): ?>
    <p>
        <?php echo elgg_view("output/url", array(
            "href" => "/login?login_credentials=true",
            "text" => elgg_echo("pleio:login_with_credentials")
        )); ?>
    </p>
<?php endif; ?>
