<?php include(APPPATH.'views/_header.php'); ?>
<script type="text/javascript" src="js/jquery.slimbox2.js"></script>
<link rel="stylesheet" media="screen,projection" type="text/css" href="css/slimbox2.css" /> <!-- LIGHTBOX -->

<h1><?=$this->lang->line('head_content+gallery')?></h1>

<?
 $gallery_items  = array();
 foreach($this->model_gallery->get_gallery_cat() as $gallery_item){
  $gallery_items [(int)$gallery_item['parent_id']][$gallery_item['gallery_cat_id']] = $gallery_item;
 }

function gal_opt_tree($id_=0,$gallery_items,$currentitem="",$deep=0) {
 if (is_array(@$gallery_items[@$id_]))
 foreach($gallery_items[$id_] as $gallery_item)
  if (empty($currentitem) or $currentitem['gallery_cat_id'] != $gallery_item['gallery_cat_id']) {
  echo '
   	<option value="'.$gallery_item['gallery_cat_id'].'" '.
	  ((isset($currentitem['parent_id']) and $currentitem['parent_id']==$gallery_item['gallery_cat_id'])?'selected':'').
	 '>'.str_repeat("&nbsp;",$deep*2).$gallery_item['title'].'</option>
';
  gal_opt_tree($gallery_item['gallery_cat_id'],$gallery_items,$currentitem,$deep+1);
  }
}
?>

<div class="hid_conteiner">
<div id="hid">
<p class=msg><?=$this->session->flashdata('msg')?>&nbsp;</p>
</div>
</div>


<form method="POST">

