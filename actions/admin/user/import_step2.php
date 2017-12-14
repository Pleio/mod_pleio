<?php
$loggedin_user = elgg_get_logged_in_user_entity();
$columns = get_input("columns");

if (empty($columns)) {
    register_error(elgg_echo("subsite_manager:action:import:step2:error:columns"));
    forward(REFERER);
}

if (!in_array("guid", $columns) && !in_array("username", $columns) && !in_array("email", $columns)) {
    register_error(elgg_echo("subsite_manager:action:import:step2:error:required_fields"));
    forward(REFERER);
}

$csv_location = $_SESSION["import"]["location"];
$fh = fopen($csv_location, "r");
if (!$fh) {
    register_error(elgg_echo("subsite_manager:action:import:step2:error:csv_file"));
    forward("/admin/users/import");
}
fclose($fh);

$input = base64_encode(json_encode([
    "http_host" => $_SERVER["HTTP_HOST"],
    "https" => $_SERVER["HTTPS"],
    "env" => [
        "DB_USER" => getenv("DB_USER"),
        "DB_PASS" => getenv("DB_PASS"),
        "DB_NAME" => getenv("DB_NAME"),
        "DB_HOST" => getenv("DB_HOST"),
        "DB_PREFIX" => getenv("DB_PREFIX"),
        "DATAROOT" => getenv("DATAROOT"),
        "PLEIO_ENV" => getenv("PLEIO_ENV"),
        "SMTP_DOMAIN" => getenv("SMTP_DOMAIN"),
        "BLOCK_EMAIL" => getenv("BLOCK_EMAIL"),
        "MEMCACHE_ENABLED" => getenv("MEMCACHE_ENABLED"),
        "MEMCACHE_PREFIX" => getenv("MEMCACHE_PREFIX"),
        "MEMCACHE_SERVER_1" => getenv("MEMCACHE_SERVER_1"),
        "ELASTIC_INDEX" => getenv("ELASTIC_INDEX"),
        "ELASTIC_SERVER_1" => getenv("ELASTIC_SERVER_1")
    ],
    "initiator_guid" => $loggedin_user->guid,
    "csv_location" => $csv_location,
    "columns" => $columns
]));

$script_location = dirname(__FILE__) . "/../../../procedures/import_users.php";

if (PHP_OS === "WINNT") {
    pclose(popen("start /B php {$script_location} {$input}", "r"));
} else {
    exec("php {$script_location} {$input} > /tmp/pleio-import.log &");
}

unset($_SESSION["subsite_manager_import"]);

system_message(elgg_echo("pleio:users_import:started_in_background"));
forward("/admin/users/import");