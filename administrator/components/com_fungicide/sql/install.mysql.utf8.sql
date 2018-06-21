CREATE TABLE IF NOT EXISTS `#__fungicide` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`cid` VARCHAR(255)  NOT NULL ,
`dateofspray` DATE NOT NULL ,
`ratiodescribe` TEXT NOT NULL ,
`spraydayaftercutting` INT NOT NULL ,
`diffrencedate` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

