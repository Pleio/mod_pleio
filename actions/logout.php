<?php
$result = logout();

if ($result) {
    forward($CONFIG->pleio->url . "action/logout");
} else {
    register_error(elgg_echo('logouterror'));
}