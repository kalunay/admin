<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action_object)?$this->lang->line('title_'.$action_object.'_objects'):""?></h1>


<?

function get_option_gallery($array_pages=null, $parent=0, $pi=0, $t='-'){
	if($array_pages!=null){
	$t = '*'.$t;
		foreach($array_pages as $p){
			if($p['parent_id']==$parent){?>
			
			<option value="<?=$p['gallery_cat_id']?>" <?=($p['gallery_cat_id']==$pi?'selected':'')?>><?=$t.$p['title']?></option>
			
			<?
				get_option_gallery($array_pages, $p['gallery_cat_id'], $pi, $t);
			}
		}
	}
}

?>


<form method="POST" enctype='multipart/form-data'>

<p><label class="req" for="name"><?=$this->lang->line('form_name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=isset($item['name'])?$item['name']:""?>">
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('name')">Добавить</a></p>
<div id="name">
<?=langselect('lang_name');?>
<input type="text" class="input-text-02" size="50" name="lang_name_text_en" id="lang_name_text_en" value="<?=lang_text_translation('name',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_name_text_uk" id="lang_name_text_uk" value="<?=lang_text_translation('name',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_name_text_be" id="lang_name_text_be" value="<?=lang_text_translation('name',$item_lang,'be');?>">
</div>
<? }else{ ?></p><? } ?>

<? if($this->model_catalog->field_active_object('menu_name')){ ?>
<p><label class="req" for="menu_name"><?=$this->lang->line('form_menu_name')?></label><br /><input type="text" class="input-text-02" size="50" name="menu_name" value="<?=isset($item['menu_name'])?$item['menu_name']:""?>">
<? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/catalog/objects/delete_field/<?=$cat_id;?>/menu_name"><img src="design/ico-delete.gif" border="0"></a><? } ?>
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('menu_name')">Добавить</a></p>
<div id="menu_name">
<?=langselect('lang_menu_name');?>
<input type="text" class="input-text-02" size="50" name="lang_menu_name_text_en" id="lang_menu_name_text_en" value="<?=lang_text_translation('menu_name',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_menu_name_text_uk" id="lang_menu_name_text_uk" value="<?=lang_text_translation('menu_name',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_menu_name_text_be" id="lang_menu_name_text_be" value="<?=lang_text_translation('menu_name',$item_lang,'be');?>">
</div><? }else{ ?></p><? } ?>
<? } ?>

<p><label class="req" for="title"><?=$this->lang->line('form_title')?></label><br /><input type="text" class="input-text-02" size="50" name="title" value="<?=isset($item['title'])?$item['title']:""?>">
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('title')">Добавить</a></p>
<div id="title">
<?=langselect('lang_title');?>
<input type="text" class="input-text-02" size="50" name="lang_title_text_en" id="lang_title_text_en" value="<?=lang_text_translation('title',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_title_text_uk" id="lang_title_text_uk" value="<?=lang_text_translation('title',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_title_text_be" id="lang_title_text_be" value="<?=lang_text_translation('title',$item_lang,'be');?>">
</div>
<? }else{ ?></p><? } ?>

<p><label class="req" for="mkeywords"><?=$this->lang->line('mkeywords')?></label><br /><input type="text" class="input-text-02" size="50" name="keywords" value="<?=isset($item['keywords'])?$item['keywords']:""?>">
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('keywords')">Добавить</a></p>
<div id="keywords">
<?=langselect('lang_keywords');?>
<input type="text" class="input-text-02" size="50" name="lang_keywords_text_en" id="lang_keywords_text_en" value="<?=lang_text_translation('keywords',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_keywords_text_uk" id="lang_keywords_text_uk" value="<?=lang_text_translation('keywords',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_keywords_text_be" id="lang_keywords_text_be" value="<?=lang_text_translation('keywords',$item_lang,'be');?>">
</div>
<? }else{ ?></p><? } ?>

