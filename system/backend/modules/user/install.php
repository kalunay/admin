<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 users			- основная таблица модуля
 users_name2		- дочерняя таблица
 users_name3		- дочерняя таблица
 ...
 users_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Пользователи';

$base_schema = array("
CREATE TABLE IF NOT EXISTS user(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 name TEXT,
 address TEXT,
 email TEXT,
 phone TEXT,
 date TEXT,
 description TEXT,
 group_usr INT(11),
 active INT(1),
 login TEXT,
 password TEXT,
 passwordmd5 TEXT,
 keygen TEXT,
 image TEXT,
 mailer INT(1)
);
","
CREATE TABLE IF NOT EXISTS user_groups(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 name TEXT
);
","
CREATE TABLE IF NOT EXISTS user_dopfields(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 field TEXT,
 type TEXT,
 pos INT(11),
 publish INT(1)
);
","
CREATE TABLE IF NOT EXISTS user_dopvalues(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 object_id INT(11),
 field_id INT(11),
 value TEXT
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('user', 'image', 1),
('user', 'mailer', 1)
;
","INSERT INTO user_groups (name) VALUES 
('Пользователи сайта'),('VIP пользователи сайта')
;");

//$delete_table = 'DROP TABLE IF EXISTS catalog;';

?>