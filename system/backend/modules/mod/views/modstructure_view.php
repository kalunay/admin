<?php include(APPPATH.'views/_header.php'); ?>


<script type="text/javascript">

function changeallselect(){

<? if($this->model_mod->get_mod_structure()){ foreach($this->model_mod->get_mod_structure() as $it){ ?> 

if(document.getElementById('checkbox<?=$it['id']?>').checked==true){ document.getElementById('checkbox<?=$it['id']?>').checked=false; }else{ document.getElementById('checkbox<?=$it['id']?>').checked=true; }

<? }} ?>

}

</script>


<h1><?=$this->lang->line('head_modstructure')?></h1>
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
<th class="header"><?=$this->lang->line('mod-structure')?></th>
</tr>
				</thead>

<? $index=0; if($this->model_mod->get_mod_structure()){ foreach($this->model_mod->get_mod_structure() as $it){ ?>

<tr>
	<td class="t-center">
		<input type="checkbox" id="checkbox<?=$it['id']?>" name="id[<?=$index?>]" value="<?=$it['id']?>" <?=$it['active']?"checked=true":""?> />
		<input type="hidden" name="module[<?=$index?>]" value="<?=$it['module_name']?>"/>
		<input type="hidden" name="fieldname[<?=$index?>]" value="<?=$it['field_name']?>"/></td>
	<td class="t-center"><?=$it['module_name']?></td>
	<td class="t-center"><img src="design/ico-<?=$it['active']?"done":"delete"?>.gif"></td>
	<td class="t-center"><?=$it['field_name']?></td>
</tr>

<?  $index++; }} ?>

</table>

<input type="hidden" name="index" value="<?=$index?>"/>
<input type="checkbox" name="allselect" id="selectall" onclick="javascript:changeallselect();"> выделить всё <br /><br />

<div class="box-01">
<input type="submit" class="input-submit" name="save" value="<?=$this->lang->line('submit_save')?>">
</div>

</form>


<?php include(APPPATH.'views/_footer.php'); ?>