<p><label class="req" for="mdescription"><?=$this->lang->line('mdescription')?></label><br /><input type="text" class="input-text-02" size="50" name="description" value="<?=isset($item['description'])?$item['description']:""?>">
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('description')">Добавить</a></p>
<div id="description">
<?=langselect('lang_description');?>
<input type="text" class="input-text-02" size="50" name="lang_description_text_en" id="lang_description_text_en" value="<?=lang_text_translation('description',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_description_text_uk" id="lang_description_text_uk" value="<?=lang_text_translation('description',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_description_text_be" id="lang_description_text_be" value="<?=lang_text_translation('description',$item_lang,'be');?>">
</div>
<? }else{ ?></p><? } ?>

<p><label class="req" for="alias"><?=$this->lang->line('form_alias')?></label><br /><input type="text" class="input-text-02" size="50" name="alias" value="<?=isset($item['alias'])?$item['alias']:""?>"></p>

<? if($this->model_catalog->field_active_object('image')){ ?>
<p><label class="req" for="userfile">
 <?=$this->lang->line('form_image')?>
 <? if (isset($item['image']) and $item['image']) echo "<br>
    <a href='".$image_path.$item['image']."' target=_blank><img src=\"".$image_path.$item['image']."\" width=100></a> <a href='catalog/objects/deletephoto/".$cat_id.'/'.$item['id']."'>[ delete ]</a>";
?>
</label><br /><input type="file" class="input-text-02" size="50" name="userfile" >
<? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/catalog/objects/delete_field/<?=$cat_id;?>/image"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>

<? if($this->model_catalog->field_active_object('smalltext')){ ?>
<p>
<label class="req" for="smalltext"><strong><?=$this->lang->line('form_smalltext')?></strong></label>
<? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/catalog/objects/delete_field/<?=$cat_id;?>/smalltext"><img src="design/ico-delete.gif" border="0"></a><? } ?>
<br />
<textarea class="input-text" name="smalltext" cols="100" rows="30"><?=isset($item['smalltext'])?$item['smalltext']:""?></textarea>
<?=fckeditor('smalltext');?>
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('smalltext')">Добавить</a></p>
<div id="smalltext">
<?=langselect('lang_smalltext');?><br />
<div id="div_lang_smalltext_text_en" style="display:block">
<textarea class="input-text" name="lang_smalltext_text_en" id="lang_smalltext_text_en" cols="100" rows="30"><?=lang_text_translation('smalltext',$item_lang,'en');?></textarea>
<?=fckeditor('lang_smalltext_text_en');?>
</div>
<div id="div_lang_smalltext_text_uk" style="display:none">
<textarea class="input-text" name="lang_smalltext_text_uk" id="lang_smalltext_text_uk" cols="100" rows="30"><?=lang_text_translation('smalltext',$item_lang,'uk');?></textarea>
<?=fckeditor('lang_smalltext_text_uk');?>
</div>
<div id="div_lang_smalltext_text_be" style="display:none">
<textarea class="input-text" name="lang_smalltext_text_be" id="lang_smalltext_text_be" cols="100" rows="30"><?=lang_text_translation('smalltext',$item_lang,'be');?></textarea>
<?=fckeditor('lang_smalltext_text_be');?>
</div>
</div><? }else{ ?></p><? } ?>
<? } ?>

<p>
<label class="req" for="text"><strong><?=$this->lang->line('form_text')?></strong></label><br />
<textarea class="input-text" name="text" cols=100 rows=30><?=isset($item['text'])?$item['text']:""?></textarea>
<?=fckeditor('text');?>
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('text')">Добавить</a></p>
<div id="text">
<?=langselect('lang_text');?><br />
<div id="div_lang_text_text_en" style="display:block">
<textarea class="input-text" name="lang_text_text_en" id="lang_text_text_en" cols="100" rows="30"><?=lang_text_translation('text',$item_lang,'en');?></textarea>
<?=fckeditor('lang_text_text_en');?>
</div>
<div id="div_lang_text_text_uk" style="display:none">
<textarea class="input-text" name="lang_text_text_uk" id="lang_text_text_uk" cols="100" rows="30"><?=lang_text_translation('text',$item_lang,'uk');?></textarea>
<?=fckeditor('lang_text_text_uk');?>
</div>
<div id="div_lang_text_text_be" style="display:none">
<textarea class="input-text" name="lang_text_text_be" id="lang_text_text_be" cols="100" rows="30"><?=lang_text_translation('text',$item_lang,'be');?></textarea>
<?=fckeditor('lang_text_text_be');?>
</div>
</div>
<? }else{ ?></p><? } ?>

