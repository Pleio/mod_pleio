<?php
global $CONFIG;

if (elgg_is_logged_in()) {
    forward("/");
}

$site = elgg_get_site_url();

$code = get_input("code");
$state = get_input("state");

$login_credentials = get_input("login_credentials");
$idp = elgg_get_plugin_setting("idp", "pleio");

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

    $header = "Location: " . $authorizationUrl;
    
    if ($idp && $login_credentials !== "true") {
        $header .= "&idp={$idp}";
    }

    header($header);
    exit;
} elseif (empty($state) || $state !== $_SESSION["oauth2state"]) {
    // mitigate CSRF attack
    unset($_SESSION["oauth2state"]);
    forward("/");
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

        try {
            $loginHandler->handleLogin();
            system_message(elgg_echo("loginok"));
            forward("/");
        } catch (Pleio\Exceptions\ShouldRegisterException $e) {
            $_SESSION["pleio_resource_owner"] = $resourceOwner->toArray();
            $body = elgg_view_layout("walled_garden", [
                "content" => elgg_view("pleio/request_access", [
                    "resourceOwner" => $resourceOwner->toArray()
                ]),
                "class" => "elgg-walledgarden-double",
                "id" => "elgg-walledgarden-login"
            ]);
            echo elgg_view_page(elgg_echo("pleio:request_access"), $body, "walled_garden");
            return true;
        } catch (\RegistrationException $e) {
            register_error($e->getMessage());
            forward("/");
        }
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        exit($e->getMessage());
    }
}