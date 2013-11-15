-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 15 2013 г., 18:34
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `details_make`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDetails`(IN `date` DATE)
    MODIFIES SQL DATA
    COMMENT 'update details'
BEGIN
declare detailNumber integer;
declare detailType integer;
declare done integer default 0;
declare C1 cursor for SELECT part.number, part.det_code 
                      FROM part
		      WHERE data = date;
declare CONTINUE handler for sqlstate '02000' set done=1;

    open C1;
	repeat
	    fetch C1 into detailNumber, detailType;
            if done = 0 then
	        UPDATE detail
                SET namber = namber + detailNumber, data = date
                WHERE id_detail = detailType;
	    end if;
	until done = 1
	end repeat;
    close C1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `billet`
--

CREATE TABLE IF NOT EXISTS `billet` (
  `id_billet` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weight` int(10) unsigned NOT NULL,
  `material` varchar(45) NOT NULL,
  PRIMARY KEY (`id_billet`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `billet`
--

INSERT INTO `billet` (`id_billet`, `weight`, `material`) VALUES
(1, 1, 'radiy'),
(2, 3, 'uran'),
(3, 32, 'aluminium'),
(4, 2, 'chrom'),
(5, 21, 'steel'),
(6, 2, 'iron'),
(7, 58, 'tin'),
(8, 12, 'copper'),
(9, 2, 'gold'),
(10, 234, 'silver');

-- --------------------------------------------------------

--
-- Структура таблицы `detail`
--

CREATE TABLE IF NOT EXISTS `detail` (
  `id_detail` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `namber` int(10) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL,
  `cost` int(10) unsigned NOT NULL,
  `material` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `detail`
--

INSERT INTO `detail` (`id_detail`, `data`, `namber`, `weight`, `cost`, `material`, `name`) VALUES
(1, '2013-11-15', 1200, 1, 100, 'uran', 'stergen'),
(2, '2012-03-02', 12, 234, 3000, 'radiy', 'unknown'),
(3, '2010-06-24', 123, 3424, 11231, 'gold', 'reducing nipple '),
(4, '2010-04-05', 1222, 123213, 10000, 'aluminium', 'screw'),
(5, '2010-08-23', 10, 35, 5000, 'chrom', 'angle bar'),
(6, '2009-07-01', 1, 100, 99999, 'gold', 'firog'),
(7, '2009-09-04', 10, 10, 3455, 'silver', 'wegom'),
(8, '2012-12-11', 158, 23, 1231, 'aluminium', 'rotis'),
(9, '2008-06-17', 34, 234, 124234, 'iron', 'potis'),
(10, '2008-04-12', 123, 3333, 12999, 'iron', 'coveg');

-- --------------------------------------------------------

--
-- Структура таблицы `manufactory`
--

CREATE TABLE IF NOT EXISTS `manufactory` (
  `id_manufac` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(45) CHARACTER SET latin1 NOT NULL,
  `foundation` date NOT NULL,
  `name` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_manufac`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `manufactory`
--

INSERT INTO `manufactory` (`id_manufac`, `address`, `foundation`, `name`) VALUES
(1, 'Moscow, izmaylovo', '2001-01-19', 'IlyaIlyich'),
(2, 'Krasnodar, ubileyniy', '1999-04-10', 'gorovich'),
(3, 'Murmansk', '1994-04-06', 'radocinium');

-- --------------------------------------------------------

--
-- Структура таблицы `part`
--

CREATE TABLE IF NOT EXISTS `part` (
  `id_part` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `billet_code` int(10) unsigned NOT NULL,
  `det_code` int(10) unsigned NOT NULL,
  `m_id_nanuf` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_part`),
  KEY `FK_part_1` (`billet_code`),
  KEY `FK_part_2` (`det_code`),
  KEY `FK_part_3` (`m_id_nanuf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `part`
--

INSERT INTO `part` (`id_part`, `data`, `number`, `billet_code`, `det_code`, `m_id_nanuf`) VALUES
(1, '2012-03-20', 1, 1, 1, 1),
(2, '2012-03-20', 23, 2, 1, 1),
(3, '2012-04-16', 2, 5, 1, 2),
(4, '2012-07-18', 456, 9, 7, 3),
(5, '2012-05-06', 34, 5, 2, 1),
(6, '2012-07-13', 3444, 7, 4, 2),
(7, '2012-10-08', 234, 3, 9, 2),
(8, '2012-11-20', 11, 6, 4, 1),
(9, '2012-11-28', 42, 9, 9, 3),
(10, '2012-12-11', 123, 2, 8, 2),
(11, '2013-11-15', 1000, 1, 1, 1);

--
-- Триггеры `part`
--
DROP TRIGGER IF EXISTS `updateDet`;
DELIMITER //
CREATE TRIGGER `updateDet` AFTER INSERT ON `part`
 FOR EACH ROW BEGIN
   call updateDetails( new.data );
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id_rep` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `month` varchar(10) CHARACTER SET latin1 NOT NULL,
  `year` int(10) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `code` int(10) unsigned NOT NULL,
  `m_id_manuf` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_rep`) USING BTREE,
  KEY `FK_report_1` (`m_id_manuf`)
) ENGINE=InnoDB  DEFAULT CHARSET=koi8r AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `report`
--

INSERT INTO `report` (`id_rep`, `month`, `year`, `number`, `code`, `m_id_manuf`) VALUES
(1, 'January', 2012, 1, 123, 1),
(2, 'January', 2012, 2313, 21, 2),
(3, 'January', 2012, 23, 1234, 3),
(4, 'February', 2012, 234, 23345, 1),
(5, 'February', 2012, 23, 1233, 2),
(6, 'February', 2012, 11, 4567, 3),
(7, 'March', 2012, 233, 321, 1),
(8, 'March', 2012, 34, 222, 2),
(9, 'March', 2012, 3545, 33, 3),
(11, 'April', 2012, 1321, 1, 1),
(12, 'April', 2012, 321, 54, 2),
(13, 'April', 2012, 526, 54, 3),
(14, 'June', 2012, 134, 9, 1),
(15, 'June', 2012, 100, 124, 2),
(17, 'June', 2012, 999, 1, 3),
(18, 'July', 2012, 1123, 663, 1),
(19, 'July', 2012, 423, 435, 2),
(20, 'July', 2012, 324, 341, 3),
(21, 'August', 2012, 12343, 62, 1),
(22, 'August', 2012, 4765, 11, 2),
(23, 'August', 2012, 1232, 83, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `priority` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='юзеры' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `name`, `passwd`, `priority`) VALUES
(1, 'ivanich', '222', 2),
(2, 'petrov', '333', 3),
(3, 'afanasiy', '111', 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `FK_part_1` FOREIGN KEY (`billet_code`) REFERENCES `billet` (`id_billet`),
  ADD CONSTRAINT `FK_part_2` FOREIGN KEY (`det_code`) REFERENCES `detail` (`id_detail`),
  ADD CONSTRAINT `FK_part_3` FOREIGN KEY (`m_id_nanuf`) REFERENCES `manufactory` (`id_manufac`);

--
-- Ограничения внешнего ключа таблицы `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FK_report_1` FOREIGN KEY (`m_id_manuf`) REFERENCES `manufactory` (`id_manufac`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
