<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action)?$this->lang->line('title_'.$action.'_news'):""?></h1>

<form method="POST" enctype='multipart/form-data'>

<p><label class="req" for="datetime"><?=$this->lang->line('form_date')?></label>: <?=isset($item['datetime'])?$item['datetime']:date('Y-m-d H:i:s')?></p>
<p><label class="req" for="name"><?=$this->lang->line('form_keygen')?></label>: <?=isset($item['keygen'])?$item['keygen']:""?></p>








<? if(isset($item['object_id']) && $item['object_id']!=''){ /////////////////////////////////////////////?>
<fieldset>
	<legend>Перечень заказанных объектов</legend>
	<table border='1' width="600" cellpadding="2" cellspacing="0">
	<tr>
		<td align="center"><strong>Наименование</strong></td>
		<td align="center"><strong>Цена (групповое обучение)</strong></td>
		<td align="center"><strong>Цена (индивидуальное обучение)</strong></td>
	</tr>
	<?
	$obid = split('-',$item['object_id']);
	$ib=0;
	$ab=0;
	$sum_group=0;
	$sum_individual=0;
	while(isset($obid[$ib])){
		$ab = 0+$obid[$ib];
		if($ab!=0){
	?>	
	<? foreach($this->model_basket->selectObjectsZakaz($ab) as $soz){ ?>
		<tr>
		<td valign="top"><?=$soz['name']?></td>
		<td align="center"><?=$this->model_basket->selectPriceGroup($soz['id'])?></td>
		<td align="center"><?=$this->model_basket->selectPriceIndividual($soz['id'])?></td>
		</tr>
<?  
$sum_group += $this->model_basket->selectPriceGroup($soz['id']);
$sum_individual += $this->model_basket->selectPriceIndividual($soz['id']);
	}} $ib++; } ?>
	<tr>
		<td align="center"><strong>Всего</strong></td>
		<td align="center"><strong><?=$sum_group?></strong></td>
		<td align="center"><strong><?=$sum_individual?></strong></td>
	</tr>
	</table><br /><br />
	<strong>К оплате : <?=(isset($item['description']) && strstr($item['description'],'групп')?$this->model_basket->converterValuta($sum_group):(isset($item['description']) && strstr($item['description'],'индивидуал')?$this->model_basket->converterValuta($sum_individual):'необходимо выбрать форму обучения'))?></strong>
</fieldset>
<? } ///////////////////////////////////////////////////////////////// ?>






<p><label class="req" for="name"><?=$this->lang->line('form_object')?></label><br /> 
<select multiple size="5" name="object_id[]" style="width:300px;">
<option value="0">не задано</option>
<? if($this->model_basket->selectObjects()){ 
	foreach($this->model_basket->selectObjects() as $so){ ?>
	<option value="<?=$so['id']?>" <?=(isset($item['object_id']) && strstr($item['object_id'],$so['id'].'-')?'selected':'')?>><?=$so['name']?></option>
<? }} ?>
</select>
</p>

<p><label class="req" for="name"><?=$this->lang->line('form_user')?></label><br /> 

<select name="user_id" style="width:300px;">
<option value="0">не задано</option>
<? if($this->model_basket->selectUser()){ 
	foreach($this->model_basket->selectUser() as $so){ ?>
	<option value="<?=$so['id']?>" <?=(isset($item['user_id']) && $item['user_id']==$so['id']?'selected':'')?>><?=$so['name']?></option>
<? }} ?>
</select>
</p>

<? if($this->model_basket->field_active('name')){ ?>
<p><label class="req" for="name"><?=$this->lang->line('form_name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=isset($item['name'])?$item['name']:""?>">
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/basket/delete_field/name"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>

<p><label class="req" for="name"><?=$this->lang->line('form_email')?></label><br /><input type="text" class="input-text-02" size="50" name="email" value="<?=isset($item['email'])?$item['email']:""?>"></p>

<? if($this->model_basket->field_active('phone')){ ?>
<p><label class="req" for="phone"><?=$this->lang->line('form_phone')?></label><br /><input type="text" class="input-text-02" size="50" name="phone" value="<?=isset($item['phone'])?$item['phone']:""?>">
<? if($this->session->userdata('admin')==1){ ?><a href="/_admin/basket/delete_field/phone"><img src="design/ico-delete.gif" border="0"></a><? } ?></p>
<? } ?>

<p>
<label class="req" for="text"><strong><?=$this->lang->line('form_description')?></strong></label><br />
<textarea class="input-text" name="description" cols=100 rows=30><?=isset($item['description'])?$item['description']:""?></textarea>
<?=fckeditor('description');?>
</p>

<p><label class="req" for="name"><?=$this->lang->line('form_status')?></label><br />
<select name="status" style="width:200px;">
<option value="1" <?=(isset($item['status']) && $item['status']==1?'selected':'')?>>новичёк</option>
<option value="2" <?=(isset($item['status']) && $item['status']==2?'selected':'')?>>в обработке</option>
<option value="3" <?=(isset($item['status']) && $item['status']==3?'selected':'')?>>выполнен</option>
</select>
</p>

<p>
<strong><?=$this->lang->line('form_active')?><br /></strong>
<label><input type="radio" name="active" value="1"<?=(empty($item['active']) or $item['active']==1)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_yes')?></label>
<label><input type="radio" name="active" value="0"<?=(isset($item['active']) and $item['active']==0)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_no')?></label>
</p>


<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>