<?

class Model_settings extends Model{
 function Model_settings(){
  parent::Model();

 }


 function get_list(){
 $this->db->where('id',1);
  $q = $this->db->get('settings');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r[0];
  }else{
	return 0;
  }
 }
 
 function get_list_mailer(){
  $this->db->order_by('mail','asc');
  $q = $this->db->get('mailer');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 
 
 function get_list_dopfield($dopfield_id=0){
	if($dopfield_id>0){ $this->db->where('id',$dopfield_id); }
  $this->db->order_by('pos','asc');
  $q = $this->db->get('settings_dopfields');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 function get_dopfield_value($obj_id, $fid){
  $this->db->where('object_id',$obj_id);
  $this->db->where('field_id',$fid);
  $q = $this->db->get('settings_dopvalues');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r[0]['value'];
  }else{
	return '';
  }
 }
 
  

  
  
   function get_settings_gallery(){	
	$this->db->where('name','gallery');
	$qm = $this->db->get('modules');
	if($qm->num_rows()){
		foreach($qm->result_array() as $rm){
			if($rm['active']==1){
				/////////// 			get_pages_gallery
				$this->db->where('enable','Y');
				$this->db->order_by('pos','asc');
				$q = $this->db->get('gallery');
				if($q->num_rows()>0){
					return $q->result_array();
				}else{
					return 0;
				}
			}else{
				return 0;
			}
		}
	}
  }
  

 function get_info($id){
  $this->db->where('id',$id);
  $q = $this->db->get('settings');
  return reset($q->result_array());
 }
 
  function get_info_lang($id){
	$this->db->where('module_name','settings');
	$this->db->where('table_name','settings');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
 }
 
 
   function get_info_dopfields_lang($objid, $idf){
   
			$this->db->where('object_id',$objid);
			$this->db->where('field_id',$idf);
			$qd = $this->db->get('settings_dopvalues');
			if($qd->num_rows()>0){
				$rd = $qd->result_array();
   				$this->db->where('module_name','settings');
				$this->db->where('table_name','settings_dopvalues');
				$this->db->where('record_id',$rd[0]['id']);
				$q = $this->db->get('modules_translation');
				$r = $q->result_array();
				if($r){
					return $r;
				}else{
					return 0;
				}
	
	}else{ return 0; }
 }
 
 
   function get_info_dopfield_lang($id){
	$this->db->where('module_name','settings');
	$this->db->where('table_name','settings_dopfields');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
 }
 
 
 function get_info_dopfield($id){
  $this->db->where('id',$id);
  $q = $this->db->get('settings_dopfields');
  return reset($q->result_array());
 }



 function add_data_dopfield($aData){
  $aInsert = array(
  "field"=>$aData['field'],
  "type"=>$aData['type'],
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos']
  );
  $this->db->insert('settings_dopfields',$aInsert);
  
    	//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('settings_dopfields');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','settings');
							$this->db->where('table_name','settings_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','settings');
							$this->db->where('table_name','settings_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'settings',
					 "table_name"=>'settings_dopfields',
					 "record_id"=>$r_last[0]['id'],
					 "lang"=>$aData[$lg.$larray[$il]],
					 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
					);
					$this->db->insert('modules_translation',$aInsertLang);
				}
				
			}
		
		}
		
	}
	////////////////// lang
  
  return 1;
 }
 

 
 
  function edit_data_dopfield($aData){
  $aUpdate = array(
  "field"=>$aData['field'],  
  "type"=>$aData['type'],
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos']
  );
  $this->db->where('id',$aData['id']);
  $this->db->update('settings_dopfields',$aUpdate);
  
  

			
			$this->db->where('object_id',1);
			$this->db->where('field_id',$aData['id']);
			$qd = $this->db->get('settings_dopvalues');
			
			if($qd->num_rows()>0){
				$updatef['value'] = (isset($aData['field'.$aData['id']])?$aData['field'.$aData['id']]:'');
				$this->db->where('object_id',1);
				$this->db->where('field_id',$aData['id']);
				$this->db->update('settings_dopvalues',$updatef);
			}else{
				$insertf['object_id'] = 1;
				$insertf['field_id'] = $aData['id'];
				$insertf['value'] = (isset($aData['field'.$aData['id']])?$aData['field'.$aData['id']]:'');
				$this->db->insert('settings_dopvalues',$insertf);
			}

	
	
	
  
      	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('settings_dopfields');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','settings');
							$this->db->where('table_name','settings_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','settings');
							$this->db->where('table_name','settings_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'settings',
					 "table_name"=>'settings_dopfields',
					 "record_id"=>$r_last[0]['id'],
					 "lang"=>$aData[$lg.$larray[$il]],
					 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
					);
					$this->db->insert('modules_translation',$aInsertLang);
				}
				
			}
		
		}
		
	}
	////////////////// lang
  
  return 1;
 }
 

 function edit_data($aData){
  $aUpdate = array(
  "email"=>$aData['email'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aUpdate['image']) unset($aUpdate['image']);
  $this->db->where('id',1);
  $this->db->update('settings',$aUpdate);
  
  return 1;
 }
 
 function delete_data($id){
 
	$this->db->where('parent_id',$id);
	$qc = $this->db->get('settings');
	if($qc->num_rows()){
		foreach($qc->result_array() as $rqc){
			$this->delete_data($rqc['id']);
		}
		
		$this->db->where('id',$id);
		return $this->db->delete('settings');
	}else{
		
 		$this->db->where('id',$id);
		return $this->db->delete('settings');
	}
 }
 
 
 function delete_data_dopfield($id){
 
 		$this->db->where('id',$id);
		return $this->db->delete('settings_dopfields');

 }

 function copyDellGroup($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `settings` WHERE `id` = $item");
   }
   break;

  }

 }

 
 function copyDellGroup_adddopfield($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `settings_dopfields` WHERE `id` = $item");
   }
   break;

  }

 }
 
  function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','settings');
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