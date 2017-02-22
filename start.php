<?php
require_once(dirname(__FILE__) . "/../../vendor/autoload.php");
spl_autoload_register("pleio_autoloader");
function pleio_autoloader($class) {
    $filename = "classes/" . str_replace("\\", "/", $class) . ".php";
    if (file_exists(dirname(__FILE__) . "/" . $filename)) {
        include($filename);
    }
}

use Pleio\Exceptions\ShouldRegisterException as ShouldRegisterException;

elgg_register_event_handler("init", "system", "pleio_init");

function pleio_init() {
    elgg_unregister_page_handler("login");
    elgg_register_page_handler("login", "pleio_page_handler");

    elgg_unregister_action("register");
    elgg_unregister_page_handler("register");

    elgg_unregister_action("logout");
    elgg_register_action("logout", dirname(__FILE__) . "/actions/logout.php", "public");

    elgg_unregister_action("avatar/crop");
    elgg_unregister_action("avatar/remove");
    elgg_unregister_action("avatar/upload");
    elgg_unregister_action("user/passwordreset");
    elgg_unregister_action("user/requestnewpassword");
    elgg_unregister_plugin_hook_handler("usersettings:save", "user", "users_settings_save");

    elgg_unregister_action("admin/site/update_advanced");
    elgg_register_action("admin/site/update_advanced", dirname(__FILE__) . "/actions/admin/site/update_advanced.php", "admin");

    elgg_register_page_handler("register", "pleio_register_page_handler");
    elgg_register_page_handler("access_requested", "pleio_access_requested_page_handler");

    elgg_register_action("pleio/request_access", dirname(__FILE__) . "/actions/request_access.php", "public");
    elgg_register_action("admin/pleio/process_access", dirname(__FILE__) . "/actions/admin/process_access.php", "admin");

    elgg_register_plugin_hook_handler("public_pages", "walled_garden", "pleio_public_pages_handler");
    elgg_register_plugin_hook_handler("action", "admin/site/update_basic", "pleio_admin_update_basic_handler");
    elgg_register_plugin_hook_handler("entity:icon:url", "user", "pleio_user_icon_url_handler");

    elgg_register_admin_menu_item("administer", "access_requests", "users");

    elgg_extend_view("css/elgg", "pleio/css/site");
    elgg_extend_view("page/elements/head", "page/elements/topbar/fix");
}

function pleio_page_handler($page) {
    include(dirname(__FILE__) . "/pages/login.php");
}

function pleio_access_requested_page_handler($page) {
    $body = elgg_view_layout("walled_garden", [
        "content" => elgg_view("pleio/access_requested"),
        "class" => "elgg-walledgarden-double",
        "id" => "elgg-walledgarden-login"
    ]);

    echo elgg_view_page(elgg_echo("pleio:access_requested"), $body, "walled_garden");
    return true;
}

function pleio_register_page_handler($page) {
    register_error(elgg_echo("pleio:registration_disabled"));
    forward("/");
    return true;
}

function pleio_admin_update_basic_handler($hook, $type, $value, $params) {
    $site = elgg_get_site_entity();

    $site_permission = get_input("site_permission");
    if ($site_permission) {
        set_config("site_permission", $site_permission, $site->guid);
    }
}

function pleio_public_pages_handler($hook, $type, $value, $params) {
    $value[] = "action/pleio/request_access";
    $value[] = "access_requested";
    return $value;
}

function pleio_user_icon_url_handler($hook, $type, $value, $params) {
    global $CONFIG;

    $entity = $params["entity"];
    $size = $params["size"];

    if (!$entity) {
        return $value;
    }

    if (!in_array($size, ["large", "medium", "small", "tiny", "master", "topbar"])) {
        $size = "medium";
    }

    $dbprefix = elgg_get_config("dbprefix");
    $guid = (int) $entity->guid;

    $result = get_data_row("SELECT pleio_guid FROM {$dbprefix}users_entity WHERE guid = $guid");
    if ($result) {
        $pleio_guid = $result->pleio_guid;
    } else {
        $pleio_guid = 0;
    }

    $url = $CONFIG->pleio->url . "mod/profile/icondirect.php?guid={$pleio_guid}&size={$size}";

    if ($entity->last_login) {
        $url .= "&lastcache={$entity->last_login}";
    }

    return $url;
}

function pleio_users_settings_save() {
    elgg_set_user_default_access();
}

function get_user_by_pleio_guid($guid) {
    $guid = (int) $guid;
    if (!$guid) {
        return false;
    }

    $dbprefix = elgg_get_config("dbprefix");
    $result = get_data_row("SELECT guid FROM {$dbprefix}users_entity WHERE pleio_guid = {$guid}");
    if ($result) {
        return get_entity($result->guid);
    }

    return false;
}