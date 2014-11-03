<?php include(APPPATH.'views/_header.php'); ?>

<h1><?=isset($action)?$this->lang->line('title_'.$action.'_news'):""?></h1>

<form method="POST" enctype='multipart/form-data'>

<p><label class="req" for="name"><?=$this->lang->line('form_name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=isset($item['name'])?$item['name']:""?>"></p>

<p><label class="req" for="email"><?=$this->lang->line('form_email')?></label><br /><input type="text" class="input-text-02" size="50" name="email" value="<?=isset($item['email'])?$item['email']:""?>"></p>

<p><label class="req" for="date"><?=$this->lang->line('form_date')?></label><br /><input type="text" class="input-text-02" size="50" name="date" value="<?=isset($item['date'])?$item['date']:date('Y-m-d')?>"></p>

<p>
<label class="req" for="text"><strong><?=$this->lang->line('form_text')?></strong></label><br />
<textarea class="input-text" name="text" cols=100 rows=30><?=isset($item['text'])?$item['text']:""?></textarea>
<?=fckeditor('text');?>
</p>

<p>
<label class="req" for="answer"><strong><?=$this->lang->line('form_answer')?></strong></label><br />
<textarea class="input-text" name="answer" cols=100 rows=30><?=isset($item['answer'])?$item['answer']:""?></textarea>
<?=fckeditor('answer');?>
</p>


<p>
<strong><?=$this->lang->line('form_enable')?><br /></strong>
<label><input type="radio" name="publish" value="1"<?=(empty($item['publish']) or $item['publish']==1)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_yes')?></label>
<label><input type="radio" name="publish" value="0"<?=(isset($item['publish']) and $item['publish']==0)?" checked=\"checked\"":""?>><?=$this->lang->line('form_enable_no')?></label>
</p>


<div class="box-01">
<input type="submit" class="input-submit" name="edit" value="<?=$this->lang->line('submit_'.(isset($action)?$action:'edit'))?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>