<?php include(APPPATH.'views/_header.php'); ?>
<h1><?=$this->lang->line('head_mod')?></h1>
<br />
<? if(@$msg=='saved'): ?>
         <p class="msg done"><?=$this->lang->line('mod_saved')?></p>
<? endif; ?>

<form method="post">

<table class="draggble" id="cat1">
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('mod-name')?></th>
<th class="header"><?=$this->lang->line('mod-active')?></th>
<th class="header"><?=$this->lang->line('mod-title')?></th>
</tr>
				</thead>

<? $index=0; if($this->model_mod->get_mod()){ foreach($this->model_mod->get_mod() as $it){ ?>

<tr>
	<td class="t-center">
		<input type="checkbox" name="id[<?=$index?>]" value="<?=$it['id']?>" <?=$it['active']?"checked=true":""?> />
		<input type="hidden" name="idhid[<?=$index?>]" value="<?=$it['id']?>"/></td>
	<td class="t-center"><?=$it['name']?></td>
	<td class="t-center"><img src="design/ico-<?=$it['active']?"done":"delete"?>.gif"></td>
	<td class="t-center"><?=$it['title']?></td>
</tr>

<?  $index++; }} ?>

</table>

<input type="hidden" name="index" value="<?=$index?>"/>

<div class="box-01">
<input type="submit" class="input-submit" name="save" value="<?=$this->lang->line('submit_save')?>">
</div>

</form>


<?php include(APPPATH.'views/_footer.php'); ?>