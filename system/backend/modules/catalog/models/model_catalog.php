<?

class Model_catalog extends Model{
 function Model_catalog(){
  parent::Model();

 }


 function get_list($limit=20,$offset=0){
 // $this->db->limit($limit,$offset);
  $this->db->order_by('pos','asc');
  $q = $this->db->get('catalog');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 function get_list_objects($cat_id=0,$limit=20,$offset=0){
  $this->db->where('cat_id',$cat_id);
  //$this->db->limit($limit,$offset);
  $this->db->order_by('pos','asc');
  $q = $this->db->get('catalog_object');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 function get_list_dopfield(){
  $this->db->order_by('pos','asc');
  $q = $this->db->get('catalog_dopfields');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 function get_dopfield_value($obj_id, $fid){
  $this->db->where('object_id',$obj_id);
  $this->db->where('field_id',$fid);
  $q = $this->db->get('catalog_dopvalues');
  $r = $q->result_array();
  if($q->num_rows()){
	return $r[0]['value'];
  }else{
	return '';
  }
 }
 
  function get_catalog(){						/////////// 			get_pages
   // $this->db->where('publish',1);
	$this->db->order_by('pos','asc');
	$q = $this->db->get('catalog');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
  }
  
   function get_catalog_active(){						/////////// 			get_pages
    $this->db->where('publish',1);
	$this->db->order_by('pos','asc');
	$q = $this->db->get('catalog');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
  }
  
  
   function get_catalog_gallery(){	
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
  $q = $this->db->get('catalog');
  return reset($q->result_array());
 }
 
  function get_info_lang($id){
	$this->db->where('module_name','catalog');
	$this->db->where('table_name','catalog');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
 }
 
   function get_info_object_lang($id){
	$this->db->where('module_name','catalog');
	$this->db->where('table_name','catalog_object');
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
			$qd = $this->db->get('catalog_dopvalues');
			if($qd->num_rows()>0){
				$rd = $qd->result_array();
   				$this->db->where('module_name','catalog');
				$this->db->where('table_name','catalog_dopvalues');
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
	$this->db->where('module_name','catalog');
	$this->db->where('table_name','catalog_dopfields');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
 }
 
 function get_info_object($id){
  $this->db->where('id',$id);
  $q = $this->db->get('catalog_object');
  return reset($q->result_array());
 }
 
 function get_info_dopfield($id){
  $this->db->where('id',$id);
  $q = $this->db->get('catalog_dopfields');
  return reset($q->result_array());
 }

 function add_data($aData){
  $aInsert = array(
  "parent_id"=>$aData['parent_id'],
  "gallery_cat_id"=>(isset($aData['gallery_cat_id'])?$aData['gallery_cat_id']:''),
  "name"=>$aData['name'],
  "menu_name"=>(isset($aData['menu_name'])?$aData['menu_name']:''),
  "title"=>$aData['title'],
  "keywords"=>$aData['keywords'],
  "description"=>$aData['description'],
  "alias"=>$aData['alias'],
  "text"=>$aData['text'],
  "modify"=>time(),
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aInsert['image']) unset($aInsert['image']);
  $this->db->insert('catalog',$aInsert);
  
  	//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('catalog');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'catalog',
					 "table_name"=>'catalog',
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

 function add_data_dopfield($aData){
  $aInsert = array(
  "field"=>$aData['field'],
  "type"=>$aData['type'],
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos']
  );
  $this->db->insert('catalog_dopfields',$aInsert);
  
    	//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('catalog_dopfields');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'catalog',
					 "table_name"=>'catalog_dopfields',
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
 
 function add_data_object($aData, $cat_id=0){
  $aInsert = array(
  "cat_id"=>$cat_id,
  "gallery_cat_id"=>(isset($aData['gallery_cat_id'])?$aData['gallery_cat_id']:''),
  "name"=>$aData['name'],
  "menu_name"=>(isset($aData['menu_name'])?$aData['menu_name']:''),
  "title"=>$aData['title'],
  "keywords"=>$aData['keywords'],
  "description"=>$aData['description'],
  "alias"=>$aData['alias'],
  "smalltext"=>(isset($aData['smalltext'])?$aData['smalltext']:''),
  "text"=>$aData['text'],
  "modify"=>time(),
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aInsert['image']) unset($aInsert['image']);
  $this->db->insert('catalog_object',$aInsert);
  
  
  
    	//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('catalog_object');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog_object');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog_object');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'catalog',
					 "table_name"=>'catalog_object',
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
  $this->db->update('catalog_dopfields',$aUpdate);
  
      	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('catalog_dopfields');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog_dopfields');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'catalog',
					 "table_name"=>'catalog_dopfields',
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
  "parent_id"=>$aData['parent_id'],
  "gallery_cat_id"=>(isset($aData['gallery_cat_id'])?$aData['gallery_cat_id']:''),
  "name"=>$aData['name'],
  "menu_name"=>(isset($aData['menu_name'])?$aData['menu_name']:''),
  "title"=>$aData['title'],
  "keywords"=>$aData['keywords'],
  "description"=>$aData['description'],
  "alias"=>$aData['alias'],
  "text"=>$aData['text'],
  "modify"=>time(),
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aUpdate['image']) unset($aUpdate['image']);
  $this->db->where('id',$aData['id']);
  $this->db->update('catalog',$aUpdate);
  
   	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('catalog');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','catalog');
							$this->db->where('table_name','catalog');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'catalog',
					 "table_name"=>'catalog',
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
 
 function edit_data_object($aData, $cat_id=0){
  $aUpdate = array(
  "cat_id"=>$cat_id,
  "gallery_cat_id"=>(isset($aData['gallery_cat_id'])?$aData['gallery_cat_id']:''),
  "name"=>$aData['name'],
  "menu_name"=>(isset($aData['menu_name'])?$aData['menu_name']:''),
  "title"=>$aData['title'],
  "keywords"=>$aData['keywords'],
  "description"=>$aData['description'],
  "alias"=>$aData['alias'],
  "smalltext"=>(isset($aData['smalltext'])?$aData['smalltext']:''),
  "text"=>$aData['text'],
  "modify"=>time(),
  "publish"=>$aData['publish'],
  "pos"=>$aData['pos'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aUpdate['image']) unset($aUpdate['image']);
  $this->db->where('id',$aData['id']);
  $this->db->update('catalog_object',$aUpdate);
  
  
  
  
  $q = $this->db->get('catalog_dopfields');
	if($q->num_rows()>0){
		foreach($q->result_array() as $cdv){
			
			$this->db->where('object_id',$aData['id']);
			$this->db->where('field_id',$cdv['id']);
			$qd = $this->db->get('catalog_dopvalues');
			
			if($qd->num_rows()>0){
				$updatef['value'] = (isset($aData['field'.$cdv['id']])?$aData['field'.$cdv['id']]:'');
				$this->db->where('object_id',$aData['id']);
				$this->db->where('field_id',$cdv['id']);
				$this->db->update('catalog_dopvalues',$updatef);
			}else{
				$insertf['object_id'] = $aData['id'];
				$insertf['field_id'] = $cdv['id'];
				$insertf['value'] = (isset($aData['field'.$cdv['id']])?$aData['field'.$cdv['id']]:'');
				$this->db->insert('catalog_dopvalues',$insertf);
			}
		}
	}
  
  
  
      	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('catalog_object');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window','field');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<10; $il++){
		
			if($il==9){
				$ql = $this->db->get('catalog_dopfields');
				if($q->num_rows()>0){
					foreach($q->result_array() as $cdv){
					
						$this->db->where('object_id',$aData['id']);
						$this->db->where('field_id',$cdv['id']);
						$qd = $this->db->get('catalog_dopvalues');
						if($qd->num_rows()>0){
							foreach($qd->result_array() as $rf){
								if(isset($aData['lang_field'.$cdv['id']]) && $aData['lang_field'.$cdv['id']]!='' && $rf['value']!=''){
								$this->db->where('record_id',$rf['id']);
								$this->db->where('module_name','catalog');
								$this->db->where('table_name','catalog_dopvalues');
								$this->db->where('lang',$aData['lang_field'.$cdv['id']]);
								$qml = $this->db->get('modules_translation');
								
								if($qml->num_rows()){

											$aUpdateLang = array(
											 $larray[$il]=>(isset($aData['lang_field'.$cdv['id'].$tt.'_'.$aData['lang_field'.$cdv['id']]])?$aData['lang_field'.$cdv['id'].$tt.'_'.$aData['lang_field'.$cdv['id']]]:'')
											);
											$this->db->where('record_id',$rf['id']);
											$this->db->where('module_name','catalog');
											$this->db->where('table_name','catalog_dopvalues');
											$this->db->where('lang',$aData['lang_field'.$cdv['id']]);
											$this->db->update('modules_translation',$aUpdateLang);
							
								
								}else{
										
									$aInsertLang = array(
									 "module_name"=>'catalog',
									 "table_name"=>'catalog_dopvalues',
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
								$this->db->where('module_name','catalog');
								$this->db->where('table_name','catalog_object');
								$this->db->where('lang',$aData[$lg.$larray[$il]]);
								$qml = $this->db->get('modules_translation');
					
					if($qml->num_rows()){

								$aUpdateLang = array(
								 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
								);
								$this->db->where('record_id',$r_last[0]['id']);
								$this->db->where('module_name','catalog');
								$this->db->where('table_name','catalog_object');
								$this->db->where('lang',$aData[$lg.$larray[$il]]);
								$this->db->update('modules_translation',$aUpdateLang);
				
					
					}else{
							
						$aInsertLang = array(
						 "module_name"=>'catalog',
						 "table_name"=>'catalog_object',
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
 
	$this->db->where('parent_id',$id);
	$qc = $this->db->get('catalog');
	if($qc->num_rows()){
		foreach($qc->result_array() as $rqc){
			$this->delete_data($rqc['id']);
		}
		
		$this->db->where('cat_id',$id);
		$this->db->delete('catalog_object');
		
		$this->db->where('id',$id);
		return $this->db->delete('catalog');
	}else{
		
		$this->db->where('cat_id',$id);
		$this->db->delete('catalog_object');
		
 		$this->db->where('id',$id);
		return $this->db->delete('catalog');
	}
 }
 
 function delete_data_object($id){
 
 		$this->db->where('id',$id);
		return $this->db->delete('catalog_object');

 }
 
 function delete_data_dopfield($id){
 
 		$this->db->where('id',$id);
		return $this->db->delete('catalog_dopfields');

 }

 function copyDellGroup($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `catalog` WHERE `id` = $item");
   }
   break;

  }

 }

 function copyDellGroup_object($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `catalog_object` WHERE `id` = $item");
   }
   break;

  }

 }
 
 function copyDellGroup_adddopfield($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `catalog_dopfields` WHERE `id` = $item");
   }
   break;

  }

 }
 
  function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','catalog');
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
 
   function field_active_object($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','catalog_object');
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