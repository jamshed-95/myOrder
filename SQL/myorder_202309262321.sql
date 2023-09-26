--
-- Скрипт сгенерирован Devart dbForge Studio 2020 for MySQL, Версия 9.0.470.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 26.09.2023 23:21:25
-- Версия сервера: 10.5.8
-- Версия клиента: 4.1
--

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

--
-- Установка базы данных по умолчанию
--
USE myorder;

--
-- Удалить таблицу `carts`
--
DROP TABLE IF EXISTS carts;

--
-- Удалить таблицу `orders`
--
DROP TABLE IF EXISTS orders;

--
-- Удалить таблицу `products`
--
DROP TABLE IF EXISTS products;

--
-- Установка базы данных по умолчанию
--
USE myorder;

--
-- Создать таблицу `products`
--
CREATE TABLE products (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(200) DEFAULT NULL,
  price decimal(19, 2) DEFAULT NULL,
  photo varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать таблицу `orders`
--
CREATE TABLE orders (
  id int(11) NOT NULL AUTO_INCREMENT,
  cart_id int(11) DEFAULT NULL,
  order_date timestamp NULL DEFAULT CURRENT_TIMESTAMP(),
  comment text DEFAULT NULL,
  user_id int(11) DEFAULT NULL,
  status int(11) DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AVG_ROW_LENGTH = 16384,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `IDX_orders` для объекта типа таблица `orders`
--
ALTER TABLE orders
ADD INDEX IDX_orders (cart_id);

--
-- Создать индекс `IDX_orders_product_id` для объекта типа таблица `orders`
--
ALTER TABLE orders
ADD INDEX IDX_orders_product_id (cart_id);

--
-- Создать таблицу `carts`
--
CREATE TABLE carts (
  id int(11) NOT NULL AUTO_INCREMENT,
  product_id int(11) DEFAULT NULL,
  count int(11) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  user_id int(11) DEFAULT NULL,
  status int(11) DEFAULT 0,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AVG_ROW_LENGTH = 16384,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `IDX_carts` для объекта типа таблица `carts`
--
ALTER TABLE carts
ADD INDEX IDX_carts (product_id, count);

--
-- Создать индекс `IDX_carts_product_id` для объекта типа таблица `carts`
--
ALTER TABLE carts
ADD INDEX IDX_carts_product_id (product_id);

-- 
-- Вывод данных для таблицы products
--
INSERT INTO products VALUES
(1, 'product 1', 4.00, '/'),
(2, 'product 2', 5.00, '/');

-- 
-- Вывод данных для таблицы orders
--
-- Таблица myorder.orders не содержит данных

-- 
-- Вывод данных для таблицы carts
--
-- Таблица myorder.carts не содержит данных

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
--
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;