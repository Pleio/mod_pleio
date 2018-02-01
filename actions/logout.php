<?php
if (!elgg_is_logged_in()) {
    forward("/");
}

$result = logout();
if ($result) {
    forward($CONFIG->pleio->url . "action/logout");
} else {
    register_error(elgg_echo('logouterror'));
}