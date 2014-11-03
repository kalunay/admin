<?

/*	FOR HTML. This comments not delete!

<?=$page['title']?>				-		Title pages

<?=$page['name']?>				-		Name pages

<?=$page['text']?>				-		Text pages

<?=$page['alias']?>				-		Alias pages

<?=$page['menu_name']?>			-		Menu_name pages

<?=$page['keywords']?>			-		Keywords pages

<?=$page['description']?>		-		Description pages

<?=$page['date']?>				-		Date pages

<?=$page['modify']?>			-		Modify pages

<?=$page['show_menu_top']?>		-		Show_menu_top pages

<?=$page['Show_menu_right']?>	-		Show_menu_right pages

<?=$page['Show_menu_bottom']?>	-		Show_menu_bottom pages

<?=$page['Show_menu_left']?>	-		Show_menu_left pages

<?=$page['parent_id']?>			-		Parent_id pages

<?=$page['id']?>				-		Id pages

<?=$page['publish']?>			-		Publish pages

<?=$page['pos']?>				-		Pos pages


<?=$page['array_menu_top']?>				-		Array menu TOP pages

<?=$page['array_menu_right']?>				-		Array menu RIGHT pages

<?=$page['array_menu_bottom']?>				-		Array menu BOTTOM pages

<?=$page['array_menu_left']?>				-		Array menu LEFT pages



<?=$guestbook?>					-		Block Guestbook with form
-------------------------------------------------------------------------------------

 ... Описание новых элементов для шаблона добавляйте сюда же ... создание переменных только в контроллере. ...

*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<title><?=$page['title']?></title>


<!-- JS CSS -->

</head>

<body>

<!-- VIEW -->

<h1><?=$page['name']?></h1>
                                            

<?=$page['text']?>

<?=$guestbook?>	
                                            
                           
</body>
</html>
