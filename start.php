<?php

spl_autoload_register("pleio_login_autoloader");
function pleio_login_autoloader($class) {
    $filename = "classes/" . str_replace("\\", "/", $class) . ".php";
    if (file_exists(dirname(__FILE__) . "/" . $filename)) {
        include($filename);
    }
}

elgg_register_event_handler("init", "system", "pleio_init");

function pleio_init() {
    elgg_unregister_page_handler("login");
    elgg_register_page_handler("login", "pleio_login_page_handler");

    elgg_unregister_action("register");
    elgg_unregister_page_handler("register");
    elgg_register_page_handler("register", "pleio_login_register_page_handler");

    elgg_register_plugin_hook_handler("action", "admin/site/update_basic", "pleio_admin_update_basic_handler");
    elgg_register_plugin_hook_handler("entity:icon:url", "user", "pleio_user_icon_url_handler");
}

function pleio_login_page_handler($page) {
    global $CONFIG;

    $site = elgg_get_site_url();
    $code = get_input("code");
    $state = get_input("state");

    if (!$CONFIG->pleio->client || !$CONFIG->pleio->secret || !$CONFIG->pleio->url) {
        register_error(elgg_echo("pleio:not_configured"));
        forward(REFERER);
    }

    $provider = new Pleio\Provider([
        "clientId" => $CONFIG->pleio->client,
        "clientSecret" => $CONFIG->pleio->secret,
        "url" => $CONFIG->pleio->url,
        "redirectUri" => "{$site}login"
    ]);

    if (!isset($code)) {
        $authorizationUrl = $provider->getAuthorizationUrl();
        $_SESSION["oauth2state"] = $provider->getState();
        header("Location: " . $authorizationUrl);
        exit;
    } elseif (empty($state) || $state !== $_SESSION["oauth2state"]) {
        // mitigate CSRF attack
        unset($_SESSION["oauth2state"]);
        exit("Invalid state");
    } else {
        try {
            $accessToken = $provider->getAccessToken("authorization_code", [
                "code" => $code
            ]);

            unset($_SESSION["oauth2state"]);

            // we could save these attributes for later use, not saving now...
            /*
            $accessToken->getToken();
            $accessToken->getRefreshToken();
            $accessToken->getExpires();
            */

            $resourceOwner = $provider->getResourceOwner($accessToken);

            $loginHandler = new Pleio\LoginHandler($resourceOwner);
            if ($loginHandler->handleLogin()) {
                system_message(elgg_echo("loginok"));
            } else {
                register_error(elgg_echo("login:baduser"));
            }

            forward(REFERER);
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            exit($e->getMessage());
        }
    }
}

function pleio_login_register_page_handler($page) {
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

function pleio_user_icon_url_handler($hook, $type, $value, $params) {
    $entity = $params["entity"];
    $size = $params["size"];

    if (!$entity) {
        return $value;
    }

    if ($entity->iconUrl) {
        $value = $entity->iconUrl;

        if ($size) {
            $value .= "&size={$size}";
        }
    }

    return $value;
}