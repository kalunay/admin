<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 basket			- основная таблица модуля
 basket_name2		- дочерняя таблица
 basket_name3		- дочерняя таблица
 ...
 basket_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Корзина';

$base_schema = array("
CREATE TABLE IF NOT EXISTS basket(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 object_id INT(11),
 user_id INT(11),
 email TEXT,
 datetime TEXT,
 name TEXT,
 phone TEXT,
 description TEXT,
 modify TEXT,
 active INT(1),
 keygen TEXT,
 status INT(1)
);
","
CREATE TABLE IF NOT EXISTS basket_vals(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 name TEXT,
 name_k TEXT,
 value REAL,
 now INT(1)
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('basket', 'phone', 1),
('basket', 'name', 1)
;");

//$delete_table = 'DROP TABLE IF EXISTS news;';

?>