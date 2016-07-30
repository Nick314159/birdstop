DROP SCHEMA IF EXISTS `bird_stop`;
CREATE SCHEMA `bird_stop`;
USE bird_stop;

CREATE TABLE `beer_style`(
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=UTF8 ROW_FORMAT=COMPACT;

CREATE TABLE `brewery`(
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=UTF8 ROW_FORMAT=COMPACT;

CREATE TABLE `beer` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR (255) NOT NULL,
`brewery_id` INT(11) UNSIGNED NOT NULL,
`origin` VARCHAR(255) NOT NULL,
`beer_style_id` INT(11) UNSIGNED NOT NULL,
`ABV` DOUBLE (3,2) NOT NULL,
`IBU` INT(11),
`price` DOUBLE(5,2),
`on_tap` BOOLEAN,
CONSTRAINT FOREIGN KEY (`beer_style_id`) REFERENCES `beer_style` (`id`),
CONSTRAINT FOREIGN KEY (`brewery_id`) REFERENCES `brewery` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=UTF8 ROW_FORMAT=COMPACT;

CREATE TABLE `event` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`date` DATE NOT NULL,
`name` VARCHAR(255) NOT NULL,
`url` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=UTF8 ROW_FORMAT=COMPACT;

INSERT INTO `bird_stop`.`event` (`date`,`name`,`url`) VALUES ('2016-09-02','"Tahoma" from Austin TeXas','https://www.facebook.com/events/161490864272098/'), ('2016-09-09', 'Those Willows (Portland indie-folk)','https://www.facebook.com/events/1064868926883634/'), ('2016-10-01','Midnight Divide (LA Band)','https://www.facebook.com/events/224117771316289/');

INSERT INTO `bird_stop`.`beer_style` (`name`) VALUES ('Cider'),('Porter'),('Premium Biter/ESB'), ('Radler/Shand'), ('Imperial Stout'), ('American Pale Ale'), ('Pilsner');
INSERT INTO `bird_stop`.`brewery` (`name`) VALUES ('Samual Adams'),('Wasatch Brewery'),('Firestone Walker Brewing'), ('Leinenkugel Brewing Company'), ('Mother Earth Brew Company'), ('Stone\'s'),('Goose Island Beer Company');
INSERT INTO `bird_stop`.`beer` (`name`,`brewery_id`,`origin`,`beer_style_id`,`ABV`,`IBU`,`price`,`on_tap`) VALUES ('Angry Orchard','1','Cincinnati, OH','1','.05','0',4.50,'1'), ('Wasatch Polygamy','2','Park City, UT','2','.04','0',NULL,'1'), ('Firestone Walker Double Barrel Ale','3','Paso Robles, CA','3','.05','0',NULL,'1'), ('Leinenkugels Summer Shandy','4','Chippewa Falls, WI','4','.042','0',NULL,'1'),('Mother Earth Sintax Imperial Stout','5','Vista, CA','5','.081','0',5.50,'1'),('Stone Pale Ale 2.0','6','Greater London','6','.060','0',NULL,'1'), ('Goose Island Four Star Pils','7','Chicago, IL','7','.051','44',NULL,'1');
