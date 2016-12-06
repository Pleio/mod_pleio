<?php
/**
 * Elgg drop-down login form
 */

if (elgg_is_logged_in()) {
    return true;
}
?>

<div id="login-dropdown">
    <?php echo elgg_view("output/url", array(
        "href" => "/login",
        "class" => "elgg-button elgg-button-dropdown",
        "text" => elgg_echo("login")
    )); ?>
</div>