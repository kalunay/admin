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
			 $('#hid').load('gallery/pos_cat',{post:$("#sortable").sortable('serialize')});
//			 window.setTimeout(reloadlist,1500);
			 }
		});
		$("tr","#sortable").disableSelection();

	});
</script>
<style>
 tr.sub { display:none}
 </style>


<h1><?=$this->lang->line('head_content+gallery')?></h1>
<table style="border:none"><tr><td style="border:none">
 <p><?=anchor("gallery/add/","<span>".$this->lang->line('add_gallery')."</span>",array('class'=>'btn-create'))?></p>
</td><td style="border:none">
<div class="hid_conteiner">
<div id="hid">
<p class="msg"><?=$this->session->flashdata('msg')?>&nbsp;</p>
</div>
</div>
</td></tr></table>
<? if (isset($items) and count($items)): ?>


<form action="gallery/actionwith_cat" method="post" onsubmit="return confirm('<?=$this->lang->line('are_you_sure')?>');">
<?/*<table class="tablesorter">*/?>
<table>
				<thead>
<tr>
<th class="">[x]</th>
<? /*<th class="header"><?=$this->lang->line('content+gallery-pos')?></th>*/ ?>
<th class="header"><?=$this->lang->line('content+gallery-id')?></th>
<th class="header headerSortUp"><?=$this->lang->line('content+gallery-title')?></th>
<th class="header"><img src="design/ico-template.gif" alt="<?=$this->lang->line('content+gallery-publish')?>"></th>
<th class="header"><?=$this->lang->line('content+gallery-date')?></th>
<th class="header"><?=$this->lang->line('content+gallery-edit')?></th>
</tr>
				</thead>
				<tfoot>
					<tr class="bg">
					    <td class="arrow-01" colspan="7">
						<select class="input-text" name="copy_dell_group">
							<option value=""><?=$this->lang->line('make_a_choice')?></option>
						    <option value="dell"><?=$this->lang->line('del_selected')?></option>
 						    <option value="disable"><?=$this->lang->line('disable_selected')?></option>
							<option value="enable"><?=$this->lang->line('enable_selected')?></option>
						</select> <input type="submit" value="OK"/></td>
					</tr>
				</tfoot>
				<tbody id="sortable">


<? function get_rows($id_=0,$theall,$items,$deep=0) { ?>
 <? if (is_array(@$items[@$id_])):?>
 <? foreach($items[$id_] as $id => $item): ?>
 <tr id="pos_<?=$id?>" parent="<?=$id_?>" <?=$deep?'class="sub"':"style='background-color:#eeeeee'";?>>
 <td class="t-center"><input type="checkbox" name="gallery_cat_id[]" value="<?=$item['gallery_cat_id']?>"/></td>
<? /*  <td class="t-center pos"><?=$item['pos']?></td>*/?>
  <td class="t-center"><?=($item['parent_id']?$item['parent_id']."&gt;":"").$id?></td>
  <td <?=$deep?'style="padding-left:'.($deep*10).'px;font-size:'.(100-($deep*5)).'%"':"";?>>
   <? if (isset($items[$id])): ?>
<? /* show toggle hide не работает в ИЕ для tr*/?>   
    <a href="" onclick="if($('tr[parent=<?php echo $id; ?>].sub').length ) { $('tr[parent=<?php echo $id; ?>]').removeClass('sub');} 
      else  {$('tr[parent=<?php echo $id; ?>]').addClass('sub');}  return false" title="<?=htmlspecialchars($theall->lang->line('show_childs'), ENT_QUOTES)?>">
   <? endif; ?>
   <?=$item["title"]?>
   <? if (isset($items[$id])): ?>
  </a>
   <? endif; ?>
  &nbsp;&nbsp;
  </td>
  <td class="t-center"><a href="gallery/<?=$item['enable']=='Y'?"disable":"enable"?>_gallery_cat/<?=$item['gallery_cat_id']?>"><img src="design/ico-<?=$item['enable']=='Y'?"done":"delete"?>.gif" border="0"></a></td>
  <td class="t-center"><?=$item['modify']?></td>
  <td>
   <?=anchor('gallery/edit/'.$id,$theall->lang->line('edit'),array('class'=>'ico-edit'))?>
   <?=anchor('gallery/delete/'.$id,$theall->lang->line('delete'),
   array('class'=>'ico-delete',"onclick"=>"return confirm('".htmlspecialchars($theall->lang->line("confirm_delete")." ".$item["title"])."?')", ENT_QUOTES))?>
  </td>

 </tr>
   <? if(isset($items[$id])): ?>
   <?=get_rows($id,$theall,$items,$deep+1)?>
   <? endif; ?>
 <? endforeach; ?>
 <? endif; ?>
 <? } ?>

 <?=get_rows(0,$this,$items);?>



</tbody>
</table>
</form>
<? else: ?>
<?=$this->lang->line("cat_none");?>
<? endif;?>

  <p><?=anchor("gallery/add/","<span>".$this->lang->line('add_gallery')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>