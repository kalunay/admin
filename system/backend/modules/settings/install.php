<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 settings			- основная таблица модуля
 settings_name2		- дочерняя таблица
 settings_name3		- дочерняя таблица
 ...
 settings_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Параметры';

$base_schema = array("
CREATE TABLE IF NOT EXISTS settings(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 email TEXT,
 image TEXT
);
","
CREATE TABLE IF NOT EXISTS settings_dopfields(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 field TEXT,
 type TEXT,
 pos INT(11),
 publish INT(1)
);
","
CREATE TABLE IF NOT EXISTS settings_dopvalues(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 object_id INT(11),
 field_id INT(11),
 value TEXT
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('settings', 'image', 1)
;
","INSERT INTO settings (email, image) VALUES 
('test@test.com', '')
;");

//$delete_table = 'DROP TABLE IF EXISTS catalog;';

?>