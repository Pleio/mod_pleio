<?php
$result = get_data("show tables where 'pleio_request_access'");
if (count($result) === 0) {
    run_sql_script(dirname(__FILE__) . "/sql/pleio_request_access.sql");
}