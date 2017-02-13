<?php
$module = elgg_extract('module', $vars, 'aside');
$title = elgg_extract('title', $vars, elgg_echo('login'));

echo elgg_view_module($module, $title, elgg_view_form("login"));
