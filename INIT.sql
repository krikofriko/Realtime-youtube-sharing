CREATE DATABASE `yt_video` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

CREATE TABLE `yt_video`.`video` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`embed` TEXT CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`ip` VARCHAR( 39 ) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL ,
`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
) ENGINE = MYISAM ;