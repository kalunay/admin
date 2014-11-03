<?
/*
Если необходимо использовать в модуле более одной таблицы,
то имя дочерних таблиц должно состоять из двух частей и разделяться знаком "нижнее подчёркивание" ("_"), например:

 gallery			- основная таблица модуля
 gallery_name2		- дочерняя таблица
 gallery_name3		- дочерняя таблица
 ...
 gallery_nameN		- дочерняя таблица
 
 name2, name3, ... nameN - может содержать любое информативное название
 
*/


$mod_name = 'Галерея';

$base_schema = array("
CREATE TABLE IF NOT EXISTS gallery(
  gallery_cat_id INT(11) NOT NULL AUTO_INCREMENT,
  parent_id INT(11),
  title VARCHAR(120),
  body TEXT,
  alias VARCHAR(50),
  title_window TEXT,
  modify datetime,
  pos INT(11),
  enable enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY(gallery_cat_id)
);
","
CREATE TABLE IF NOT EXISTS gallery_photo(
  photo_id INT(11) NOT NULL AUTO_INCREMENT,
  name TEXT,
  img_alt TEXT,
  img_title TEXT,
  image VARCHAR(250),
  ext VARCHAR(4),
  width TEXT,
  height TEXT,
  pos INT(11),
  modify datetime,
  gallery_cat_id INT(11),
  enable enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY(photo_id)
);
","INSERT INTO modules_table_fields (module_name, field_name, active) VALUES 
('gallery', 'body', 1),
('gallery', 'alias', 1),
('gallery', 'title_window', 1)
;");

//$delete_table = 'DROP TABLE IF EXISTS gallery;';

?>