<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('title_settings')?></h1>

<form action="settings/edit" method="POST" enctype='multipart/form-data'>


<p><label class="req" for="email"><?=$this->lang->line('form_email')?></label><br />
<input type="email" class="input-text-02" size="50" name="email" value="<?=isset($item['email'])?$item['email']:""?>">
</p>




<? if($this->model_settings->field_active('image')){ ?>
<p><label class="req" for="userfile">
 <?=$this->lang->line('form_image')?>
 <? if (isset($item['image']) and $item['image']) 
 list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'].$image_path.$item['image']);
 echo "<br /><a href='".$image_path.$item['image']."' target=_blank><img src=\"".$image_path.$item['image']."\" ".($height>200?"height='200'":'')."></a> <a href='settings/deletephoto/".$item['id']."'>[ delete ]</a>";
?>
</label><br /><input type="file" class="input-text-02" size="50" name="userfile" >
<? if($this->session->userdata('admin')==1 && !isset($item)){ ?><a href="/_admin/settings/delete_field/image"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>


<p><label class="req" for="email"><?=$this->lang->line('form_mailer')?></label></p>
<? if($mailer){ ?>
<select name="mailer" multiple size="10">
<? foreach($mailer as $mr){ ?>
	<option value="<?=$mr['mail']?>"><?=$mr['mail']?></option>
<? } ?>
</select>
<? } ?>



<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_edit')?>">
<?=anchor("settings/adddopfield/","<span>".$this->lang->line('adddopfield')."</span>",array('class'=>'btn-create'))?>
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>