<?php include(APPPATH.'views/_header.php'); ?>



<h1><?=$this->lang->line('head_content+pages')?></h1>

<form method="POST" enctype="multipart/form-data">

<?

function get_option($array_pages=null, $parent=0, $t='-'){
	if($array_pages!=null){
	$t = '*'.$t;
		foreach($array_pages as $p){
			if($p['parent_id']==$parent){?>
			
			<option value="<?=$p['id']?>"><?=$t.$p['name']?></option>
			
			<?
				get_option($array_pages, $p['id'], $t);
			}
		}
	}
}

function get_option_gallery($array_pages=null, $parent=0, $t='-'){
	if($array_pages!=null){
	$t = '*'.$t;
		foreach($array_pages as $p){
			if($p['parent_id']==$parent){?>
			
			<option value="<?=$p['gallery_cat_id']?>"><?=$t.$p['title']?></option>
			
			<?
				get_option_gallery($array_pages, $p['gallery_cat_id'], $t);
			}
		}
	}
}

?>

<p><label class="req" for="parent"><?=$this->lang->line('parent')?></label><br />
<select name="parent_id">
	<option value="0"><?=$this->lang->line('not')?></option>
	<?=get_option($options,0); ?>
</select>
</p>


<p><label class="req" for="title"><?=$this->lang->line('name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value=""></p>

<? if($this->model_pages->field_active('menu_name')){ ?>
<p><label class="req" for="title"><?=$this->lang->line('menu_name')?></label><br /><input type="text" class="input-text-02" size="50" name="menu_name" value="">
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/pages/delete_field/menu_name"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>

<p><label class="req" for="title_window"><?=$this->lang->line('mtitle')?></label><br /><input type="text" class="input-text-02" size="50" name="title" value=""></p>
<p><label class="req" for="title_window"><?=$this->lang->line('mkeywords')?></label><br /><input type="text" class="input-text-02" size="50" name="keywords" value=""></p>
<p><label class="req" for="title_window"><?=$this->lang->line('mdescription')?></label><br /><input type="text" class="input-text-02" size="50" name="description" value=""></p>
<p>
<label class="req" for="text"><strong><?=$this->lang->line('descr_big')?></strong></label><br />
<textarea class="input-text" name="text" cols=100 rows=30></textarea>
<?=fckeditor('text');?>
</p>
<p><label class="req" for="title_window"><?=$this->lang->line('pos')?></label><br /><input type="text" class="input-text-02" size="50" name="pos" value=""></p>

<p><label class="req" for="alias"><?=$this->lang->line('form_alias')?></label><br /><input type="text" class="input-text-02" size="50" name="alias" value=""></p>

<? if($this->model_pages->field_active('gallery_cat_id')){ ?>
<p><label class="req" for="gallery_cat_id"><?=$this->lang->line('gallery_cat_id')?></label><br />
<select name="gallery_cat_id">
	<option value="0"><?=$this->lang->line('not')?></option>
	<?=($options_gallery_cat_id?get_option_gallery($options_gallery_cat_id,0):''); ?>
</select>
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/pages/delete_field/gallery_cat_id"><img src="design/ico-delete.gif" border="0"></a><? } ?>
</p>
<? } ?>

<p>
<label><input type="checkbox" name="publish" value="1"> <?=$this->lang->line('form_publish')?></label>
</p>

<p>
<label class="req" for="menu"><?=$this->lang->line('menu')?></label><br />

<label><input type="checkbox" name="show_top_menu" value="1"> <?=$this->lang->line('show_top_menu')?></label>
<br />

<? if($this->model_pages->field_active('show_menu_left')){ ?>
<label><input type="checkbox" name="show_left_menu" value="1"> <?=$this->lang->line('show_left_menu')?></label>
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/pages/delete_field/show_menu_left"><img src="design/ico-delete.gif" border="0"></a><? } ?>
<br />
<? } ?>
<? if($this->model_pages->field_active('show_menu_right')){ ?>
<label><input type="checkbox" name="show_right_menu" value="1"> <?=$this->lang->line('show_right_menu')?></label>
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/pages/delete_field/show_menu_right"><img src="design/ico-delete.gif" border="0"></a><? } ?>
<br />
<? } ?>
<? if($this->model_pages->field_active('show_menu_bottom')){ ?>
<label><input type="checkbox" name="show_bottom_menu" value="1"> <?=$this->lang->line('show_bottom_menu')?></label>
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/pages/delete_field/show_menu_bottom"><img src="design/ico-delete.gif" border="0"></a><? } ?>
<? } ?>
</p>





<div class="box-01">
<input type="submit" class="input-submit" name="add" value="<?=$this->lang->line('submit_add')?>">
</div>


</form>


<?php include(APPPATH.'views/_footer.php'); ?>