<?php
/**
 * Bans a user.
 *
 * User entities are banned by setting the 'banned' column
 * to 'yes' in the users_entity table.
 *
 * @package Elgg.Core
 * @subpackage Administration.User
 */

$guid = get_input('guid');
$user = get_entity($guid);
$site = elgg_get_site_entity();

if ($guid == elgg_get_logged_in_user_guid()) {
	register_error(elgg_echo('admin:user:self:ban:no'));
	forward(REFERER);
}

if (($user instanceof ElggUser) && ($user->canEdit())) {
	if ($user->ban('banned')) {
        remove_entity_relationship($user->guid, "member_of_site", $site->guid);
		system_message(elgg_echo('admin:user:ban:yes'));
	} else {
		register_error(elgg_echo('admin:user:ban:no'));
	}
} else {
	register_error(elgg_echo('admin:user:ban:no'));
}

forward(REFERER);