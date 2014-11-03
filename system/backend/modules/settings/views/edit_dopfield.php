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





<? if(isset($dopfields) && $dopfields!=0){ ?>
	<? foreach($dopfields as $df){ ?>
	
	<? if($df['type']=='inputtext'){ ?>
	
<p><label class="req" for="field<?=$df['id']?>"><?=$df['field']?></label><br />
<input type="text" class="input-text-02" size="50" name="field<?=$df['id']?>" value="<?=$this->model_settings->get_dopfield_value(1, $df['id']);?>">
<? 
$item_lang_dopfield = $this->model_settings->get_info_dopfields_lang(1, $df['id']);
if(isset($item_lang_dopfield)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('field<?=$df['id']?>')">Добавить</a></p>
<div id="field<?=$df['id']?>">
<?=langselect('lang_field'.$df['id']);?>
<input type="text" class="input-text-02" size="50" name="lang_field<?=$df['id']?>_text_en" id="lang_field<?=$df['id']?>_text_en" value="<?=lang_text_translation('field',$item_lang_dopfield,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_field<?=$df['id']?>_text_uk" id="lang_field<?=$df['id']?>_text_uk" value="<?=lang_text_translation('field',$item_lang_dopfield,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_field<?=$df['id']?>_text_be" id="lang_field<?=$df['id']?>_text_be" value="<?=lang_text_translation('field',$item_lang_dopfield,'be');?>">
</div>
<? }else{ ?></p><? } ?>

<? }elseif($df['type']=='textarea'){ ?>



<p><label class="req" for="field<?=$df['id']?>"><?=$df['field']?></label><br />
<textarea class="input-text" name="field<?=$df['id']?>" cols="100" rows="30"><?=$this->model_settings->get_dopfield_value(1, $df['id']);?></textarea>
<?=fckeditor('field'.$df['id']);?>
<? 
$item_lang_dopfield = $this->model_settings->get_info_dopfields_lang(1, $df['id']);
if(isset($item_lang_dopfield)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('field<?=$df['id']?>')">Добавить</a></p>
<div id="field<?=$df['id']?>">
<?=langselect('lang_field'.$df['id']);?><br />
<div id="div_lang_field<?=$df['id']?>_text_en" style="display:block">
<textarea class="input-text" name="lang_field<?=$df['id']?>_text_en" id="lang_field<?=$df['id']?>_text_en" cols="100" rows="30"><?=lang_text_translation('field',$item_lang_dopfield,'en');?></textarea>
<?=fckeditor('lang_field'.$df['id'].'_text_en');?>
</div>
<div id="div_lang_field<?=$df['id']?>_text_uk" style="display:none">
<textarea class="input-text" name="lang_field<?=$df['id']?>_text_uk" id="lang_field<?=$df['id']?>_text_uk" cols="100" rows="30"><?=lang_text_translation('field',$item_lang_dopfield,'uk');?></textarea>
<?=fckeditor('lang_field'.$df['id'].'_text_uk');?>
</div>
<div id="div_lang_field<?=$df['id']?>_text_be" style="display:none">
<textarea class="input-text" name="lang_field<?=$df['id']?>_text_be" id="lang_field<?=$df['id']?>_text_be" cols="100" rows="30"><?=lang_text_translation('field',$item_lang_dopfield,'be');?></textarea>
<?=fckeditor('lang_field'.$df['id'].'_text_be');?>
</div>
</div>
<? }else{ ?></p><? } ?>


<? }elseif($df['type']=='checkbox'){ ?>

<p>
<label><input type="checkbox" name="field<?=$df['id']?>" value="1" <?=($this->model_settings->get_dopfield_value(1, $df['id'])!=''?" checked=\"checked\"":"")?>><?=$df['field']?></label>
</p>

<? } ?>
	
	<? } ?>
<? } ?>



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