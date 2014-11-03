<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Multi Uploading Extend Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploads
 * @author		ExpressionEngine Dev Team
 * @link		http://code-igniter.ru/wiki/multi_upload, http://code-igniter.ru/forum/topic519.html
 */
class MY_Upload  extends CI_Upload {
	
	function MY_Upload ($props = array())
	 {
		  parent::CI_Upload();
		  self::CI_Upload($props);

	 }
	 
	function multi_upload($field='userfile')
	{	
		if (!empty($_FILES[$field]))
		{
		$multi_data=array();		
		foreach ($_FILES[$field]['name'] AS $index => $val)
			{
				if(!empty($_FILES[$field]['name'][$index])) {
				
					foreach ($_FILES[$field] AS $key => $val_arr)
						{
							$_FILES[$field.$index][$key] = $val_arr[$index];
						}
					$result = self::do_upload($field.$index);
					$multi_data[$index]=self::data();
					$multi_data[$index]["error"]=self::display_errors();
					$this->file_name ="";
				}
			}
			unset($_FILES[$field]);
			return $multi_data;
		 }
	}

	function is_allowed_filetype(){
			$file = substr($this->file_ext, 1);
			if(in_array(strtolower($file), $this->allowed_types)){
				return TRUE;
			}
			return FALSE;
	}

}

?>
