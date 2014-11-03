<?

class Model_gallery extends Model {
  function Model_gallery(){
    parent::Model();
  }

  function get_gallery_photos($gallery_id,$page=1){
	if (@$this->session->userdata('perpage')){
		$this->db->limit($this->session->userdata('perpage'),$page);
	}
	$this->db->where('gallery_cat_id',$gallery_id);
	$this->db->order_by('pos',"ASC");
	$q = $this->db->get('gallery_photo');
	return $q->result_array();
	
  }
  function upload ($aData){
     
      if(isset($_FILES['userfile'])){
		  
			$config['upload_path'] = '../userfiles';
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_size']	= '2000';
			$config['max_width']  = '2048';
			$config['max_height']  = '2048';
			$this->load->library('upload', $config);
			if ( !$imgdata = $this->upload->multi_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}else{
				
				//print_r($imgdata);			
				$this->load->library('image_lib', $config);
				$i=0;
				foreach($imgdata as $imag){
				//	if ($imag['file_name']){
						
						
						$image_size=0;
						if($imag['image_width']>$imag['image_height']){
						$image_size=$imag['image_height'];
						/*смещение слева*/
						$image_x_axis = round(($imag['image_width']-$imag['image_height'])/2);
						/*смещение сверху*/
						$image_y_axis=0;
						}else{
						$image_size=$imag['image_width'];
						$image_x_axis = 0; $image_y_axis=round(($imag['image_height']-$imag['image_width'])/2);
						}
						
						
						

						
						$config['image_library'] = 'GD2';
						$config['source_image'] = $imag['full_path'];
						$config['quality'] = "100%";
						$config['create_thumb'] = true;
						$config['maintain_ratio'] = false;
						$config['width'] = $imag['image_width'] - ($image_x_axis*2);
						$config['height'] = $imag['image_height'] - ($image_y_axis*2);
						$config['x_axis'] = $image_x_axis;
   						$config['y_axis'] = $image_y_axis;
						$this->image_lib->initialize($config); 
						$this->image_lib->crop();
						
							$this->image_lib->clear();
						
					$config['image_library'] = 'GD2';
						$config['source_image'] = str_replace(".jpg","_thumb.jpg",$imag['full_path']);
						$config['source_image'] = str_replace(".JPG","_thumb.JPG",$config['source_image']);
						//$config['source_image'] = $imag['full_path'];
						$config['quality'] = "100%";
						$config['create_thumb'] = true;
						$config['maintain_ratio'] = true;
						$config['width'] = 158;
						$config['height'] = 158;
						$this->image_lib->initialize($config); 
						$this->image_lib->resize();
						$this->image_lib->clear();

						
						

					
					$aInsert = array(
					"photo_id"=>'',
					"gallery_cat_id"=>$aData['gallery_cat_id'],
					"name"=>$aData['name'][$i],
					"image"=>$imag['raw_name'],
					"ext"=>$imag['file_ext'],
					"width"=>$imag['image_width'],
					"height"=>$imag['image_height'],
					"modify"=>date('Y-m-d H:i:s')
					);
				$i++;
					$this->db->insert('gallery_photo',$aInsert);
				//	}
				}

			}		
		}
		
  }
  function delete_photo($photo_id,$by_cat=0){
	  $this->db->select('image,ext');
	  $this->db->where(($by_cat==0?'photo_id':'gallery_cat_id'),$photo_id);
	  $q = $this->db->get('gallery_photo');
	  
	  foreach ($q->result_array() as $photo){
	  	@unlink("/userfiles/".$photo['image'].$photo['ext']);
	  	@unlink("/userfiles/".$photo['image']."_thumb".$photo['ext']);
	  }
	  
	  $this->db->where(($by_cat==0?'photo_id':'gallery_cat_id'),$photo_id);
	  $this->db->delete('gallery_photo');
  }
  
  function disable_photo($photo_id){
	$this->db->where('photo_id',$photo_id);
    return $this->db->update('gallery_photo',array("enable"=>'N'));
  }
  function enable_photo($photo_id){
	$this->db->where('photo_id',$photo_id);
    return $this->db->update('gallery_photo',array("enable"=>'Y'));
  }
  
  function move_photo($photo_id,$move_cat_id){
  	$this->db->where('photo_id',$photo_id);
	$this->db->update('gallery_photo',array('gallery_cat_id'=>$move_cat_id));
  }
  
  function copy_photo($photo_id,$move_cat_id){
  	$this->db->where('photo_id',$photo_id);
	$q = $this->db->get('gallery_photo');
	$q = $q->result_array();
	
	copy("../userfiles/".$q[0]['image'].$q[0]['ext'],"../userfiles/".$q[0]['image']."_copy".$q[0]['ext']);
	copy("../userfiles/".$q[0]['image']."_thumb".$q[0]['ext'],"../userfiles/".$q[0]['image']."_copy_thumb".$q[0]['ext']);
	
	$aData = array (
	'gallery_cat_id'=>$move_cat_id,
	'image'=> $q[0]['image']."_copy",
	'ext'=> $q[0]['ext'],
	'name'=> $q[0]['name'],
	'width'=> $q[0]['width'],
	'height'=> $q[0]['height'],
	'modify'=>date('Y-m-d H:i:s')	
	);
	
	$this->db->insert('gallery_photo',$aData);
  }
  
