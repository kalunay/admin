<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
    <base href="http://<?=$_SERVER['SERVER_NAME']?>/_admin/" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />

	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="js/jquery.switcher.js"></script>
	<script type="text/javascript" src="js/toggle.js"></script>
	<? if($this->uri->segment(1)=="gallery"): ?>
	<script type="text/javascript" src="js/ui.core_gall.js"></script>
	<? else: ?>
	<script type="text/javascript" src="js/ui.core.js"></script>	
	<? endif; ?>
	
	
	<? if(!strstr($_SERVER['REQUEST_URI'],'gallery')){ ?>
	
	<script language="JavaScript" src="/js/calendar_us.js"></script>
	<link rel="stylesheet" href="/css/calendar.css">
	
	<? } ?>
	
	
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/timepicker.js"></script>
	<script type="text/javascript" src="js/ui.tabs.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
		$.tablesorter.defaults.sortList = [[1,0]];
		$(".tablesort").tablesorter({
			headers: {
				0: { sorter: false },
				7: { sorter: false }
			}
		});
	});
	</script>
	
	
	<script type="text/javascript"> 
	$(document).ready(function(){
		/* $(".tabs > ul").tabs();
		$.tablesorter.defaults.sortList = [[1,0]];
		$("table").tablesorter({
			headers: {
				0: { sorter: false },
				7: { sorter: false }
			}
		}); */


                    $('.datetime').datepicker({
    	duration: '',
        showTime: true,
        constrainInput: false,
        dateFormat:'yy-mm-dd',
        firstDay:1,
        dayNamesMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"]
     });



});


	</script> 

	
<style type="text/css">
#name, #menu_name, #title, #keywords, #description, #text, #smalltext, #body, #title_window, #address, #field<? if(isset($dopfields) && $dopfields!=0){ foreach($dopfields as $df){ ?>, #field<?=$df['id']?><? } } ?>{
display:none;
border: 1px solid #000000;
padding:10px;
text-align:left;
}
</style>

<script type="text/javascript">

function showblock(block){

	if(document.getElementById(block).style.display=='none'){
		document.getElementById(block).style.display='block';
	}else{
		document.getElementById(block).style.display='none';
	}
	
}

function changetype(chtype){

var selin = document.getElementById(chtype).selectedIndex;
var v = document.getElementById(chtype).options[selin].value;

if(v=='en'){ 
	document.getElementById(chtype + '_text_en').type='text'; 
	document.getElementById(chtype + '_text_uk').type='hidden'; 
	document.getElementById(chtype + '_text_be').type='hidden';
	document.getElementById('div_' + chtype + '_text_en').style.display='block'; 
	document.getElementById('div_' + chtype + '_text_uk').style.display='none'; 
	document.getElementById('div_' + chtype + '_text_be').style.display='none';
	}
if(v=='uk'){ 
	document.getElementById(chtype + '_text_en').type='hidden'; 
	document.getElementById(chtype + '_text_uk').type='text'; 
	document.getElementById(chtype + '_text_be').type='hidden'; 
	document.getElementById('div_' + chtype + '_text_en').style.display='none'; 
	document.getElementById('div_' + chtype + '_text_uk').style.display='block';
	document.getElementById('div_' + chtype + '_text_be').style.display='none'; 	
	}
if(v=='be'){ 
	document.getElementById(chtype + '_text_en').type='hidden'; 
	document.getElementById(chtype + '_text_uk').type='hidden'; 
	document.getElementById(chtype + '_text_be').type='text';
	document.getElementById('div_' + chtype + '_text_en').style.display='none'; 
	document.getElementById('div_' + chtype + '_text_uk').style.display='none'; 
	document.getElementById('div_' + chtype + '_text_be').style.display='block';
	}

}

</script>
	

	
	<title>Панель управления</title>

</head>

<body>

<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">

				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			Сайт: <strong><?=$_SERVER['SERVER_NAME']?></strong>

		</p>

		<p class="f-right">Пользователь: <strong><a href="#">Admin</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><?=anchor("welcome/logout",'Выход',array('id'=>'logout'))?></strong></p>
		
		
		<table border="0" cellpadding="0" cellspacing="0" style="position:absolute; top:3px; right:0px; margin:0px 250px 0px 0px; z-index:1000;"><tr><td align="right">
		<img src="/img/install/garant-left.png" />
		</td><td align="center" valign="middle" style="background-image:url('/img/install/garant-center.png'); backgroung-repeat: repeat-x; vertical-align: middle; font-size:13px; color:#ffffff;">

		CMS Справа настроена<br />для домена <?=$_SERVER['SERVER_NAME']?>

		</td><td align="left">
		<img src="/img/install/garant-right.png" />
		</td></tr></table>
		

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box f-right">
			<li><a href="/"><span><strong>Просмотр сайта &raquo;</strong></span></a></li>

		</ul>

		<ul class="box">
			<li><?=anchor("",'<span>Главная</span>')?></li>
			<li onmouseover="this.className = 'dropdown-on'" onmouseout="this.className = 'dropdown-off'">
			<div><a href="javascript:viod(0);"><span>Содержание</span></a>
				<div class="drop">
					<ul class="box">
					
					<? if($modules){ ?>
						<? foreach($modules as $mod){ ?>
			
							<li><?=anchor($mod['name'],$mod['title'])?></li>

						<? } ?>
					<? } ?>

					</ul>
				</div> <!-- /drop -->
			</div></li>
			<? if($this->session->userdata('admin')==1){ ?>
			<li><?=anchor("mod",'<span>Модули</span>')?></li>
			<li><?=anchor("mod/structure",'<span>Структура</span>')?></li>
			<? } ?>
		</ul>

	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>
				
				<div style="color:#037db8; position:absolute; margin: -35px 0px 0px 175px;">101</div>

			</div> <!-- /padding -->

			<ul class="box">
            <li><?=anchor("",'<span>Главная</span>')?></li>
			<li><a href="javascript:viod(0);"><span>Содержание</span></a>
				<ul>
				<? if($modules){ ?>
					<? foreach($modules as $mod){ ?>
					
						<li><?=anchor($mod['name'],$mod['title'])?></li> 
					
					<? } ?>
				<? } ?>
				</ul>
			</li>
			<? if($this->session->userdata('admin')==1){ ?>
			<li><?=anchor("mod",'<span>Модули</span>')?></li>
			<li><?=anchor("mod/structure",'<span>Структура</span>')?></li>
			<? } ?>
			</ul>

				
				

			
			<p style="padding:20px;">
				<a href="http://infoukr.com/files/documents/User_manual.pdf">Инструкция пользователя</a>
			</p>
		</div> <!-- /aside -->

		<hr class="noscreen" />

		<!-- Content (Right Column) -->
		<div id="content" class="box">