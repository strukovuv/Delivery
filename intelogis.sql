-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 29 2023 г., 17:29
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `intelogis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `delivery`
--

CREATE TABLE `delivery` (
  `id_delivery` int NOT NULL COMMENT 'id  - идентификатор доставки',
  `id_sourceKladr` int DEFAULT NULL COMMENT 'Откуда\r\n\r\nПримечание\r\nНужна табл. Kladr.\r\nВ тестовом примере ее нет',
  `id_targetKladr` int DEFAULT NULL COMMENT 'Куда\r\n\r\nПримечание\r\nНужна табл. Kladr.\r\nВ тестовом примере ее нет',
  `weight` float DEFAULT NULL COMMENT 'Вес груза',
  `price` float DEFAULT NULL COMMENT 'Цена  груза',
  `id_type` int DEFAULT NULL COMMENT 'Тип доставки(0-быстрая , 1 -медленн\r\nая)\r\nПримечание\r\nНужна табл.\r\nTypeDeliovery. \r\nВ тестовом примере ее нет',
  `id_status` int DEFAULT NULL COMMENT 'Статус выполнения операции:\r\n0-ошибка, \r\n1-доставлено, \r\n2- в пути, \r\nи т .п.\r\nПримечание\r\nНужна табл.\r\nStatus. \r\nВ тестовом примере ее нет',
  `updated_at` datetime DEFAULT NULL COMMENT 'Дата время отправки',
  `created_at` datetime DEFAULT NULL COMMENT 'Дата время создания записи',
  `id_user` int DEFAULT NULL COMMENT 'Кто инициировал отправку.\r\nНужна табл.\r\nUsers. \r\nВ тестовом примере ее нет',
  `id_carrier` int DEFAULT NULL COMMENT 'Перевозчик груза\r\n1-почта\r\n2-боксбэерри\r\n3- скэд\r\n\r\nНужна табл.\r\n Carries. \r\nВ тестовом примере ее нет',
  `id_coefficeint` int DEFAULT NULL COMMENT 'Нужна табл.\r\nCoefficents. \r\nВ тестовом примере ее нет',
  `comment` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `delivery`
--

INSERT INTO `delivery` (`id_delivery`, `id_sourceKladr`, `id_targetKladr`, `weight`, `price`, `id_type`, `id_status`, `updated_at`, `created_at`, `id_user`, `id_carrier`, `id_coefficeint`, `comment`) VALUES
(32, 2, 4, 12, 170, 0, 1, '2023-09-29 00:00:00', '2023-09-29 16:50:52', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -1\n'),
(33, 1, 2, 12, 170, 0, 1, '2023-09-29 00:00:00', '2023-09-29 16:51:07', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -1\n'),
(34, 5, 2, 12, 170, 0, 1, '2023-09-29 00:00:00', '2023-09-29 16:52:08', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -1\n'),
(35, 3, 2, 12, 170, 0, 1, '2023-09-29 00:00:00', '2023-09-29 16:52:56', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -1\n'),
(36, 2, 4, 34, 170, 0, 1, NULL, '2023-09-29 16:56:01', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -19630\n'),
(37, 3, 4, 525, 170, 0, 1, '2023-09-15 00:00:00', '2023-09-29 16:56:35', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -15\n'),
(38, 3, 4, 525, 170, 0, 1, '2023-09-15 00:00:00', '2023-09-29 16:59:12', 212, 0, NULL, 'Стоимость доставки: 170\nПериод доставки, дней: -15\n'),
(39, 0, 3, 42, 150, 1, 1, '2023-09-29 00:00:00', '2023-09-29 17:12:24', 1, 3, NULL, 'Стоимость доставки: 150\nДата доставки: 2023-09-29\n');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id_delivery`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id_delivery` int NOT NULL AUTO_INCREMENT COMMENT 'id  - идентификатор доставки', AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
