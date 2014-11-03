</div> <!-- /content -->



<? if($this->model_users->field_active('mailer')){ if($_SERVER['REQUEST_URI']=='/_admin/'){ ?>
				<form name="rccform" action="" method="post" style="padding:10px 0 0 250px;">
				<?=$optionrcc_result;?>
				Рассылка новостей:<br />
					<select name="newsrassylka[]" multiple="multiple" size="5" style="width:400px;">
						<option value="all">все</option>
						<?=$optionrcc;?>
					</select><br />
					<input type="submit" name="rccok" value="Разослать" />	
				</form>
				<? } } ?>


	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2012 <a href="http://infoukr.com">ТМ &laquo;Справа&raquo;</a>, Все права защищены &reg;</p>

		

	</div> <!-- /footer -->

</div> <!-- /main -->

</body>
</html>
