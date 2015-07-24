-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 24 2015 г., 17:02
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `books`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`) VALUES
(1, 'Дик', 'Френсис'),
(2, 'Джордж', 'Оруэлл'),
(3, 'Дарья', 'Донцова');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL,
  `preview` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_book_to_author_idx` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `name`, `date_create`, `date_update`, `preview`, `date`, `author_id`) VALUES
(34, '1984', '2015-07-23 10:34:32', '2015-07-24 10:40:02', '/previews/23123.png', '1982-09-15', 2),
(36, 'Seastar', '2015-07-23 11:45:41', '2015-07-24 10:40:21', NULL, '1999-09-18', 1),
(37, 'Некая книга', '2015-07-23 12:21:54', '2015-07-23 12:47:55', '/previews/1.jpg', '1987-01-08', 3),
(38, 'Резюме', '2015-07-23 14:11:47', '2015-07-24 10:36:38', '/previews/avatar.jpg', '1986-04-27', 2),
(39, 'Некая книга 2', '2015-07-24 04:06:22', '2015-07-24 09:31:50', NULL, '2008-05-16', 3),
(42, 'test22', '2015-07-24 05:16:40', '2015-07-24 09:11:39', NULL, '2015-07-02', 3),
(43, 'test2', '2015-07-24 05:21:43', '2015-07-24 10:57:48', NULL, '2015-07-15', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'User1', '6b908b785fdba05a6446347dae08d8c5'),
(2, 'User2', 'a09bccf2b2963982b34dc0e08d8b582a');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_to_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
