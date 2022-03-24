-- Создание структуры таблицы `products` 
CREATE TABLE IF NOT EXISTS `products` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(32) NOT NULL,
    `description` text NOT NULL,
    `price` int(11) NOT NULL,
    `category_id` int(11) NOT NULL,
    `created` datetime NOT NULL,
    `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- Вставка данных для таблицы `products` 
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created`, `modified`) VALUES
(1, 'LG P880 4X HD', 'Мой первый классный телефон!', 336, 3, '2020-03-05 01:12:26', '2021-01-11 17:12:26'),
(2, 'Google Nexus 4', 'Самый крутой телефон 2013 года!', 299, 2, '2020-02-09 01:12:26', '2014-03-31 17:12:26'),
(3, 'Samsung Galaxy S4', 'Самые крутые умные часы!', 600, 3, '2014-06-01 01:12:26', '2014-06-31 17:12:26'),
(6, 'Bench Shirt', 'Лучшая рубашка!', 29, 1, '2018-06-02 01:12:26', '2020-03-21 02:12:21'),
(7, 'Lenovo Laptop', 'Мой бизнес партнер.', 399, 2, '2020-01-07 01:13:45', '2021-01-21 02:13:39'),
(8, 'Samsung Galaxy Tab 10.1', 'Хороший планшет.', 259, 2, '2018-06-01 01:14:13', '2019-05-31 02:14:08'),
(9, 'Spalding Watch', 'Мои спортивные часы.', 199, 1, '2019-05-03 01:18:36', '2020-05-31 02:18:31'),
(10, 'Sony Smart Watch', 'Как насчет нет?', 300, 2, '2020-06-06 17:10:01', '2021-01-05 18:09:51'),
(11, 'Huawei Y300', 'Для тестирования.', 100, 2, '2014-06-06 17:11:04', '2015-06-05 18:10:54'),
(12, 'Abercrombie Lake Arnold Shirt', 'Идеально как подарок!', 60, 1, '2017-06-06 17:12:21', '2018-06-05 18:12:11'),
(13, 'Abercrombie Allen Brook Shirt', 'Классная красная рубашка!', 70, 1, '2019-06-06 17:12:59', '2020-06-05 18:12:49'),
(25, 'Abercrombie Allen Anew Shirt', 'Классная новая рубашка!', 999, 1, '2020-11-22 18:42:13', '2021-01-21 19:42:13'),
(26, 'Another product', 'Потрясающий товар!', 555, 2, '2019-11-22 19:07:34', '2021-01-19 20:07:34'),
(27, 'Bag', 'Отличная сумка для тебя!', 999, 1, '2019-12-04 21:11:36', '2020-02-13 22:11:36'),
(30, 'Wal-mart Shirt', '', 555, 2, '2018-12-13 00:52:29', '2019-12-12 01:52:29'),
(32, 'Washing Machine Model PTRR', 'Какой-то новый продукт.', 999, 1, '2020-01-08 22:44:15', '2021-01-09 23:44:15');


-- Структура для таблицы `categories` 
CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(256) NOT NULL,
    `created` datetime NOT NULL,
    `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;


-- Данные для таблицы `categories` 
INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Мода', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(2, 'Электроника', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(3, 'Автомобили', '2014-06-01 00:35:07', '2014-05-30 17:34:54');