<?

class Model_pages extends Model {
  function Model_pages(){
    parent::Model();
  }
	
  function get_pages(){						/////////// 			get_pages
    //$this->db->where('publish',1);
	$this->db->order_by('pos','asc');
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
  }
  
  function get_pages_active(){						/////////// 			get_pages
    $this->db->where('publish',1);
	$this->db->order_by('pos','asc');
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
  }
  
  function get_gallery(){	
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
  
  function get_id($id){					/////////// 			get_id
    //$this->db->where('publish',1);
	$this->db->where('id',$id);
    $q = $this->db->get('pages');
    $r = $q->result_array();
	if($r){
		return $r[0];
	}else{
		return 0;
	}
  }
  
   function get_lang_id($id){					/////////// 			get_id
    //$this->db->where('publish',1);
	$this->db->where('module_name','pages');
	$this->db->where('table_name','pages');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
  }
  
    
  function get_alias($alias){					/////////// 			get_alias
    $this->db->where('publish',1);
	$this->db->where('alias',$alias);
    $q = $this->db->get('pages');
    $r = $q->result_array();
	if($r){
		return $r[0];
	}else{
		return 0;
	}
  }
    
  function add_page($aData){					/////////// 			add_page
		
    $aInsert = array(
	 "parent_id"=>$aData['parent_id'],
	 "gallery_cat_id"=>(isset($aData['gallery_cat_id'])?$aData['gallery_cat_id']:''),
	 "name"=>$aData['name'],
	 "menu_name"=>(isset($aData['menu_name'])?$aData['menu_name']:''),
	 "keywords"=>$aData['keywords'],
	 "description"=>$aData['description'],
	 "title"=>$aData['title'],
	 "alias"=>$aData['alias'],
	 "date"=>date('Y-m-d'),
	 "modify"=>date('Y-m-d'),
	 "text"=>$aData['text'],
	 "pos"=>$aData['pos'],
	 "show_menu_top"=>(isset($aData['show_top_menu'])?1:0),
	 "show_menu_left"=>(isset($aData['show_left_menu'])?1:0),
	 "show_menu_right"=>(isset($aData['show_right_menu'])?1:0),
	 "show_menu_bottom"=>(isset($aData['show_bottom_menu'])?1:0),
	 "publish"=>(isset($aData['publish'])?1:0)
    );
	$this->db->insert('pages',$aInsert);
	
		//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('pages');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','pages');
							$this->db->where('table_name','pages');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','pages');
							$this->db->where('table_name','pages');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'pages',
					 "table_name"=>'pages',
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

  function edit_page($aData){					/////////// 			edit_page
	  
    $aUpdate = array(
	 "parent_id"=>$aData['parent_id'],
	 "gallery_cat_id"=>(isset($aData['gallery_cat_id'])?$aData['gallery_cat_id']:''),
	 "name"=>$aData['name'],
	 "menu_name"=>(isset($aData['menu_name'])?$aData['menu_name']:''),
	 "keywords"=>$aData['keywords'],
	 "description"=>$aData['description'],
	 "title"=>$aData['title'],
	 "alias"=>$aData['alias'],
	 "modify"=>date('Y-m-d'),
	 "text"=>$aData['text'],
	 "pos"=>$aData['pos'],
	 "show_menu_top"=>(isset($aData['show_top_menu'])?1:0),
	 "show_menu_left"=>(isset($aData['show_left_menu'])?1:0),
	 "show_menu_right"=>(isset($aData['show_right_menu'])?1:0),
	 "show_menu_bottom"=>(isset($aData['show_bottom_menu'])?1:0),
	 "publish"=>(isset($aData['publish'])?1:0)
    );
    $this->db->where('id',$aData['id']);
	$this->db->update('pages',$aUpdate);
	
			//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('pages');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','pages');
							$this->db->where('table_name','pages');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','pages');
							$this->db->where('table_name','pages');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'pages',
					 "table_name"=>'pages',
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

  function delete_page($aData){					/////////// 			delete_page
    $this->db->where('id',$aData);
    return $this->db->delete('pages');
  }
  
 function copyDellGroup($type,$id){  /////////// 			copyDellGroup
  switch ($type){
   case "dell":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `pages` WHERE `id` = $item");
   }
   break;

  }

 }
 
 function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','pages');
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