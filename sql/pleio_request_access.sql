CREATE TABLE IF NOT EXISTS pleio_request_access (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
    `guid` BIGINT(20) unsigned NOT NULL UNIQUE,
    `user` TEXT,
    `time_created` INT(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

ALTER TABLE elgg_users_entity ADD `pleio_guid` BIGINT(20);