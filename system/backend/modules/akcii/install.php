<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 akcii			- основная таблица модуля
 akcii_name2		- дочерняя таблица
 akcii_name3		- дочерняя таблица
 ...
 akcii_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Акции';

$base_schema = array("
CREATE TABLE IF NOT EXISTS akcii(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 name TEXT,
 title TEXT,
 keywords TEXT,
 description TEXT,
 text TEXT,
 alias TEXT,
 date VARCHAR(20),
 modify VARCHAR(20),
 image TEXT,
 publish INT(1),
 pos INT(11)
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('akcii', 'alias', 1),
('akcii', 'image', 1)
;");

//$delete_table = 'DROP TABLE IF EXISTS akcii;';

?>