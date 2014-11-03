<?php include(APPPATH.'views/_header.php'); ?>

	<script type="text/javascript" src="js/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="js/ui/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="js/ui/jquery.ui.sortable.js"></script>
	
	<script type="text/javascript">
//	function reloadlist() {
//	 location.reload();
//	}
	$(function() {
		$("#sortable").sortable({
			revert: true,
			items: 'tr',
			stop: function(event, ui) {
			 $('#hid').load('pages/pos_cat',{post:$("#sortable").sortable('serialize')});
//			 window.setTimeout(reloadlist,1500);
			 }
		});
		$("tr","#sortable").disableSelection();

	});
</script>
<style>
 tr.sub { display:none}
 </style>


<h1><?=$this->lang->line('module_name')?></h1>

<p class=msg><?=$this->session->flashdata('msg')?>&nbsp;</p>
<form action="catalog/copydellgroup" method="post" onsubmit="return confirm('<?=$this->lang->line('action_confirm')?>');">
<table class="tablesorter">
				<thead>
<tr>
<th class="">[x]</th>
<th class="header"><?=$this->lang->line('head_id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('head_name')?></th>
<th class="header"><?=$this->lang->line('head_alias')?></th>
<th class="header"><img src="design/ico-template.gif" alt="<?=$this->lang->line('head_enable')?>"></th>
<th class="header"><?=$this->lang->line('head_modified')?></th>
<th class="header"><?=$this->lang->line('head_image')?></th>
<th class="header"><?=$this->lang->line('head_pos')?></th>
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
				<tbody id="sortable">


<? if($list){ ?>

<? function get_rows($image_path,$id_=0,$theall,$items,$deep=0) { ?>
 <? if (is_array(@$items[@$id_])):?>
 <? foreach($items[$id_] as $id => $item): ?>
 <tr id="pos_<?=$id?>" parent="<?=$id_?>" <?=$deep?'class="sub"':"style='background-color:#eeeeee'";?>>
 <td class="t-center"><input type="checkbox" name="id[]" value="<?=$item['id']?>"/></td>
<? /*  <td class="t-center pos"><?=$item['pos']?></td>*/?>
  <td class="t-center"><?=($item['parent_id']?$item['parent_id']."&gt;":"").$id?></td>
  <td <?=$deep?'style="padding-left:'.($deep*10).'px;font-size:'.(100-($deep*5)).'%"':"";?>>
   <? if (isset($items[$id])): ?>
<? /* show toggle hide не работает в ИЕ для tr*/?>   
    <a href="" onclick="if($('tr[parent=<?php echo $id; ?>].sub').length ) { $('tr[parent=<?php echo $id; ?>]').removeClass('sub');} 
      else  {$('tr[parent=<?php echo $id; ?>]').addClass('sub');}  return false" title="<?=htmlspecialchars($theall->lang->line('show_childs'), ENT_QUOTES)?>">
   <? endif; ?>
   <?=$item["name"]?>
   <? if (isset($items[$id])): ?>
  </a>
   <? endif; ?>
  &nbsp;&nbsp;
  </td>
  <td class="t-center"><?=$item['alias']?></td>
  <td class="t-center"><img src="design/ico-<?=$item['publish']==1?"done":"delete"?>.gif" border="0"></td>
  <td class="t-center"><?=date('Y-m-d H:i:s',$item['modify'])?></td>
  <td class="t-center"><? if (isset($item['image']) and $item['image']):?>
 <a href='<?=$image_path.$item['image']?>' target="_blank"><img src="<?=$image_path.$item['image']?>" height="30"></a><?endif;?></td>
  <td class="t-center"><?=$item['pos']?></td>
  <td>
   <?=anchor('catalog/edit/'.$id,$theall->lang->line('edit'),array('class'=>'ico-edit'))?><br />
   <?=anchor('catalog/delete/'.$id,$theall->lang->line('delete'),
   array('class'=>'ico-delete',"onclick"=>"return confirm('".htmlspecialchars($theall->lang->line("confirm_delete")." ".$item["title"])."?')", ENT_QUOTES))?>
  <br />
  <?=anchor('catalog/objects/list/'.$id,$theall->lang->line('editobject'),array('class'=>'ico-edit'))?>
  </td>

 </tr>
   <? if(isset($items[$id])): ?>
   <?=get_rows($image_path,$id,$theall,$items,$deep+1)?>
   <? endif; ?>
 <? endforeach; ?>
 <? endif; ?>
 <? } ?>

 <?=get_rows($image_path,0,$this,$list);?>
 
 <? } ?>

                </tbody>
			</table>
</form>
  <p><?=anchor("catalog/add/","<span>".$this->lang->line('add')."</span>",array('class'=>'btn-create'))?></p>
  <p><?=anchor("catalog/adddopfield/","<span>".$this->lang->line('adddopfield')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>