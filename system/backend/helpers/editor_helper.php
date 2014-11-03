<?php

function tinymce($area)
 {
  return '<script type="text/javascript" src="http://www.mamacholi.com/system/plugins/tinymce/tiny_mce.js"></script>
  <script type="text/javascript">tinyMCE.init({mode : "exact", elements : "'.$area.'"});</script>';
 }

 function fckeditor($area,$size=400)
 {
 return '<script type="text/javascript" src="/system/plugins/fckeditor/fckeditor.js"></script>
<script type="text/javascript">

  var oFCKeditor = new FCKeditor("'.$area.'");
 oFCKeditor.ToolbarSet="Default";
 oFCKeditor.Height="'.$size.'px";
 oFCKeditor.BasePath="/system/plugins/fckeditor/";
 oFCKeditor.ReplaceTextarea(); 

</script>';
 }
 
 
 function langselect($lname=''){
 
	if($lname!=''){
		return '<select id="'.$lname.'" name="'.$lname.'" onchange="javascript:changetype(\''.$lname.'\');">
		<option value="en">en</option>
		<option value="uk">uk</option>
		<option value="be">be</option>
		</select> &nbsp; ';
	}
}

function lang_text_translation($field='', $array_t, $lang='en'){

	if($field!='' && $array_t){
	
		foreach($array_t as $al){
			if($al['lang']==$lang){
				return $al[$field];
			}
		}
	
	}else{ return ''; }
	
}


?>