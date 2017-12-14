<?php
set_time_limit(0);

if (PHP_SAPI !== "cli") {
    throw new Exception("Only accessable from the CLI");
}

$input = json_decode(base64_decode($argv[1]), true);
if (!$input) {
    throw new Exception("Invalid input");
}

$_SERVER["HTTP_HOST"] = $input["http_host"];
$_SERVER["HTTPS"] = $input["https"];

foreach ($input["env"] as $key => $value) {
    putenv("${key}=$value");
}

require_once(dirname(__FILE__) . "/../../../engine/start.php");

$site = elgg_get_site_entity();

$initiator = get_entity($input["initiator_guid"]);
if (!$initiator) {
    throw new Exception("Could not find initiator user");
}

function import_exceptionhandler($exception) {
    import_send_error($exception->getMessage());
}

function import_check_for_fatal() {
    $error = error_get_last();
    if ($error["type"] !== E_ERROR) {
        return;
    }

    import_send_error($error["message"]);
}

function import_send_error($message) {
    global $CONFIG, $site, $initiator;

    $from = $site->email ?: "noreply@" . get_site_domain($CONFIG->site_guid);
    elgg_send_email(
        $from,
        $initiator->email,
        elgg_echo("pleio:users_import:email:failed:subject"),
        elgg_echo("pleio:users_import:email:failed:body", [
            $initiator->name,
            $message
        ])
    );

}

set_exception_handler("import_exceptionhandler");
register_shutdown_function("import_check_for_fatal");

$ia = elgg_set_ignore_access(true);
$stats = ModPleio\Import::run($input["csv_location"], $input["columns"], $initiator);
elgg_set_ignore_access($ia);

$from = $site->email ?: "noreply@" . get_site_domain($CONFIG->site_guid);
elgg_send_email(
    $from,
    $initiator->email,
    elgg_echo("pleio:users_import:email:success:subject"),
    elgg_echo("pleio:users_import:email:success:body", [
        $initiator->name,
        $stats["created"],
        $stats["updated"],
        $stats["error"]
    ])
);
