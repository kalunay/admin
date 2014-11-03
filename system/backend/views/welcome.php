<?php include("_header.php"); ?>

<h1><?=$this->lang->line('welcome')?> </h1>

<h3>Быстрый переход</h3>


<? if($modules){ ?>
			<? foreach($modules as $mod){ ?>

			<div class="btn-box">
			<div class="btn-top"></div>
			<div class="btn">
				<dl>
					<dt><?=anchor($mod['name'],$mod['title'])?></dt>
					<dd>Редактирование содержимого сайта</dd>
				</dl>
			</div> <!-- /btn -->
			<div class="btn-bottom"></div>
			</div>	

			<? } ?>
<? } ?>
			

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php include("_footer.php"); ?>