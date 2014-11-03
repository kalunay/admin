<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('module_name_dopfield')?></h1>
<p class="msg"><?=$this->session->flashdata('msg')?>&nbsp;</p>
<form action="catalog/adddopfield/copydellgroup" method="post" onsubmit="return confirm('<?=$this->lang->line('action_confirm')?>');">
<table class="tablesorter">
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_name')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_type')?></th>
<th class="header"><img src="design/ico-template.gif" alt="<?=$this->lang->line('head_enable')?>"></th>
<th class="header"><?=$this->lang->line('head_pos')?></th>
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


<? if($list_dopfield){ foreach($list_dopfield as $i): ?>
<tr>
<td class="t-center"><input type="checkbox" name="id[]" value="'<?=$i['id']?>'"/></td>
<td class="t-center"><?=$i['id']?></td>
<td><?=$i['field']?></td>
<td><?=($i['type']=='inputtext'?'Строка':($i['type']=='textarea'?'Блок текста':($i['type']=='checkbox'?'Да/Нет':'')))?></td>
<td class="t-center"><img src="design/ico-<?=$i['publish']==1?"done":"delete"?>.gif"></td>
<td class="t-center"><?=$i['pos']?></td>
<td class="t-center">
<?=anchor("catalog/adddopfield/edit/".$i['id'],$this->lang->line('edit'),array('class'=>'ico-edit'))?> 
<?=anchor("catalog/adddopfield/delete/".$i['id'],
 '<img alt="'.$this->lang->line('delete').'" class="ico" src="design/ico-delete.gif"/>',array('onclick'=>'return confirm(\'Уверены?\')'))?>
</td>
</tr>
<? endforeach; } ?>

                </tbody>
			</table>
</form>
  <p><?=anchor("catalog/adddopfield/add/","<span>".$this->lang->line('adddopfield')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>