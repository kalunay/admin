<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 pages			- основная таблица модуля
 pages_name2		- дочерняя таблица
 pages_name3		- дочерняя таблица
 ...
 pages_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Страницы';

$base_schema = array("
CREATE TABLE IF NOT EXISTS pages(
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
 date VARCHAR(20),
 modify VARCHAR(20),
 show_menu_top INT(1),
 show_menu_right INT(1),
 show_menu_bottom INT(1),
 show_menu_left INT(1),
 publish INT(1),
 pos INT(11)
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('pages', 'gallery_cat_id', 1),
('pages', 'menu_name', 1),
('pages', 'show_menu_right', 1),
('pages', 'show_menu_bottom', 1),
('pages', 'show_menu_left', 1)
;");

//$delete_table = 'DROP TABLE IF EXISTS pages;';

?>