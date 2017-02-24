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