CREATE TABLE IF NOT EXISTS `#__cropbalancesheet_balance` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`expencedate` DATE NOT NULL ,
`cid` VARCHAR(255)  NOT NULL ,
`amount` VARCHAR(255)  NOT NULL ,
`expencetype` VARCHAR(255)  NOT NULL ,
`description` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

