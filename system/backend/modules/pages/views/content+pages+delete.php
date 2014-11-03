<?php include(APPPATH.'views/_header.php'); ?>

<h2><?=$this->lang->line('head_content+pages')?></h2>


<form method="POST" enctype="multipart/form-data">

<p><label class="req" for="title"><?=$this->lang->line('name')?></label><br /><input type="text" class="input-text-02" size="50" name="name" value="<?=$item['name']?>"></p>




<input type="hidden" name="page_id" value="<?=$item['page_id']?>">

<div class="box-01">
<input type="submit" class="input-submit" name="delete" value="<?=$this->lang->line('submit_delete')?>">
</div>


</form>

<?php include(APPPATH.'views/_footer.php'); ?>