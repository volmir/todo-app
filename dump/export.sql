
CREATE TABLE `todo` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255) NOT NULL DEFAULT '',
	`email` VARCHAR(255) NOT NULL DEFAULT '',
	`description` TEXT NOT NULL,
	`status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`edit_admin` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci';

