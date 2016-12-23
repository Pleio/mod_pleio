<?php
if (!$_SESSION["pleio_resource_owner"]) {
    register_error("pleio:could_not_find_user_info");
    forward(REFERER);
}

$resourceOwner = new Pleio\ResourceOwner($_SESSION["pleio_resource_owner"]);
$loginHandler = new Pleio\LoginHandler($resourceOwner);
$loginHandler->requestAccess();

forward("/access_requested");