<? if($this->model_catalog->field_active_object('gallery_cat_id')){ ?>
<p><label class="req" for="gallery_cat_id"><?=$this->lang->line('gallery_cat_id')?></label><br />
<select name="gallery_cat_id">
	<option value="0"><?=$this->lang->line('not')?></option>
	<?=($options_gallery_cat_id?get_option_gallery($options_gallery_cat_id, 0, (isset($item['gallery_cat_id'])?$item['gallery_cat_id']:0)):''); ?>
</select>
<? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/catalog/objects/delete_field/<?=$cat_id;?>/gallery_cat_id"><img src="design/ico-delete.gif" border="0"></a><? } ?>
</p>
<? } ?>

<p><label class="req" for="pos"><?=$this->lang->line('form_pos')?></label><br /><input type="text" class="input-text-02" size="10" name="pos" value="<?=isset($item['pos'])?$item['pos']:""?>"></p>


<p>
<strong><?=$this->lang->line('form_enable')?><br /></strong>
<label><input type="radio" name="publish" value="1"<?=(empty($item['publish']) or $item['publish']==1)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_yes')?></label>
<label><input type="radio" name="publish" value="0"<?=(isset($item['publish']) and $item['publish']==0)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_no')?></label>
</p>











<? if(isset($dopfields) && $dopfields!=0 && isset($object_id)){ ?>
	<? foreach($dopfields as $df){ ?>
	
	<? if($df['type']=='inputtext'){ ?>
	
<p><label class="req" for="field<?=$df['id']?>"><?=$df['field']?></label><br />
<input type="text" class="input-text-02" size="50" name="field<?=$df['id']?>" value="<?=$this->model_catalog->get_dopfield_value($object_id, $df['id']);?>">
<? 
$item_lang_dopfield = $this->model_catalog->get_info_dopfields_lang($object_id, $df['id']);
if(isset($item_lang_dopfield)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('field<?=$df['id']?>')">Добавить</a></p>
<div id="field<?=$df['id']?>">
<?=langselect('lang_field'.$df['id']);?>
<input type="text" class="input-text-02" size="50" name="lang_field<?=$df['id']?>_text_en" id="lang_field<?=$df['id']?>_text_en" value="<?=lang_text_translation('field',$item_lang_dopfield,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_field<?=$df['id']?>_text_uk" id="lang_field<?=$df['id']?>_text_uk" value="<?=lang_text_translation('field',$item_lang_dopfield,'uk');?>">
</div>
<? }else{ ?></p><? } ?>

<? }elseif($df['type']=='textarea'){ ?>


<p>
<p><label class="req" for="field<?=$df['id']?>"><?=$df['field']?></label><br />
<textarea class="input-text" name="field<?=$df['id']?>" cols="100" rows="30"><?=$this->model_catalog->get_dopfield_value($object_id, $df['id']);?></textarea>
<?=fckeditor('field'.$df['id']);?>
<? 
$item_lang_dopfield = $this->model_catalog->get_info_dopfields_lang($object_id, $df['id']);
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
</div>
<? }else{ ?></p><? } ?>


<? }elseif($df['type']=='checkbox'){ ?>

<p>
<label><input type="checkbox" name="field<?=$df['id']?>" value="1" <?=($this->model_catalog->get_dopfield_value($object_id, $df['id'])!=''?" checked=\"checked\"":"")?>><?=$df['field']?></label>
</p>

<? } ?>
	
	<? } ?>
<? } ?>









<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>