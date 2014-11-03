<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('module_name')?></h1>
<p class=msg><?=$this->session->flashdata('msg')?>&nbsp;</p>


<script type="text/javascript">

function changeallselect(){

<? foreach($list as $i): ?>

if(document.getElementById('checkbox<?=$i['id']?>').checked==true){ document.getElementById('checkbox<?=$i['id']?>').checked=false; }else{ document.getElementById('checkbox<?=$i['id']?>').checked=true; }

<? endforeach; ?>

}

</script>

<?=(isset($pagination_link)?$pagination_link:'')?>
<form action="guestbook/copydellgroup" method="post" onsubmit="return confirm('<?=$this->lang->line('action_confirm')?>');">
<table class="tablesorter">
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_name')?></th>
<th class="header"><img src="design/ico-template.gif" alt="<?=$this->lang->line('head_enable')?>"></th>
<th class="header"><?=$this->lang->line('head_date')?></th>
<th class="header"><?=$this->lang->line('head_edit')?></th>
</tr>
				</thead>
				<tfoot>
					<tr class="bg">
					    <td class="arrow-01" colspan="8">
						<input type="checkbox" name="allselect" id="selectall" onclick="javascript:changeallselect();"> выделить всё <br /><br />
						<select class="input-text" name="copy_dell_group">
						    <option value="del">Удалить выбранное</option>
						</select> <input type="submit" value="OK"/></td>
					</tr>
				</tfoot>
				<tbody>


<? foreach($list as $i): ?>
<tr>
<td class="t-center"><input type="checkbox" id="checkbox<?=$i['id']?>" name="id[]" value="<?=$i['id']?>"/></td>
<td class="t-center"><?=$i['id']?></td>
<td><?=$i['name']?></td>
<td class="t-center"><img src="design/ico-<?=$i['publish']==1?"done":"delete"?>.gif"></td>
<td class="t-center"><?=$i['date']?></td>
<td class="t-center">
<?=anchor("guestbook/edit/".$i['id'],$this->lang->line('edit'),array('class'=>'ico-edit'))?> 
<?=anchor("guestbook/delete/".$i['id'],
 '<img alt="'.$this->lang->line('delete').'" class="ico" src="design/ico-delete.gif"/>',array('onclick'=>'return confirm(\'Уверены?\')'))?>
</td>
</tr>
<? endforeach; ?>

                </tbody>
			</table>
</form>
<?=(isset($pagination_link)?$pagination_link:'')?>

<?php include(APPPATH.'views/_footer.php'); ?>