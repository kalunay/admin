<?php include(APPPATH.'views/_header.php'); ?>

<link rel="stylesheet" media="screen,projection" type="text/css" href="/css/slimbox2.css" /> <!-- LIGHTBOX -->
<script type="text/javascript" src="/js/jquery.slimbox2.js"></script>
<h1><?=$this->lang->line('head_content+pages')?></h1>

<form method="POST" enctype="multipart/form-data" name="pageform">

<?

function get_option($array_pages=null, $itemid=0, $parent=0, $pi=0, $t='-'){
	if($array_pages!=null){
	$t = '*'.$t;
		foreach($array_pages as $p){
			if($p['parent_id']==$parent && $p['id']!= $itemid){?>
			
			<option value="<?=$p['id']?>" <?=($p['id']==$pi?'selected':'')?>><?=$t.$p['name']?></option>
			
			<?
				get_option($array_pages, $itemid, $p['id'], $pi, $t);
			}
		}
	}
}

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

<p><label class="req" for="parent"><?=$this->lang->line('parent')?></label><br />
<select name="parent_id">
	<option value="0"><?=$this->lang->line('not')?></option>
	<?=get_option($options, $item['id'], 0, $item['parent_id']); ?>
</select>
</p>

<p><label class="req" for="title"><?=$this->lang->line('name')?></label><br />
<input type="text" class="input-text-02" size="50" name="name" value="<?=$item['name']?>"><br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('name')">Добавить</a></p>
<div id="name">
<?=langselect('lang_name');?>
<input type="text" class="input-text-02" size="50" name="lang_name_text_en" id="lang_name_text_en" value="<?=lang_text_translation('name',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_name_text_uk" id="lang_name_text_uk" value="<?=lang_text_translation('name',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_name_text_be" id="lang_name_text_be" value="<?=lang_text_translation('name',$item_lang,'be');?>">
</div>

<? if($this->model_pages->field_active('menu_name')){ ?>
<p><label class="req" for="title"><?=$this->lang->line('menu_name')?></label><br /><input type="text" class="input-text-02" size="50" name="menu_name" value="<?=$item['menu_name']?>"><br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('menu_name')">Добавить</a></p>
<div id="menu_name">
<?=langselect('lang_menu_name');?>
<input type="text" class="input-text-02" size="50" name="lang_menu_name_text_en" id="lang_menu_name_text_en" value="<?=lang_text_translation('menu_name',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_menu_name_text_uk" id="lang_menu_name_text_uk" value="<?=lang_text_translation('menu_name',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_menu_name_text_be" id="lang_menu_name_text_be" value="<?=lang_text_translation('menu_name',$item_lang,'be');?>">
</div>
<? } ?>

<p><label class="req" for="title_window"><?=$this->lang->line('mtitle')?></label><br /><input type="text" class="input-text-02" size="50" name="title" value="<?=$item['title']?>"><br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('title')">Добавить</a></p>
<div id="title">
<?=langselect('lang_title');?>
<input type="text" class="input-text-02" size="50" name="lang_title_text_en" id="lang_title_text_en" value="<?=lang_text_translation('title',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_title_text_uk" id="lang_title_text_uk" value="<?=lang_text_translation('title',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_title_text_be" id="lang_title_text_be" value="<?=lang_text_translation('title',$item_lang,'be');?>">
</div>

<p><label class="req" for="title_window"><?=$this->lang->line('mkeywords')?></label><br /><input type="text" class="input-text-02" size="50" name="keywords" value="<?=$item['keywords']?>"><br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('keywords')">Добавить</a></p>
<div id="keywords">
<?=langselect('lang_keywords');?>
<input type="text" class="input-text-02" size="50" name="lang_keywords_text_en" id="lang_keywords_text_en" value="<?=lang_text_translation('keywords',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_keywords_text_uk" id="lang_keywords_text_uk" value="<?=lang_text_translation('keywords',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_keywords_text_be" id="lang_keywords_text_be" value="<?=lang_text_translation('keywords',$item_lang,'be');?>">
</div>

<p><label class="req" for="title_window"><?=$this->lang->line('mdescription')?></label><br /><input type="text" class="input-text-02" size="50" name="description" value="<?=$item['description']?>"><br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('description')">Добавить</a></p>
<div id="description">
<?=langselect('lang_description');?>
<input type="text" class="input-text-02" size="50" name="lang_description_text_en" id="lang_description_text_en" value="<?=lang_text_translation('description',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_description_text_uk" id="lang_description_text_uk" value="<?=lang_text_translation('description',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_description_text_be" id="lang_description_text_be" value="<?=lang_text_translation('description',$item_lang,'be');?>">
</div>





<p>
<label class="req" for="text"><strong><?=$this->lang->line('descr_big')?></strong></label><br />
<textarea class="input-text" name="text" cols=100 rows=30><?=$item['text']?></textarea>
<?=fckeditor('text');?>
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


<p><label class="req" for="title_window"><?=$this->lang->line('pos')?></label><br /><input type="text" class="input-text-02" size="50" name="pos" value="<?=$item['pos']?>"></p>

<p><label class="req" for="alias"><?=$this->lang->line('form_alias')?></label><br /><input type="text" class="input-text-02" size="50" name="alias" value="<?=$item['alias']?>"></p>

<? if($this->model_pages->field_active('gallery_cat_id')){ ?>
<p><label class="req" for="gallery_cat_id"><?=$this->lang->line('gallery_cat_id')?></label><br />
<select name="gallery_cat_id">
	<option value="0"><?=$this->lang->line('not')?></option>
	<?=($options_gallery_cat_id?get_option_gallery($options_gallery_cat_id, 0, $item['gallery_cat_id']):''); ?>
</select>
</p>
<? } ?>
<p>
<label><input type="checkbox" name="publish" value="1" <?=($item['publish']==1?'checked=true':'')?>> <?=$this->lang->line('form_publish')?></label>
</p>

<p>
<label class="req" for="menu"><?=$this->lang->line('menu')?></label><br />
<label><input type="checkbox" name="show_top_menu" value="1" <?=($item['show_menu_top']==1?'checked=true':'')?>> <?=$this->lang->line('show_top_menu')?></label>
<br />
<? if($this->model_pages->field_active('show_menu_left')){ ?>
<label><input type="checkbox" name="show_left_menu" value="1" <?=($item['show_menu_left']==1?'checked=true':'')?>> <?=$this->lang->line('show_left_menu')?></label>
<br />
<? } ?>
<? if($this->model_pages->field_active('show_menu_right')){ ?>
<label><input type="checkbox" name="show_right_menu" value="1" <?=($item['show_menu_right']==1?'checked=true':'')?>> <?=$this->lang->line('show_right_menu')?></label>
<br />
<? } ?>
<? if($this->model_pages->field_active('show_menu_bottom')){ ?>
<label><input type="checkbox" name="show_bottom_menu" value="1" <?=($item['show_menu_bottom']==1?'checked=true':'')?>> <?=$this->lang->line('show_bottom_menu')?></label>
<? } ?>
</p>








<input type="hidden" name="id" value="<?=$item['id']?>">

<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_add')?>">
</div>
</form>

<?php include(APPPATH.'views/_footer.php'); ?>