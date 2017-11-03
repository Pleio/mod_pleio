<?php
$plugin = $vars["entity"];

echo "<p>";
echo "<label>" . elgg_echo("pleio:settings:idp") . "<br />";
echo elgg_view("input/text", array(
    "name" => "params[idp]",
    "value" => $plugin->idp
));
echo "</label>";
echo "</p>";

echo "<p>";
echo "<label>" . elgg_echo("pleio:settings:idp_name") . "<br />";
echo elgg_view("input/text", array(
    "name" => "params[idp_name]",
    "value" => $plugin->idp_name
));
echo "</label>";
echo "</p>";


echo "<p>";
echo "<label>" . elgg_echo("pleio:settings:login_credentials") . "<br />";
echo elgg_view("input/dropdown", array(
    "name" => "params[login_credentials]",
    "options_values" => [
        "no" => elgg_echo("option:no"),
        "yes" => elgg_echo("option:yes")
    ],
    "value" => $plugin->login_credentials
));
echo "</label>";
echo "</p>";

echo "<p>";
echo "<label>" . elgg_echo("pleio:settings:notifications_for_access_request") . "<br />";
echo elgg_view("input/dropdown", array(
    "name" => "params[notifications_for_access_request]",
    "options_values" => [
        "yes" => elgg_echo("option:yes"),
        "no" => elgg_echo("option:no")
    ],
    "value" => $plugin->notifications_for_access_request
));
echo "</label>";
echo "</p>";

echo "<p>";
echo "<label>" . elgg_echo("pleio:settings:domain_whitelist") . "<br />";
echo elgg_view("input/text", array(
    "name" => "params[domain_whitelist]",
    "value" => $plugin->domain_whitelist
));
echo "</label>";
echo "<span class=\"elgg-subtext\">" . elgg_echo("pleio:settings:domain_whitelist:explanation") . "</span>";
echo "</p>";

echo "<p>";
echo "<label>" . elgg_echo("pleio:settings:walled_garden_description") . "<br />";
echo elgg_view("input/longtext", array(
    "name" => "params[walled_garden_description]",
    "value" => $plugin->walled_garden_description ? $plugin->walled_garden_description : elgg_echo("pleio:walled_garden_description")
));
echo "</label>";
echo "</p>";