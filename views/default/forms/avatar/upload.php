<?php
$link = elgg_view("output/url", [
    "href" => $CONFIG->pleio->url . "profile",
    "text" => "Pleio",
    "target" => "_blank"
]);

echo elgg_echo("pleio:change_settings:description", [$link]);