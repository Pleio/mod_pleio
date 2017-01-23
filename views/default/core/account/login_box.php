<?php

$module = elgg_extract('module', $vars, 'aside');
$title = elgg_extract('title', $vars, elgg_echo('login'));
$login_credentials = elgg_get_plugin_setting("login_credentials", "pleio_login");

$body = elgg_view("output/url", array(
        "href" => "/login",
        "class" => "elgg-button-submit elgg-button",
        "text" => elgg_echo("login")
));

if ($login_credentials === "yes") {
    $body .= "<div class=\"elgg-subtext\">";
    $body .= elgg_view("output/url", array(
        "href" => "/login?login_credentials=true",
        "text" => elgg_echo("pleio:login_with_credentials")
    ));
    $body .= "</div>";
}

echo elgg_view_module($module, $title, $body);
