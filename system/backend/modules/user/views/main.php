<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('module_name')?></h1>
<p class=msg><?=$this->session->flashdata('msg')?>&nbsp;</p>
<form action="user/copydellgroup" method="post" onsubmit="return confirm('<?=$this->lang->line('action_confirm')?>');">
<table class="tablesorter">
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_name')?></th>
<th class="header"><?=$this->lang->line('head_email')?></th>
<th class="header"><img src="design/ico-template.gif" alt="<?=$this->lang->line('head_enable')?>"></th>
<th class="header"><?=$this->lang->line('head_modified')?></th>
<th class="header"><?=$this->lang->line('head_group')?></th>
<th class="header"><?=$this->lang->line('head_login')?></th>
<th class="header"><?=$this->lang->line('head_password')?></th>
<th class="header"><?=$this->lang->line('head_keygen')?></th>
<? if($this->model_user->field_active('image')){ ?>
<th class="header"><?=$this->lang->line('head_image')?></th>
<? } ?>
<th class="header"><?=$this->lang->line('head_edit')?></th>
</tr>
				</thead>
				<tfoot>
					<tr class="bg">
					    <td class="arrow-01" colspan="12">
						<select class="input-text" name="copy_dell_group">
						    <option value="del">Удалить выбранное</option>
						</select> <input type="submit" value="OK"/></td>
					</tr>
				</tfoot>
				<tbody>


<? if($list){ foreach($list as $i): ?>
<tr>
<td class="t-center"><input type="checkbox" name="id[]" value="'<?=$i['id']?>'"/></td>
<td class="t-center"><?=$i['id']?></td>
<td><?=$i['name']?></td>
<td><?=$i['email']?></td>
<td class="t-center"><img src="design/ico-<?=$i['active']==1?"done":"delete"?>.gif"></td>
<td class="t-center"><?=$i['date']?></td>
<td class="t-center"><?=$this->model_user->getNameGroup($i['group_usr']);?></td>
<td class="t-center"><?=$i['login']?></td>
<td class="t-center"><?=$i['password']?></td>
<td class="t-center"><?=$i['keygen']?></td>
<? if($this->model_user->field_active('image')){ ?>
<td class="t-center"><? if (isset($i['image']) and $i['image']):?>
 <a href='<?=$image_path.$i['image']?>' target="_blank"><img src="<?=$image_path.$i['image']?>" height="50"></a><?endif;?></td>
 <? } ?>
<td class="t-center">
<?=anchor("user/edit/".$i['id'],$this->lang->line('edit'),array('class'=>'ico-edit'))?> 
<?=anchor("user/delete/".$i['id'],
 '<img alt="'.$this->lang->line('delete').'" class="ico" src="design/ico-delete.gif"/>',array('onclick'=>'return confirm(\'Уверены?\')'))?>
</td>
</tr>
<? endforeach; } ?>

                </tbody>
			</table>
</form>

<?=$pagination_link;?>

  <p><?=anchor("user/add/","<span>".$this->lang->line('add')."</span>",array('class'=>'btn-create'))?></p>
  <p><?=anchor("user/addgroupus/","<span>".$this->lang->line('addgroup')."</span>",array('class'=>'btn-create'))?></p>
  <p><?=anchor("user/adddopfield/","<span>".$this->lang->line('adddopfield')."</span>",array('class'=>'btn-create'))?></p>
  <p><?=anchor("user/alllist/","<span>".$this->lang->line('alllist')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>