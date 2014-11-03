<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action_addgroupus)?$this->lang->line('title_'.$action_addgroupus.'_group'):""?></h1>



<form method="POST" enctype='multipart/form-data'>

<p><label class="req" for="name"><?=$this->lang->line('form_name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=isset($item['name'])?$item['name']:""?>"></p>







<? if(isset($groups) && $groups!=0){ ?>

	<fieldset>
	<legend>Права доступа:</legend>
	
	<? foreach($groups as $df){ ?>
	
	<? if($df['type']=='checkbox'){ ?>


<p>
<label><input type="checkbox" name="field<?=$df['id']?>" value="1" <?=($this->model_user->get_dopfield_value(1, $df['id'])!=''?" checked=\"checked\"":"")?>><?=$df['field']?></label>
</p>



<? } ?>
	
	<? } ?>
</fieldset>
	<? } ?>






<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>