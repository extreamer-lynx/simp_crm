-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 11 2020 р., 20:18
-- Версія сервера: 10.3.22-MariaDB
-- Версія PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `guitar_shop`
--

-- --------------------------------------------------------

--
-- Структура таблиці `category`
--

CREATE TABLE `category` (
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ua_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`name`, `ua_name`) VALUES
('details', 'Деталі'),
('guitars', 'Гітари');

-- --------------------------------------------------------

--
-- Структура таблиці `contacts`
--

CREATE TABLE `contacts` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `contacts`
--

INSERT INTO `contacts` (`user_id`, `name`, `sname`, `telephone`, `avatar`) VALUES
(1, 'dkfl', 'Франчук', '380965463938', '1.png'),
(2, 'Ярослав', 'Кондратюк', '380947834759', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `helpinfo`
--

CREATE TABLE `helpinfo` (
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Назва допомоги',
  `content` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Контент',
  `coordinates` varchar(900) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Кординати(Для карти)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Інформація по допомозі';

--
-- Дамп даних таблиці `helpinfo`
--

INSERT INTO `helpinfo` (`name`, `content`, `coordinates`) VALUES
('help', 'Вам допоможуть такі гітарні майстри як:<br>\r\nШевчук Олександр...', NULL),
('aboutus', 'Дякуємо Вам, що з безлічі музичних інтернет-магазинів Ви зупинили Ваш вибір на GuitarShop.ua!\r\n\r\nІнтернет-магазин GuitarShop.ua в Києві, Житомирі, Чернігові - роздрібний напрямок компанії “AT-MT Trade”.\r\n\r\nКомпанія працює на ринку України більше 20 років, і сьогодні офіційно (!) представляє на ринку України такі відомі бренди, як Fender, Gibson, Ibanez, Marshall, VOX, Korg, TAMA, Mackie, JBL Professional і багато інших.\r\n\r\nПрацюючи з нами, Ви отримуєте 100% впевненість в автентичності придбаних продуктів і в тому, що Вам буде забезпечено повне гарантійне обслуговування, передбачене виробником.\r\n\r\nЗвертайтесь до наших консультантів - вони обов’язково знайдуть для Вас рішення.', NULL),
('findus', 'Ви можете знайти нас в таких містах як... Житомир напевне', '50.244725,28.637313');

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int(4) NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `name`, `cost`, `description`, `category`, `count`, `image`) VALUES
(1, 'FENDER FA-125', '3 780 грн', 'Акустична гітара FENDER FA-125 WN NAT w/GIG BAG — це візуально приголомшливий доступний інструмент. Якісна ламінатна конструкція з сучасною головою грифа Fender 3+3 та бриджем Viking створює інструмент з чудовим звуком, на якому легко грати. Початківці та професіонали оцінять цю гітару, яка має гриф з нато, що надає їй живий тон і плавне відчуття гри.', 'guitars', '3', '1.jpg'),
(2, 'CHARVEL PRO-MOD SAN DIMAS STYLE 2 HH', '26 190 грн', 'CHARVEL PRO-MOD SAN DIMAS STYLE 2 HH HT M ASH MAPLE FINGERBOARD NATURAL ASH - це універсальний сучасний інструмент з широкими можливостями налаштування звучання. За чудовий звук гітари відповідають звукознімачі Seymour Duncan. Це 2 хамбакери з високим вихідним рівнем: Seymour Duncan JB TB4 і \'59. Перемикач - 3-позиційний. Зручність при грі досягається завдяки низькопрофільному корпусу ергономічній формі San Dimas і грифу профілю Speed. Дека інструменту виконана з ясеню. Гриф зроблений з 2 шматків клена, посилений 2 графітовими анкерами. Накладка на гриф - клен, мультирадіусна (12\"- 16\"), з інкрустацією чорними точками. На грифі 22 лади Jumbo. Фіксований бридж Charvel (струни крізь корпус) надійно тримає лад. ', 'guitars', '2', '2.jpg'),
(3, 'DUNLOP 6502 Засіб для догляду ', '408 грн', 'Очищувач накладки грифа має повністю збалансований склад, ідеально підходить для деревини накладок грифів і металу ладів. Він швидко видаляє скупчення бруду з щілин, відновлює тон, надає розбірливість і інтонацію вашій грі.', 'details', '10', '3.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `sells`
--

CREATE TABLE `sells` (
  `id_sell` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  `date` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `sells`
--

INSERT INTO `sells` (`id_sell`, `user_id`, `id_products`, `date`, `status`) VALUES
(1, 1, 2, '06.11.20', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cookie` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `salt`, `cookie`, `role`) VALUES
(1, 'franchuk02@gmail.com', '8d07677ebd1cfdaf26131cc7093b5b95', 'r\'57G)r\'', '^{%j}Ac6\"j1591814119', 'admin'),
(2, 'kondrat02@gmail.com', '6c93ba4e2b65e8e469deab2c7fd89718', '{6KIN$eT', 'g43B[)7C>T1591614230', 'member');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`name`);

--
-- Індекси таблиці `contacts`
--
ALTER TABLE `contacts`
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Індекси таблиці `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id_sell`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sells_ibfk_2` (`id_products`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sells_ibfk_2` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
