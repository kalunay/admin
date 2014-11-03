<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action)?$this->lang->line('title_'.$action.'_valuta'):""?></h1>

<form method="POST" enctype='multipart/form-data'>



<p><label class="req" for="name"><?=$this->lang->line('form_name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=isset($item['name'])?$item['name']:""?>"></p>

<p><label class="req" for="name"><?=$this->lang->line('form_name_k')?></label><br /><input type="text" class="input-text-02" size="50" name="name_k" value="<?=isset($item['name_k'])?$item['name_k']:""?>"></p>

<p><label class="req" for="name"><?=$this->lang->line('form_value')?></label><br /><input type="text" class="input-text-02" size="50" name="value" value="<?=isset($item['value'])?$item['value']:""?>"></p>

<p><label class="req" for="name"><?=$this->lang->line('form_now')?></label><br />
<input type="checkbox" class="input-text-02" name="now" value="1" <?=isset($item['now']) && $item['now']==1?'checked=true':""?>> <?=$this->lang->line('form_now_yes')?></p>



<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>