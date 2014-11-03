<?php
//session_destroy();

session_start();

/*
		$_SESSION['install_start']='';
		$_SESSION['install_db']='';
		$_SESSION['install_user']='';
		$_SESSION['install_password']='';*/
		
		

$step_text='';
$modules_select='';


if(isset($_POST['dbok_prev_2'])){

		$_SESSION['install_start']='';
		$_SESSION['install_db']='';
		$_SESSION['install_user']='';
		$_SESSION['install_password']='';
		
		include('install_1.php');
	
}else
if(isset($_POST['dbok_prev_3'])){
		
	$_SESSION['install_start']='step11';
	header('Location: /_admin');
	
}else
if($_SESSION['install_start']=='step11'){

	$link = mysql_connect('localhost', $_SESSION['install_user'], $_SESSION['install_password']);
	mysql_select_db($_SESSION['install_db'], $link);
	mysql_set_charset('utf8',$link); 
	mysql_query("CREATE TABLE IF NOT EXISTS modules(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	 name VARCHAR(30), 
	 title VARCHAR(30), 
	 active INT)", $link); 
	mysql_query("CREATE TABLE IF NOT EXISTS modules_table_fields(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	 module_name VARCHAR(30), 
	 field_name VARCHAR(30), 
	 active INT)", $link); 
	mysql_query("CREATE TABLE IF NOT EXISTS modules_translation(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	 module_name VARCHAR(30), 
	 table_name VARCHAR(30), 
	 record_id INT, 
	 lang VARCHAR(2), 
	 name TEXT, 
	 title TEXT, 
	 keywords TEXT, 
	 description TEXT, 
	 text TEXT, 
	 smalltext TEXT, 
	 menu_name TEXT, 
	 body TEXT, 
	 title_window TEXT, 
	 field TEXT)
	 ", $link);
	 mysql_query("CREATE TABLE IF NOT EXISTS `mailer` (
  `idm` int(11) NOT NULL AUTO_INCREMENT,
  `mail` text NOT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;
	 ", $link);
	 mysql_query("CREATE TABLE IF NOT EXISTS config(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	 name VARCHAR(30), 
	 psw TEXT)", $link); 
	 mysql_query("INSERT INTO config (name, psw) VALUES ('admin', '".md5($_SESSION['install_password_admin'])."')", $link); 
	 mysql_query("INSERT INTO config (name, psw) VALUES ('manager', '".md5($_SESSION['install_password_manager'])."')", $link);
	 
	  
	 if ($handle = opendir($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/')) {
				while (false !== ($file = readdir($handle))) {
					$query = mysql_query("SELECT * FROM modules WHERE name='".$file."';", $link);
					if ($file != ".." && $file != "." && !mysql_num_rows($query) && file_exists($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$file.'/install.php')) {
						include($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$file.'/install.php');
						mysql_query("INSERT INTO modules (name, title, active) VALUES('".$file."', '".$mod_name."', 0);", $link);
					}
				}
		}
	
	$step_text='Выберите необходимые модули для установки.';	

	$query2 = mysql_query("SELECT * FROM modules;", $link);
	if(mysql_num_rows($query2)){	
	$modules_select .= '<table border="0" width="100" align="center">';
		for($i=0; $i<mysql_num_rows($query2);$i++){
		$modules_select .= '<tr><td align="left">
			<input type="checkbox" name="modules_'.mysql_result($query2,$i,1).'" value="'.mysql_result($query2,$i,0).'" '.(mysql_result($query2,$i,2)==1?'checked':'').'> '.mysql_result($query2,$i,1).'
			</td></tr>';
		}
	$modules_select .= '</table>';
	}

	$_SESSION['install_start']='step12';
	include('install_2.php');
	
}else
if(isset($_POST['dbok_next_0'])){

	include('install_1.php');
	
}else
if(isset($_POST['dbok_next_1'])){

	$var_db = $_SERVER['DOCUMENT_ROOT'].'/system/application/config/database.php';
	$var_db2 = $_SERVER['DOCUMENT_ROOT'].'/system/backend/config/database.php';
	
	if(file_exists($var_db) &&
	isset($_POST['database']) && $_POST['database']!='' &&
	isset($_POST['user_db']) && $_POST['user_db']!=''){
	
		$fh = fopen($var_db, "a+") or die("File ($file) does not exist!");
		$file = fread($fh, filesize($var_db));
		fclose($fh);
		$fh = fopen($var_db, "w") or die("File ($file) does not exist!");
		$file = str_replace("['database'] = ","['database'] = \"".(isset($_POST['database'])?$_POST['database']:'')."\"; //", $file);	
		$file = str_replace("['username'] = ","['username'] = \"".(isset($_POST['user_db'])?$_POST['user_db']:'')."\"; //", $file);
		$file = str_replace("['password'] = ","['password'] = \"".(isset($_POST['password_db'])?$_POST['password_db']:'')."\"; //", $file);		
		fwrite($fh, $file);
		fclose($fh);
		
		$fh2 = fopen($var_db2, "a+") or die("File ($file) does not exist!");
		$file2 = fread($fh2, filesize($var_db2));
		fclose($fh2);
		$fh2 = fopen($var_db2, "w") or die("File ($file) does not exist!");
		$file2 = str_replace("['database'] = ","['database'] = \"".(isset($_POST['database'])?$_POST['database']:'')."\"; //", $file2);	
		$file2 = str_replace("['username'] = ","['username'] = \"".(isset($_POST['user_db'])?$_POST['user_db']:'')."\"; //", $file2);
		$file2 = str_replace("['password'] = ","['password'] = \"".(isset($_POST['password_db'])?$_POST['password_db']:'')."\"; //", $file2);		
		fwrite($fh2, $file2);
		fclose($fh2);
		
		$_SESSION['install_start']='step1';
		$_SESSION['install_db']=(isset($_POST['database'])?$_POST['database']:'');
		$_SESSION['install_user']=(isset($_POST['user_db'])?$_POST['user_db']:'');
		$_SESSION['install_password']=(isset($_POST['password_db'])?$_POST['password_db']:'');
		$_SESSION['install_password_admin']=(isset($_POST['password_admin'])?$_POST['password_admin']:'');
		$_SESSION['install_password_manager']=(isset($_POST['password_manager'])?$_POST['password_manager']:'');
		
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/_admin');
		
	}else{
		$error = 'Данные подключения к базе неверные.';
		include('install_1.php');
	}	
	

}else
if(isset($_POST['dbok_next_2']) || (isset($_SESSION['install_start']) && $_SESSION['install_start']=='step12')){

	$link = mysql_connect('localhost', $_SESSION['install_user'], $_SESSION['install_password']);
	mysql_select_db($_SESSION['install_db'], $link);
	mysql_set_charset('utf8',$link);
	$query2 = mysql_query("SELECT * FROM modules;", $link);
	if(mysql_num_rows($query2)){	
		for($i=0; $i<mysql_num_rows($query2);$i++){
			
			$mod = mysql_result($query2,$i,1);
			$install = $_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$mod.'/install.php';
		
			if(isset($_POST['modules_'.$mod]) && file_exists($install)){
				include($install);
				$it=0;
						while(isset($base_schema[$it])){
							mysql_query($base_schema[$it], $link);
							$it++;
						}
				//mysql_query($base_schema, $link); 
				mysql_query("UPDATE modules SET active=1 WHERE id=".$_POST['modules_'.$mod], $link); 
					
			}
		}
	}
	
	$_SESSION['install_start']='0';
	include('install_3.php');
	
}else{

		$_SESSION['install_start']='';
		$_SESSION['install_db']='';
		$_SESSION['install_user']='';
		$_SESSION['install_password']='';
		
		include('install.php');
		
}
?>