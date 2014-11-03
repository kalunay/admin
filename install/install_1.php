<?

function generate_password($number=14)
  {
    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0','.',',',
                 '(',')','[',']','!','?',
                 '&','^','%','@','*','$',
                 '<','>','/','|','+','-',
                 '{','}','`','~');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
  }

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	
	<title>Установщик v 0.1</title>

</head>
<body style="background-color:#EAEAEA;">

<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" style="background-color:#ffffff;">
<tr><td align="center">
		<!-- Logo -->
		<p class="nom t-center"><a href="#"><img src="/install/install.jpg" alt="Our logo" title="Visit Site" /></a></p>
			
		<table border="0" cellpadding="0" cellspacing="0" align="center"><tr>
		<td>
		<div style="width:80px; height:80px; background-image:url('/install/lapa-left.gif'); background-repeat:no-repeat;">
			<h2 style="padding:0px; margin:0px;">1 шаг</h2>
		</div>
		</td>
		</tr>
		</table>
		
		
		<!-- Messages --> <p style="background-color:#E8F6FF; border:1px solid #B8E2FB;">
		Установка параметров системы:
		</p>
		
		<? if(isset($error) && $error!=''){ ?>
		<!-- Messages --> <p style="background-color:#E8F6FF; border:1px solid #B8E2FB; color:#ff0000;">
			<?=$error;?>
		</p>
		<? } ?>

		<!-- Form -->
		<form method="POST" action="/install/install_form_step.php">
		<table width="90%">
			<tr>
				<td align="left"><strong>База данных:</strong></td>
				<td align="right"><input type="text" size="35" name="database" /></td>
			</tr>
			<tr>
				<td align="left"><strong>Пользователь базы:</strong></td>
				<td align="right"><input type="text" size="35" name="user_db" /></td>
			</tr>
			<tr>
				<td align="left"><strong>Пароль к базе:</strong></td>
				<td align="right"><input type="text" size="35" name="password_db" /></td>
			</tr>
			<tr>
				<td align="left"><strong>Пароль админа к CMS:</strong></td>
				<td align="right"><input type="text" size="35" name="password_admin" value="<?=generate_password();?>" /></td>
			</tr>
			<tr>
				<td align="left"><strong>Пароль менеджера к CMS:</strong></td>
				<td align="right"><input type="text" size="35" name="password_manager" value="<?=generate_password();?>" /></td>
			</tr>
			<tr>
				<td align="left"></td>
				<td align="right">
					<input type="submit" name="dbok_next_1" value="Далее &raquo;" />
				</td>
			</tr>
		</table>
        </form>
	</td></tr></table>

</body>
</html>