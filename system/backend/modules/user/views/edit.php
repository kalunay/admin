<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action)?$this->lang->line('title_'.$action.'_news'):""?></h1>

<form method="POST" enctype='multipart/form-data'>


<p><label class="req" for="group_usr"><?=$this->lang->line('group_usr')?></label><br />
<select name="group_usr">
	<option value="0">не задан</option>
	<?=$this->model_user->get_group_usr((isset($item['group_usr'])?$item['group_usr']:"")) ?>
</select>
</p>

<p><label class="req" for="name"><?=$this->lang->line('form_name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=isset($item['name'])?$item['name']:""?>">
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('name')">Добавить</a></p>
<div id="name">
<?=langselect('lang_name');?>
<input type="text" class="input-text-02" size="50" name="lang_name_text_en" id="lang_name_text_en" value="<?=lang_text_translation('name',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_name_text_uk" id="lang_name_text_uk" value="<?=lang_text_translation('name',$item_lang,'uk');?>">
</div>
<? }else{ ?></p><? } ?>


<? if($this->model_user->field_active('image')){ ?>
<p><label class="req" for="userfile">
 <?=$this->lang->line('form_image')?>
 <? if (isset($item['image']) and $item['image']) echo "<br>
    <a href='".$image_path.$item['image']."' target=_blank><img src=\"".$image_path.$item['image']."\" width=100></a> <a href='user/deletephoto/".$item['id']."'>[ delete ]</a>";
?>
</label><br /><input type="file" class="input-text-02" size="50" name="userfile" >
<? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/user/delete_field/image"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>


<p><label class="req" for="email"><?=$this->lang->line('form_email')?></label><br /><input type="text" class="input-text-02" size="50" name="email" value="<?=isset($item['email'])?$item['email']:""?>"></p>

<p><label class="req" for="phone"><?=$this->lang->line('form_phone')?></label><br /><input type="text" class="input-text-02" size="50" name="phone" value="<?=isset($item['phone'])?$item['phone']:""?>"></p>

<p><label class="req" for="login"><?=$this->lang->line('form_login')?></label><br /><input type="text" class="input-text-02" size="50" name="login" value="<?=isset($item['login'])?$item['login']:""?>"></p>

<p><label class="req" for="password"><?=$this->lang->line('form_password')?></label><br /><input type="text" class="input-text-02" size="50" name="password" value="<?=isset($item['password'])?$item['password']:""?>"></p>


<p>
<label class="req" for="address"><strong><?=$this->lang->line('form_address')?></strong></label><br />
<textarea class="input-text" name="address" cols=100 rows=30><?=isset($item['address'])?$item['address']:""?></textarea>
<?=fckeditor('address');?>
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('address')">Добавить</a></p>
<div id="address">
<?=langselect('lang_address');?><br />
<div id="div_lang_address_text_en" style="display:block">
<textarea class="input-text" name="lang_address_text_en" id="lang_address_text_en" cols="100" rows="30"><?=lang_text_translation('address',$item_lang,'en');?></textarea>
<?=fckeditor('lang_address_text_en');?>
</div>
<div id="div_lang_address_text_uk" style="display:none">
<textarea class="input-text" name="lang_address_text_uk" id="lang_address_text_uk" cols="100" rows="30"><?=lang_text_translation('address',$item_lang,'uk');?></textarea>
<?=fckeditor('lang_address_text_uk');?>
</div>
</div>
<? }else{ ?></p><? } ?>

<p>
<label class="req" for="description"><strong><?=$this->lang->line('form_description')?></strong></label><br />
<textarea class="input-text" name="description" cols=100 rows=30><?=isset($item['description'])?$item['description']:""?></textarea>
<?=fckeditor('description');?>
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('description')">Добавить</a></p>
<div id="description">
<?=langselect('lang_address');?><br />
<div id="div_lang_description_text_en" style="display:block">
<textarea class="input-text" name="lang_description_text_en" id="lang_description_text_en" cols="100" rows="30"><?=lang_text_translation('description',$item_lang,'en');?></textarea>
<?=fckeditor('lang_description_text_en');?>
</div>
<div id="div_lang_description_text_uk" style="display:none">
<textarea class="input-text" name="lang_description_text_uk" id="lang_description_text_uk" cols="100" rows="30"><?=lang_text_translation('description',$item_lang,'uk');?></textarea>
<?=fckeditor('lang_description_text_uk');?>
</div>
</div>
<? }else{ ?></p><? } ?>


<? if($this->model_user->field_active('mailer')){ ?>
<p>
<strong><?=$this->lang->line('form_mailer')?><? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/user/delete_field/mailer"><img src="design/ico-delete.gif" border="0"></a><? } ?><br /></strong>
<label><input type="radio" name="mailer" value="1"<?=(isset($item['mailer']) and $item['mailer']==1)?" checked=\"checked\"":""?>><?=$this->lang->line('form_mailer_yes')?></label>
<label><input type="radio" name="mailer" value="0"<?=(empty($item['mailer']) or $item['mailer']==0)?" checked=\"checked\"":""?>><?=$this->lang->line('form_mailer_no')?></label>
</p>
<? } ?>

<p>
<strong><?=$this->lang->line('form_enable')?><br /></strong>
<label><input type="radio" name="active" value="1"<?=(isset($item['active']) and $item['active']==1)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_yes')?></label>
<label><input type="radio" name="active" value="0"<?=(empty($item['active']) or $item['active']==0)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_no')?></label>
</p>


<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>