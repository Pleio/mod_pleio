<?php

$module = elgg_extract('module', $vars, 'aside');
$title = elgg_extract('title', $vars, elgg_echo('login'));

$body = elgg_view("output/url", array(
        "href" => "/login",
        "class" => "elgg-button-submit elgg-button",
        "text" => elgg_echo("login")
));

echo elgg_view_module($module, $title, $body);
