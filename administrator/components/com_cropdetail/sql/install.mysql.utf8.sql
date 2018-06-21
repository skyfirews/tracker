CREATE TABLE IF NOT EXISTS `#__cropdetail` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`cuttingdate` DATE NOT NULL ,
`description` TEXT NOT NULL ,
`totalspent` DOUBLE,
`totalgain` BIGINT NOT NULL ,
`remark` VARCHAR(255)  NOT NULL ,
`weightage` DOUBLE,
`session` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

