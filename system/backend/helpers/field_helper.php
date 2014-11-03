<?


function wr_input($name,$value='',$size=50,$tip=''){

  return '<p><label class="req" for="'.$name.'">'.get_instance()->lang->line('form_'.$name).'</label><br /><input type="text" class="input-text-02 '.(strstr($name,'date')?"datetime":"").'" size="'.$size.'" value="'.$value.'" name="'.$name.'"></p>';
}


function wr_textarea($name,$value='',$wysiwyg=0,$cols=100,$rows=10,$tip=''){
echo '
<p>
<label class="req" for="'.$name.'">'.get_instance()->lang->line('form_'.$name).'</label><br />
<textarea class="input-text" name="'.$name.'" cols='.$cols.' rows='.$rows.' >'.$value.'</textarea>
'.($wysiwyg==1?fckeditor($name):"").'
</p>
';

}