    function actionwith_photo($type,$photo_id){
  	switch ($type){
		case "del_selected":
			foreach ($photo_id as $id){
				$this->delete_photo($id);
			}
		break;
		case "disable_selected":
			foreach ($photo_id as $id){
				$this->disable_photo($id);
			}
		break;
		case "enable_selected":
			foreach ($photo_id as $id){
				$this->enable_photo($id);
			}
		break;
		case "move_selected":
			foreach ($photo_id as $id){
				$this->move_photo($id,$_POST['move_cat_id']);
			}
		break;
		case "copy_selected":
			foreach ($photo_id as $id){
				$this->copy_photo($id,$_POST['move_cat_id']);
			}
		break;
		case "":
			
			foreach ($photo_id as $id){
				$this->if_new_name($id);
			}
		break;

		
	}
  }
  
  
  function if_new_name($id){
  	if($_POST['newname'][$id]!=''){
		$this->db->where('photo_id',$id);
		return $this->db->update('gallery_photo',array("name"=>$_POST['newname'][$id]));
	}
  }
  
  function get_gallery_cat($parent_id=-1,$limit=100,$offset=0){
    if ($parent_id>=0) $this->db->where('parent_id', $parent_id);
   $this->db->order_by('gallery_cat_id',"ASC");
    //$this->db->limit($limit,$offset);
    $q = $this->db->get('gallery');
    return $q->result_array();
  }

  function get_info($id){
    $this->db->where('gallery_cat_id',$id);
    $q = $this->db->get('gallery');
    $r = $q->result_array();
    return $r[0];
  }
  
    function get_lang_info($id){					/////////// 			get_id
    //$this->db->where('publish',1);
	$this->db->where('module_name','gallery');
	$this->db->where('table_name','gallery');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
  }


 function save_gallery_cat ($id="",$aData){
//  $table = $this->table;
//  $idfield = $this->idfield;
  $table = "gallery";
  $idfield = "gallery_cat_id";
  $this->load->helper('transliterate');
  foreach ($aData as $field => $data)
   if ($this->db->field_exists($field,$table)) 
    $aDBData[$field] = is_array($data)?join(",",$data):$data;
  if ($this->db->field_exists('alias',$table))
   $aDBData['alias'] = preg_replace("/[^".$this->config->item("permitted_uri_chars")."]/","",
                       transliterate(isset($aData['alias'])?$aData['alias']:@$aData['title']));
  if ($this->db->field_exists('modify',$table)) $aDBData['modify'] = date('Y-m-d H:i:s');
  if ((int)$id) {
   $this->db->where($idfield,$id);
   $result = $this->db->update($table,$aDBData);
  } else {
   $result = $this->db->insert($table,$aDBData);
  }
  
  		//////////////////////////////////////// lang
if ((int)$id) {
   	$this->db->where('gallery_cat_id',$id);
  } else {
   	$this->db->order_by('gallery_cat_id','desc');
  }

	$last = $this->db->get('gallery');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['gallery_cat_id']);
							$this->db->where('module_name','gallery');
							$this->db->where('table_name','gallery');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['gallery_cat_id']);
							$this->db->where('module_name','gallery');
							$this->db->where('table_name','gallery');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'gallery',
					 "table_name"=>'gallery',
					 "record_id"=>$r_last[0]['gallery_cat_id'],
					 "lang"=>$aData[$lg.$larray[$il]],
					 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
					);
					$this->db->insert('modules_translation',$aInsertLang);
				}
				
			}
		
		}
		
	}
	////////////////// lang
  
  return $result;
 }


  function add_gallery_cat($aData){
    $aInsert = array(
     "gallery_cat_id"=>'',
	 "title"=>$aData['title'],
	 "title_window"=>(isset($aData['title_window'])?$aData['title_window']:''),
	 "modify"=>date('Y-m-d H:i:s')

    );
    return $this->db->insert('gallery',$aInsert);
  }

  function edit_gallery_cat($aData){
    $aUpdate = array(
	 "title"=>$aData['title'],
	 "title_window"=>(isset($aData['title_window'])?$aData['title_window']:''),
	 "modify"=>date('Y-m-d H:i:s')
    );
    $this->db->where('gallery_cat_id',$aData['gallery_cat_id']);
    return $this->db->update('gallery',$aUpdate);
  }

  function delete_gallery_cat($gallery_cat_id){
	$this->delete_photo($gallery_cat_id,1);
	$this->db->where('gallery_cat_id',$gallery_cat_id);
    return $this->db->delete('gallery');
  }
  
   function disable_gallery_cat($gallery_cat_id){
	$this->db->where('gallery_cat_id',$gallery_cat_id);
    return $this->db->update('gallery',array("enable"=>'N'));
  }
  function enable_gallery_cat($gallery_cat_id){
	$this->db->where('gallery_cat_id',$gallery_cat_id);
    return $this->db->update('gallery',array("enable"=>'Y'));
  }
 
  
  
  function actionwith_cat($type,$gallery_cat_id){
  	switch ($type){
		case "dell":
			foreach ($gallery_cat_id as $cat_id){
				$this->delete_gallery_cat($cat_id);
			}
		break;
		case "disable":
			foreach ($gallery_cat_id as $cat_id){
				$this->disable_gallery_cat($cat_id);
			}
		break;
		case "enable":
			foreach ($gallery_cat_id as $cat_id){
				$this->enable_gallery_cat($cat_id);
			}
		break;
		
	}
  }

 function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','gallery');
		$this->db->where('field_name',$field);
		$q = $this->db->get('modules_table_fields')->result_array();
		if($q[0]['active']==1){
			return 1;
		}else{
			return 0;
		}
	}else{
		return 1;
	}
 
 }

}