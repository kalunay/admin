<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
		<td>
		<div style="width:80px; height:80px; background-image:url('/install/lapa-right.gif'); background-repeat:no-repeat;">
			<h2 style="padding:50px 0px 0px 0px; margin:0px;">2 шаг</h2>
		</div>
		</td>
		</tr>
		</table>
		
		
		<!-- Messages --> <p style="background-color:#E8F6FF; border:1px solid #B8E2FB;">
		<?=$step_text;?>
		</p>

		<!-- Form -->
		<form method="POST" action="/install/install_form_step.php">
		<table width="90%">
		<tr>
			<td align="center" colspan="2">
			<?=$modules_select;?>
			</td>
			</tr>
			<tr>
				<td align="left">
					<input type="submit" name="dbok_prev_2" value="Назад &raquo;" />
				</td>
				<td align="right">
					<input type="submit" name="dbok_next_2" value="Далее &raquo;" />
				</td>
			</tr>
		</table>
        </form>
	</td></tr></table>

</body>
</html>