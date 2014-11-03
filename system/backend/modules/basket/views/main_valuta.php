<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=$this->lang->line('module_valuta_name')?></h1>
<p class=msg><?=$this->session->flashdata('msg')?>&nbsp;</p>
<table class="tablesorter">
				<thead>
<tr>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_name_n')?></th>
<th class="header"><?=$this->lang->line('head_name_k')?></th>
<th class="header"><?=$this->lang->line('head_value')?></th>
<th class="header"><img src="design/ico-template.gif" alt="<?=$this->lang->line('head_enable')?>"></th>
<th class="header"><?=$this->lang->line('head_edit')?></th>
</tr>
				</thead>
				<tbody>


<? foreach($list as $i): ?>
<tr>
<td class="t-center"><?=$i['id']?></td>
<td><?=$i['name']?></td>
<td class="t-center"><?=$i['name_k']?></td>
<td class="t-center"><?=$i['value']?></td>
<td class="t-center"><img src="design/ico-<?=$i['now']==1?"done":"delete"?>.gif"></td>
<td class="t-center">
<?=anchor("basket/valuta/edit/".$i['id'],$this->lang->line('edit'),array('class'=>'ico-edit'))?> 
<?=anchor("basket/valuta/delete/".$i['id'],
 '<img alt="'.$this->lang->line('delete').'" class="ico" src="design/ico-delete.gif"/>',array('onclick'=>'return confirm(\'Уверены?\')'))?>
</td>
</tr>
<? endforeach; ?>

                </tbody>
			</table>
  <p><?=anchor("basket/valuta/add","<span>".$this->lang->line('addvaluta')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>