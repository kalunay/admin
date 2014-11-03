<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('module_name_group')?></h1>
<p class="msg"><?=$this->session->flashdata('msg')?>&nbsp;</p>
<form action="user/addgroupus/copydellgroup" method="post" onsubmit="return confirm('<?=$this->lang->line('action_confirm')?>');">
<table>
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header"><?=$this->lang->line('head_name')?></th>
<th class="header"><?=$this->lang->line('head_edit')?></th>
</tr>
				</thead>
				<tfoot>
					<tr class="bg">
					    <td class="arrow-01" colspan="8">
						<select class="input-text" name="copy_dell_group">
						    <option value="del">Удалить выбранное</option>
						</select> <input type="submit" value="OK"/></td>
					</tr>
				</tfoot>
				<tbody>


<? if($list_gus){ foreach($list_gus as $i): ?>
<tr>
<td class="t-center"><input type="checkbox" name="id[]" value="'<?=$i['id']?>'"/></td>
<td class="t-center"><?=$i['id']?></td>
<td><?=$i['name']?></td>
<td class="t-center">
<?=anchor("user/addgroupus/edit/".$i['id'],$this->lang->line('edit'),array('class'=>'ico-edit'))?> 
<?=anchor("user/addgroupus/delete/".$i['id'],
 '<img alt="'.$this->lang->line('delete').'" class="ico" src="design/ico-delete.gif"/>',array('onclick'=>'return confirm(\'Уверены?\')'))?>
</td>
</tr>
<? endforeach; } ?>

                </tbody>
			</table>
</form>
  <p><?=anchor("user/addgroupus/add/","<span>".$this->lang->line('addgroupus')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>