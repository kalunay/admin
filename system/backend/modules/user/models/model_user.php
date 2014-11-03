<?

class Model_user extends Model{
 function Model_user(){
  parent::Model();
  
 }


 function get_list(){
  $this->db->order_by('name','asc');
  $q = $this->db->get('user');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r;
  }else{
	return 0;
  }
 }
 

  function get_list_all_num(){
  $this->db->order_by('name','asc');
  $q = $this->db->get('user');
  $r = $q->result_array();
  if($q->num_rows()){
	return $q->num_rows();
  }else{
	return 0;
  }
 }
 
  function get_list_all_date($d1='', $d2=''){
  if($d1!=''){ $this->db->where('date >',$d1); }
  if($d2!=''){ $this->db->where('date <',$d2); }
  $this->db->order_by('id','desc');
  $q = $this->db->get('user');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r;
  }else{
	return 0;
  }
 }
 
 
   function get_list_all($limit=5, $page=0){
  $this->db->order_by('id','desc');
  $this->db->limit($limit,$page);
  $q = $this->db->get('user');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r;
  }else{
	return 0;
  }
 }
 
 
 function get_list_group(){
  $this->db->order_by('name','asc');
  $q = $this->db->get('user_groups');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
  function get_group_usr($id=0){
  $t='';
  $this->db->order_by('name','asc');
  $q = $this->db->get('user_groups');
  if($q->num_rows()){
	foreach($q->result_array() as $r){
		$t.='<option value="'.$r['id'].'" '.($r['id']==$id?'selected':'').'>'.$r['name'].'</option>';
	}
	return $t;
  }else{
	return 0;
  }
 }
 
  function getNameGroup($id){
  $this->db->where('id',$id);
  $q = $this->db->get('user_groups');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r[0]['name'];
  }else{
	return 0;
  }
 }
 
  function get_list_dopfield(){
  $this->db->order_by('pos','asc');
  $q = $this->db->get('user_dopfields');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 function get_dopfield_value($obj_id, $fid){
  $this->db->where('object_id',$obj_id);
  $this->db->where('field_id',$fid);
  $q = $this->db->get('user_dopvalues');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r[0]['value'];
  }else{
	return '';
  }
 }
 
  

  
  
   function get_user_gallery(){	
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
  $q = $this->db->get('user');
  return reset($q->result_array());
 }
 
  function get_info_lang($id){
	$this->db->where('module_name','user');
	$this->db->where('table_name','user');
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
			$qd = $this->db->get('user_dopvalues');
			if($qd->num_rows()>0){
				$rd = $qd->result_array();
   				$this->db->where('module_name','user');
				$this->db->where('table_name','user_dopvalues');
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
	$this->db->where('module_name','user');
	$this->db->where('table_name','user_dopfields');
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
  $q = $this->db->get('user_dopfields');
  return reset($q->result_array());
 }

  function get_info_group($id){
  $this->db->where('id',$id);
  $q = $this->db->get('user_groups');
  return reset($q->result_array());
 }
 
  function add_data($aData){
	  $aInsert = array(
	  "name"=>$aData['name'],
	  "address"=>$aData['address'],
	  "email"=>$aData['email'],
	  "phone"=>$aData['phone'],
	  "description"=>$aData['description'],
	  "date"=>date('Y-m-d'),
	  "group_usr"=>1,
	  "active"=>$aData['active'],
	  "login"=>$aData['login'],
	  "password"=>$aData['password'],
	  "passwordmd5"=>md5($aData['password']),
	  "keygen"=>rand(100000,999999),
	  "mailer"=>$aData['mailer'],
	  "image"=>(isset($aData['image'])?$aData['image']:'')
	  );
	  if (!$aInsert['image']) unset($aInsert['image']);
	  $this->db->insert('user',$aInsert);
  }
 

 function add_data_dopfield($aData){
  $aInsert = array(
  "field"=>$aData['field'],
  "type"=>$aData['type'],
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos']
  );
  $this->db->insert('user_dopfields',$aInsert);
  
    	//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('user_dopfields');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','user');
							$this->db->where('table_name','user_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','user');
							$this->db->where('table_name','user_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'user',
					 "table_name"=>'user_dopfields',
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
 
 function add_data_group($aData){
  $aInsert = array(
  "name"=>$aData['name']
  );
  $this->db->insert('user_groups',$aInsert);
  
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
  $this->db->update('user_dopfields',$aUpdate);
  
      	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('user_dopfields');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','user');
							$this->db->where('table_name','user_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','user');
							$this->db->where('table_name','user_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'user',
					 "table_name"=>'user_dopfields',
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
 
  function edit_data_group($aData){
  $aUpdate = array(
  "name"=>$aData['name']
  );
  $this->db->where('id',$aData['id']);
  $this->db->update('user_groups',$aUpdate);
  
  
    $q = $this->db->get('user_dopfields');
	if($q->num_rows()>0){
		foreach($q->result_array() as $cdv){
			
			$this->db->where('object_id',$aData['id']);
			$this->db->where('field_id',$cdv['id']);
			$qd = $this->db->get('user_dopvalues');
			
			if($qd->num_rows()>0){
				$updatef['value'] = (isset($aData['field'.$cdv['id']])?$aData['field'.$cdv['id']]:'');
				$this->db->where('object_id',$aData['id']);
				$this->db->where('field_id',$cdv['id']);
				$this->db->update('user_dopvalues',$updatef);
			}else{
				$insertf['object_id'] = $aData['id'];
				$insertf['field_id'] = $cdv['id'];
				$insertf['value'] = (isset($aData['field'.$cdv['id']])?$aData['field'.$cdv['id']]:'');
				$this->db->insert('user_dopvalues',$insertf);
			}
		}
	}
  
  return 1;
 }
 

 function edit_data($aData){
  $aUpdate = array(
   "name"=>$aData['name'],
	  "address"=>$aData['address'],
	  "email"=>$aData['email'],
	  "phone"=>$aData['phone'],
	  "description"=>$aData['description'],
	  "date"=>date('Y-m-d'),
	  "group_usr"=>$aData['group_usr'],
	  "active"=>$aData['active'],
	  "login"=>$aData['login'],
	  "password"=>$aData['password'],
	  "passwordmd5"=>md5($aData['password']),	  
	  "mailer"=>$aData['mailer'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aUpdate['image']) unset($aUpdate['image']);
  $this->db->where('id',$aData['id']);
  $this->db->update('user',$aUpdate);


  
  
    $q = $this->db->get('user_dopfields');
	if($q->num_rows()>0){
		foreach($q->result_array() as $cdv){
			
			$this->db->where('object_id',$aData['id']);
			$this->db->where('field_id',$cdv['id']);
			$qd = $this->db->get('user_dopvalues');
			
			if($qd->num_rows()>0){
				$updatef['value'] = (isset($aData['field'.$cdv['id']])?$aData['field'.$cdv['id']]:'');
				$this->db->where('object_id',$aData['id']);
				$this->db->where('field_id',$cdv['id']);
				$this->db->update('user_dopvalues',$updatef);
			}else{
				$insertf['object_id'] = $aData['id'];
				$insertf['field_id'] = $cdv['id'];
				$insertf['value'] = (isset($aData['field'.$cdv['id']])?$aData['field'.$cdv['id']]:'');
				$this->db->insert('user_dopvalues',$insertf);
			}
		}
	}
  
  
  
  
      	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('user');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if($il==9){
				$ql = $this->db->get('user_dopfields');
				if($q->num_rows()>0){
					foreach($q->result_array() as $cdv){
					
						$this->db->where('object_id',1);
						$this->db->where('field_id',$cdv['id']);
						$qd = $this->db->get('user_dopvalues');
						if($qd->num_rows()>0){
							foreach($qd->result_array() as $rf){
								if(isset($aData['lang_field'.$cdv['id']]) && $aData['lang_field'.$cdv['id']]!='' && $rf['value']!=''){
								$this->db->where('record_id',$rf['id']);
								$this->db->where('module_name','user');
								$this->db->where('table_name','user_dopvalues');
								$this->db->where('lang',$aData['lang_field'.$cdv['id']]);
								$qml = $this->db->get('modules_translation');
								
								if($qml->num_rows()){

											$aUpdateLang = array(
											 $larray[$il]=>(isset($aData['lang_field'.$cdv['id'].$tt.'_'.$aData['lang_field'.$cdv['id']]])?$aData['lang_field'.$cdv['id'].$tt.'_'.$aData['lang_field'.$cdv['id']]]:'')
											);
											$this->db->where('record_id',$rf['id']);
											$this->db->where('module_name','user');
											$this->db->where('table_name','user_dopvalues');
											$this->db->where('lang',$aData['lang_field'.$cdv['id']]);
											$this->db->update('modules_translation',$aUpdateLang);
							
								
								}else{
										
									$aInsertLang = array(
									 "module_name"=>'user',
									 "table_name"=>'user_dopvalues',
									 "record_id"=>$rf['id'],
									 "lang"=>$aData['lang_field'.$cdv['id']],
									 $larray[$il]=>(isset($aData['lang_field'.$cdv['id'].$tt.'_'.$aData['lang_field'.$cdv['id']]])?$aData['lang_field'.$cdv['id'].$tt.'_'.$aData['lang_field'.$cdv['id']]]:'')
									);
									$this->db->insert('modules_translation',$aInsertLang);
								}
								}
							}
						}	
						
					}
				}
			}else{
				if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
								
								$this->db->where('record_id',$r_last[0]['id']);
								$this->db->where('module_name','user');
								$this->db->where('table_name','user');
								$this->db->where('lang',$aData[$lg.$larray[$il]]);
								$qml = $this->db->get('modules_translation');
					
					if($qml->num_rows()){

								$aUpdateLang = array(
								 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
								);
								$this->db->where('record_id',$r_last[0]['id']);
								$this->db->where('module_name','user');
								$this->db->where('table_name','user');
								$this->db->where('lang',$aData[$lg.$larray[$il]]);
								$this->db->update('modules_translation',$aUpdateLang);
				
					
					}else{
							
						$aInsertLang = array(
						 "module_name"=>'user',
						 "table_name"=>'user',
						 "record_id"=>$r_last[0]['id'],
						 "lang"=>$aData[$lg.$larray[$il]],
						 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
						);
						$this->db->insert('modules_translation',$aInsertLang);
					}
					
				}
			}
		
		}
		
	}
	////////////////// lang
  
  return 1;
 }
 
 function delete_data($id){
 
	$this->db->where('id',$id);
	$qc = $this->db->get('user');
	if($qc->num_rows()){	
		$this->db->where('id',$id);
		return $this->db->delete('user');
	}else{
		return 0;
	}
 }
 
 
 function delete_data_dopfield($id){
 
 		$this->db->where('id',$id);
		return $this->db->delete('user_dopfields');

 }
 
  function delete_data_group($id){
 
 		$this->db->where('id',$id);
		return $this->db->delete('user_groups');

 }

 function copyDellGroup($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `user` WHERE `id` = $item");
   }
   break;

  }

 }

 
 function copyDellGroup_adddopfield($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `user_dopfields` WHERE `id` = $item");
   }
   break;

  }

 }
 
  function copyDellGroup_addgroupus($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `user_groups` WHERE `id` = $item");
   }
   break;

  }

 }
 
  function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','user');
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