<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
    <base href="http://<?=$_SERVER['SERVER_NAME']?>/_admin/" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/main.css" /> <!-- MAIN STYLE SHEET -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="js/toggle.js"></script>
	<title>Sprava CMS - Log In</title>
</head>

<body id="login">

<div id="main-02">

	<div id="login-top"></div>

	<div id="login-box">

		<!-- Logo -->
		<p class="nom t-center"><a href="#"><img src="tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

		<!-- Messages --> <? if($warning): ?>
		<p class="msg error">Ошибка ввода логина-пароля</p>
		                  <? endif; ?>
		<p class="msg info">Введите свой логин и пароль</p>

		<!-- Form --><form method="POST">
		<table class="nom nostyle">
			<tr>
				<td style="width:75px;"><label for="login-user"><strong>Логин:</strong></label></td>
				<td><input type="text" size="45" name="login" class="input-text" id="login-user" /></td>
			</tr>
			<tr>
				<td><label for="login-pass"><strong>Пароль:</strong></label></td>
				<td><input type="password" size="45" name="pass" class="input-text" id="login-pass" /></td>
			</tr>
			<tr>
				<td></td>
				<td>

					<span class="f-left low"><input type="checkbox" name="" value="" id="login-remember" /> <label for="login-remember">Запомнить меня</label></span>
				</td>
			</tr>
			<!-- Show/Hide -->

			<tr>
				<td colspan="2" class="t-right"><input type="submit" class="input-submit" value="Войти &raquo;" /></td>
			</tr>
		</table>
        </form>
	</div> <!-- /login-box -->

	<div id="login-bottom"></div>

</div> <!-- /main -->

</body>
</html>