<? if($this->model_gallery->field_active('alias')){ ?>
<?/*    ------------------- Alias  ---------------------------    */?>
<? $field = "alias";?>
 <p><label class="req"><?=$this->lang->line('form_'.$field)?><br/>
 <input type="text" name="<?=$field?>" class="input-text-02" size=50 value="<?=isset($item[$field])?htmlspecialchars($item[$field]):"";?>"></label>
 <? if($this->session->userdata('admin')==1){ ?><a href="/_admin/gallery/delete_field/alias"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>

<?/*    ------------------- Название  ---------------------------    */?>
<? $field = "title";?>
 <p><label class="req"><?=$this->lang->line('form_'.$field)?><br/>
 <input type="text" name="<?=$field?>" class="input-text-02" size=50 value="<?=isset($item[$field])?htmlspecialchars($item[$field]):"";?>"></label>
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


 <? if($this->model_gallery->field_active('title_window')){ ?>
<?/*    ------------------- Заголовок  ---------------------------    */?>
<? $field = "title_window";?>
 <p><label class="req"><?=$this->lang->line('form_'.$field)?><br/>
 <input type="text" name="<?=$field?>" class="input-text-02" size=50 value="<?=isset($item[$field])?htmlspecialchars($item[$field]):"";?>"></label>
 <? if($this->session->userdata('admin')==1){ ?><a href="/_admin/gallery/delete_field/title_window"><img src="design/ico-delete.gif" border="0"></a><? } ?>
  <? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('title_window')">Добавить</a></p>
<div id="title_window">
<?=langselect('lang_title_window');?>
<input type="text" class="input-text-02" size="50" name="lang_title_window_text_en" id="lang_title_window_text_en" value="<?=lang_text_translation('title_window',$item_lang,'en');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_title_window_text_uk" id="lang_title_window_text_uk" value="<?=lang_text_translation('title_window',$item_lang,'uk');?>">
<input type="hidden" class="input-text-02" size="50" name="lang_title_window_text_be" id="lang_title_window_text_be" value="<?=lang_text_translation('title_window',$item_lang,'be');?>">
</div>
<? }else{ ?></p><? } ?>
<? } ?>

<?/*    ------------------- Родительская галерея ---------------------------    */?>
<p><label class="req"><?=$this->lang->line('gallery_cat_parent')?></label><br />

<select name="parent_id">
<option value="">---</option>
<? gal_opt_tree(0,$gallery_items,isset($item)?$item:""); ?>
</select>
</p>

 <? if($this->model_gallery->field_active('body')){ ?>
<p>
<label class="req" for="text"><strong>Text</strong></label>
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/gallery/delete_field/body"><img src="design/ico-delete.gif" border="0"></a><? } ?><br />
<textarea class="input-text" name="body" cols=100 rows=30><?=isset($item['body'])?htmlspecialchars($item['body']):"";?></textarea>
<?=fckeditor('body');?>
<? if(isset($item_lang)){ ?>
<br />
На других языках: <a href="javascript:void();" onclick="javascript:showblock('body')">Добавить</a></p>
<div id="body">
<?=langselect('lang_body');?><br />
<div id="div_lang_body_text_en" style="display:block">
<textarea class="input-text" name="lang_body_text_en" id="lang_body_text_en" cols="100" rows="30"><?=lang_text_translation('body',$item_lang,'en');?></textarea>
<?=fckeditor('lang_body_text_en');?>
</div>
<div id="div_lang_body_text_uk" style="display:none">
<textarea class="input-text" name="lang_body_text_uk" id="lang_body_text_uk" cols="100" rows="30"><?=lang_text_translation('body',$item_lang,'uk');?></textarea>
<?=fckeditor('lang_body_text_uk');?>
</div>
<div id="div_lang_body_text_be" style="display:none">
<textarea class="input-text" name="lang_body_text_be" id="lang_body_text_be" cols="100" rows="30"><?=lang_text_translation('body',$item_lang,'be');?></textarea>
<?=fckeditor('lang_body_text_be');?>
</div>
</div>
<? }else{ ?></p><? } ?>
<? } ?>


<div class="box-01">
   <input type="submit" class="input-submit" name="save" value="<?=$this->lang->line('submit_edit')?>"/>
   <input type="reset" class="input-submit" name="reset" value="<?=$this->lang->line('reset')?>"/>
   <input type="button" class="input-submit" name="cancel" onclick="history.back(-1)" value="<?=$this->lang->line('cancel')?>"/>
</div>
</form>

<? if (isset($item)):?>
	<script type="text/javascript" src="js/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="js/ui/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="js/ui/jquery.ui.sortable.js"></script>
<script type="text/javascript">
	$(function() {
		$("#sortable").sortable({
			revert: true,
			stop: function(event, ui) {
			 $('.msg').load('gallery/pos',{post:$("#sortable").sortable('serialize')});
			 }
		});
		$("ul, li","#sortable").disableSelection();
		var slih=0;
		$("li","#sortable").each(function(){if ($(this).height()>slih) slih=$(this).height()});
		$("li","#sortable").height(slih);

	});
</script>

			<!-- Pagination (Top) -->
			<div class="pagination box">
				<p class="f-right">
				<?=$pagination;?>
				</p>
			</div> <!--  /pagination -->
			<!-- Button: Upload pictures -->
			<p class="box"><a href="javascript:void();" onclick="$('#upload').slideToggle('slow');" class="btn-create"><span><?=$this->lang->line('upload pictures')?></span></a></p>
			<!-- Upload -->
			<div id="upload" class="box-01" style="display:none;">
				<form action="gallery/upload" method="post"  enctype='multipart/form-data'>
					<div id="moreupload">
                    <p class="nom"><label class="req" for="name"><?=$this->lang->line('form_file_name')?></label><br /><input type="text" class="input-text"  size="25" name="name[]" value=""><input type="file" size="30" name="userfile[]" class="input-text" /></p>
					</div>
					<p>
						<a class="ico-list" href="javascript:void();" onclick="addMore();"><?=$this->lang->line('upload_more')?></a>
					</p>
					<p class="nom"><br />
						<input type="hidden" name="gallery_cat_id"  value="<?=$item['gallery_cat_id']?>"/>
						<input type="submit" value="<?=$this->lang->line('upload')?>" class="input-submit" />
						<input type="reset" value="<?=$this->lang->line('clear')?>" class="input-submit" />
					</p>
				</form>
			</div> <!-- /upload -->
			<!-- Actions -->
			<form action="gallery/perpage_pagin/<?=$item['gallery_cat_id']?>" method="post">
			<div class="box-02 bottom box">
				<div class="f-right">
				<strong><?=$this->lang->line('show_per_page')?>:</strong>
					<select name="perpage" class="input-text" onchange="submit()">
						<!--<option value=""><?//=$this->lang->line('all')?></option> -->
						<option value="6" <?=($this->session->userdata('perpage')==6?"selected":"")?>>6</option>
						<option value="12" <?=($this->session->userdata('perpage')==12?"selected":"")?>>12</option>
						<option value="24" <?=($this->session->userdata('perpage')==24?"selected":"")?>>24</option>
						<option value="48" <?=($this->session->userdata('perpage')==48?"selected":"")?>>48</option>
					</select>
				</div> <!-- /f-right -->
				</form>
				<form action="gallery/actionwith_photo/<?=$item['gallery_cat_id']?>" method="post" onsubmit="return confirm('<?=$this->lang->line('are_you_sure')?>');">
				<table border="0" style="border:none">
					<tr>
						<td style="border:none" valign="middle">
				<strong><?=$this->lang->line('action')?>:</strong>
				<select name="action" class="input-text" onchange="if (this.value=='copy_selected' || this.value=='move_selected'){$('#cat_id').show('slow');}else{$('#cat_id').hide('200');}">
					<option value=""><?=$this->lang->line('make_a_choice')?></option>
					<option value="del_selected"><?=$this->lang->line('del_selected_photo')?></option>
					<option value="disable_selected"><?=$this->lang->line('disable_selected_photo')?></option>
					<option value="enable_selected"><?=$this->lang->line('enable_selected_photo')?></option>
					<option value="copy_selected"><?=$this->lang->line('copy_selected_photo_to')?></option>
					<option value="move_selected"><?=$this->lang->line('move_selected_photo_to')?></option>
				</select>
						</td>
						<td style="border:none"  valign="middle">
				<select name="move_cat_id" class="input-text" id="cat_id" style="display:none;">
<?/*					<? foreach ($this->model_gallery->get_gallery_cat() as $cat):?>
						<option value="<?=$cat['gallery_cat_id']?>"><?=$cat['title']?></option>
					<? endforeach;?>
*/
gal_opt_tree(0,$gallery_items);


?>
				</select>
						</td>
						<td style="border:none"  valign="middle">
				<input type="submit" value="OK" />
						</td>
					</tr>
				</table><br />
		<label><input type="checkbox" name="set" onclick="setChecked(this)" />
     <span id="text"><?=$this->lang->line('mark');?></span></label>
			</div> <!-- /box-02 -->
			<script type="text/javascript">
			function setChecked(obj)
			   {
			   var str = document.getElementById("text").innerHTML;
			   str = (str == "<?=$this->lang->line('mark');?>" ? "<?=$this->lang->line('unmark');?>" : "<?=$this->lang->line('mark');?>");
			   document.getElementById("text").innerHTML = str;
			   var check = document.getElementsByName("photo_id[]");
			   for (var i=0; i<check.length; i++)
				  {
				  check[i].checked = obj.checked;
				  }
			   }
		   	function addMore(){
			$('#moreupload').append('<p class=\"nom\"><input type=\"text\" class=\"input-text\"  size=\"25\" name=\"name[]\"><input type=\"file\" size=\"30\" name=\"userfile[]\" class=\"input-text\" /></p>');
			}
			</script>
			<ul id="sortable" title="<?=$this->lang->line("tip_pos_change");?>">
			<? foreach ($this->model_gallery->get_gallery_photos($item['gallery_cat_id'],$page) as $item_photo) :?>
            <!-- Gallery (Item) -->
			<li class="gallery ui-state-default" <?=($item_photo['enable']=='Y'?'':'style="background-color:#ffdbdb"')?> id="pos_<?=$item_photo['photo_id']?>">
				<p>
					<label><input name="photo_id[]" id="id_<?=$item_photo['photo_id']?>" value="<?=$item_photo['photo_id']?>" type="checkbox" />
                <span title="POS: <?=$item_photo['pos']?>"><?=$item_photo['photo_id']?>:</span>
                <?=htmlspecialchars($item_photo['name'])?><br> <a href="javascript:void()" onclick="$('#inner_form_<?=$item_photo['photo_id']?>').slideToggle('slow'); document.getElementById('id_<?=$item_photo['photo_id']?>').checked=true;" class="ico-edit"><?=$this->lang->line('edit_photo')?></a>
              </label>
              <code>
					<div style="position:absolute; z-index:20; background:#b3ccdd; border:#fb8585 solid 1px; padding:5px; display:none" id="inner_form_<?=$item_photo['photo_id']?>">
						<label><?=$this->lang->line('new_name')?></label><br />
						<input name="newname[<?=$item_photo['photo_id']?>]" value="" style="border:#fb8585 solid 1px; width:150px; margin:3px"/><br>
						<input type="submit" value="<?=$this->lang->line('correct_photo_name')?>" style="margin:3px" /><br />
						<a href="javascript:void()" onclick="$('#inner_form_<?=$item_photo['photo_id']?>').slideToggle('slow'); document.getElementById('id_<?=$item_photo['photo_id']?>').checked=false" class="ico-delete"><?=$this->lang->line('cancel')?></a>
					</div>
					</code>
                    
					<span class="smaller">
					<?=$this->lang->line('size');?>: <strong><?=$item_photo['width']?>&times;<?=$item_photo['height']?></strong> <br> <?=$this->lang->line('modyfy_date')?>: <strong><?=$item_photo['modify']?></strong></span><br />
					<a href="/userfiles/<?=$item_photo['image']?><?=$item_photo['ext']?>" rel="lightbox" title="<?=htmlspecialchars($item_photo['name'])?>"><img src="/userfiles/<?=$item_photo['image']?>_thumb<?=$item_photo['ext']?>" class="gallery-img" alt="" height="130" /></a>
					<a href="gallery/delete_photo/<?=$item_photo['gallery_cat_id']?>/<?=$item_photo['photo_id']?>"  onclick="return confirm('<?=$this->lang->line('are_you_sure')?>');" class="ico-delete"><?=$this->lang->line('delete')?></a> &nbsp; <a href="gallery/<?=($item_photo['enable']=='Y'?'disable':'enable')?>_photo/<?=$item_photo['gallery_cat_id']?>/<?=$item_photo['photo_id']?>" class="ico-edit"><?=$this->lang->line($item_photo['enable']=='Y'?'disable_photo':'enable_photo')?></a> <!-- &nbsp; <a href="tmp/img-01.gif" rel="lightbox" class="ico-show">Detail</a> -->
				</p>
			</li>
            <!-- /gallery -->
            <? endforeach; ?>
</ul>
			</form>
			<div class="fix"></div>
			<!-- Actions -->
			<form action="gallery/perpage/<?=$item['gallery_cat_id']?>" method="post">
			<div class="box-02 bottom box">
				<div class="f-right">
				<strong><?=$this->lang->line('show_per_page')?>:</strong>
					<select name="perpage" class="input-text" onchange="submit()">
						<option value=""><?=$this->lang->line('all')?></option>
						<option value="6" <?=($this->session->userdata('perpage')==6?"selected":"")?>>6</option>
						<option value="12" <?=($this->session->userdata('perpage')==12?"selected":"")?>>12</option>
						<option value="24" <?=($this->session->userdata('perpage')==24?"selected":"")?>>24</option>
						<option value="48" <?=($this->session->userdata('perpage')==48?"selected":"")?>>48</option>
					</select>
				</div> <!-- /f-right -->
			</div> <!-- /box-02 -->
			</form>
			<!-- Pagination (Bottom) -->
			<div class="pagination box bottom">
				<p class="f-right">
				<?=$pagination;?>
				</p>
			</div>
<? endif; ?>
<?php include(APPPATH.'views/_footer.php'); ?>