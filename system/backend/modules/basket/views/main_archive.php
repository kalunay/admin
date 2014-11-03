<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('module_name')?></h1>
<p class=msg><?=$this->session->flashdata('msg')?>&nbsp;</p>
<form action="basket/copydellgroup" method="post" onsubmit="return confirm('<?=$this->lang->line('action_confirm')?>');">
<table class="tablesorter">
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_name')?></th>
<th class="header"><?=$this->lang->line('head_email')?></th>
<th class="header"><?=$this->lang->line('head_date')?></th>
<th class="header"><?=$this->lang->line('head_modified')?></th>
<th class="header"><?=$this->lang->line('head_status')?></th>
<th class="header"><?=$this->lang->line('head_edit')?></th>
</tr>
				</thead>
				<tfoot>
					<tr class="bg">
					    <td class="arrow-01" colspan="9">
						<select class="input-text" name="copy_dell_group">
						    <option value="del">Удалить выбранное</option>
						</select> <input type="submit" value="OK"/></td>
					</tr>
				</tfoot>
				<tbody>


<? foreach($list as $i): ?>
<tr>
<td class="t-center"><input type="checkbox" name="id[]" value="'<?=$i['id']?>'"/></td>
<td class="t-center"><?=$i['id']?></td>
<td><?=($i['name']!=''?$i['name']:(isset($i['user_id']) && $i['user_id']!=0?$this->model_basket->getUserName($i['user_id']):'не задано'))?></td>
<td class="t-center"><?=$i['email']?></td>
<td class="t-center"><?=$i['datetime']?></td>
<td class="t-center"><?=date('Y-m-d H:i:s',$i['modify'])?></td>
<td class="t-center"><?=($i['status']==1?'<span style="color:red;">новый</span>':($i['status']==2?'<span style="color:green;">в обработке</span>':($i['status']==3?'<span style="color:grey;">выполнен</span>':'')))?></td>
<td class="t-center">
<?=anchor("basket/edit/".$i['id'],$this->lang->line('edit'),array('class'=>'ico-edit'))?> 
<?=anchor("basket/delete/".$i['id'],
 '<img alt="'.$this->lang->line('delete').'" class="ico" src="design/ico-delete.gif"/>',array('onclick'=>'return confirm(\'Уверены?\')'))?>
</td>
</tr>
<? endforeach; ?>

                </tbody>
			</table>
</form>
<?=(isset($pagination_link)?$pagination_link:'')?>

  <p><?=anchor("basket","<span>".$this->lang->line('new')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>