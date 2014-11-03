<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action_adddopfield)?$this->lang->line('title_'.$action_adddopfield.'_dopfield'):""?></h1>



<form method="POST" enctype='multipart/form-data'>

<p><label class="req" for="field"><?=$this->lang->line('form_field')?></label><br /><input type="text" class="input-text-02" size="50" name="field" value="<?=isset($item['field'])?$item['field']:""?>">
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('field')">Добавить</a></p>
<div id="field">
<?=langselect('lang_field');?>
<input type="text" class="input-text-02" size="50" name="lang_field_text_en" id="lang_field_text_en" value="<?=lang_text_translation('field',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_field_text_uk" id="lang_field_text_uk" value="<?=lang_text_translation('field',$item_lang,'uk');?>">
</div>
<? }else{ ?></p><? } ?>

<p><label class="req" for="type"><?=$this->lang->line('form_type')?></label><br />
<select name="type">
	<option value="inputtext" <?=(isset($item['type']) && $item['type']=='inputtext'?'selected':'')?>>Строка</option>
	<option value="textarea" <?=(isset($item['type']) && $item['type']=='textarea'?'selected':'')?>>Поле с текстовым редактором</option>
	<option value="checkbox" <?=(isset($item['type']) && $item['type']=='checkbox'?'selected':'')?>>Логический пункт (да/нет)</option>
</select>
</p>


<p><label class="req" for="pos"><?=$this->lang->line('form_pos')?></label><br /><input type="text" class="input-text-02" size="10" name="pos" value="<?=isset($item['pos'])?$item['pos']:""?>"></p>


<p>
<strong><?=$this->lang->line('form_enable')?><br /></strong>
<label><input type="radio" name="publish" value="1"<?=(empty($item['publish']) or $item['publish']==1)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_yes')?></label>
<label><input type="radio" name="publish" value="0"<?=(isset($item['publish']) and $item['publish']==0)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_no')?></label>
</p>


<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>