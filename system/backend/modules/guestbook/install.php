<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 guestbook			- основная таблица модуля
 guestbook_name2		- дочерняя таблица
 guestbook_name3		- дочерняя таблица
 ...
 guestbook_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Отзывы';

$base_schema = array("
CREATE TABLE IF NOT EXISTS guestbook(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
 name TEXT,
 email TEXT,
 text TEXT,
 date VARCHAR(20),
 publish INT(1)
);
");

//$delete_table = 'DROP TABLE IF EXISTS guestbook;';

?>