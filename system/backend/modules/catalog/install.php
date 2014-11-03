<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 catalog			- основная таблица модуля
 catalog_name2		- дочерняя таблица
 catalog_name3		- дочерняя таблица
 ...
 catalog_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Каталог';

$base_schema = array("
CREATE TABLE IF NOT EXISTS catalog(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 parent_id INT(11),
 gallery_cat_id INT(11),
 name TEXT,
 menu_name TEXT,
 title TEXT,
 keywords TEXT,
 description TEXT,
 text TEXT,
 alias TEXT,
 modify VARCHAR(20),
 image TEXT,
 publish INT(1),
 pos INT(11)
);
","
CREATE TABLE IF NOT EXISTS catalog_object(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 cat_id INT(11),
 gallery_cat_id INT(11),
 name TEXT,
 menu_name TEXT,
 title TEXT,
 keywords TEXT,
 description TEXT,
 text TEXT,
 smalltext TEXT,
 alias TEXT,
 modify VARCHAR(20),
 image TEXT,
 publish INT(1),
 pos INT(11)
);
","
CREATE TABLE IF NOT EXISTS catalog_dopfields(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 field TEXT,
 type TEXT,
 pos INT(11),
 publish INT(1)
);
","
CREATE TABLE IF NOT EXISTS catalog_dopvalues(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 object_id INT(11),
 field_id INT(11),
 value TEXT
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('catalog', 'gallery_cat_id', 1),
('catalog', 'menu_name', 1),
('catalog', 'image', 1),
('catalog_object', 'gallery_cat_id', 1),
('catalog_object', 'menu_name', 1),
('catalog_object', 'image', 1),
('catalog_object', 'smalltext', 1)
;");

//$delete_table = 'DROP TABLE IF EXISTS catalog;';

?>