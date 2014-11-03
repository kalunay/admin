<?

class Model_news extends Model {
 function Model_news(){
  parent::Model();

 }


 function get_list($limit=20,$offset=0){
 // $this->db->limit($limit,$offset);
  $this->db->order_by('date','desc');
  $q = $this->db->get('news');
  return $q->result_array();
 }

 function get_info($id){
  $this->db->where('id',$id);
  $q = $this->db->get('news');
  return reset($q->result_array());
 }
 
    function get_lang_info($id){					/////////// 			get_id
    //$this->db->where('publish',1);
	$this->db->where('module_name','news');
	$this->db->where('table_name','news');
	$this->db->where('record_id',$id);
    $q = $this->db->get('modules_translation');
    $r = $q->result_array();
	if($r){
		return $r;
	}else{
		return 0;
	}
  }
 

 function add_data($aData){
  $aInsert = array(
  "name"=>$aData['name'],
  "date"=>$aData['date'],
  "title"=>$aData['title'],
  "keywords"=>$aData['keywords'],
  "description"=>$aData['description'],
  "alias"=>(isset($aData['alias'])?$aData['alias']:''),
  "text"=>$aData['text'],
  "modify"=>time(),
  "publish"=>$aData['publish'],
"pos"=>$aData['pos'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aInsert['image']) unset($aInsert['image']);
  $this->db->insert('news',$aInsert);
  
  		//////////////////////////////////////// lang
	$this->db->order_by('id','desc');
	$last = $this->db->get('news');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','news');
							$this->db->where('table_name','news');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','news');
							$this->db->where('table_name','news');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'news',
					 "table_name"=>'news',
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
  "name"=>$aData['name'],
  "date"=>$aData['date'],
  "title"=>$aData['title'],
  "keywords"=>$aData['keywords'],
  "description"=>$aData['description'],
  "alias"=>(isset($aData['alias'])?$aData['alias']:''),
  "text"=>$aData['text'],
  "modify"=>time(),
  "publish"=>$aData['publish'],
"pos"=>$aData['pos'],
  "image"=>(isset($aData['image'])?$aData['image']:'')
  );
  if (!$aUpdate['image']) unset($aUpdate['image']);
  $this->db->where('id',$aData['id']);
  $this->db->update('news',$aUpdate);
  
  	//////////////////////////////////////// lang
	$this->db->where('id',$aData['id']);
	$last = $this->db->get('news');
	if($last->num_rows()){
		$r_last = $last->result_array();
	
			$larray = array('name','title','keywords','description','text','smalltext','menu_name','body','title_window');
			$lg = 'lang_';
			$tt = '_text';
				
		for($il=0; $il<9; $il++){
		
			if(isset($aData[$lg.$larray[$il]]) && isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]) && $aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]!=''){
				
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','news');
							$this->db->where('table_name','news');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$qml = $this->db->get('modules_translation');
				
				if($qml->num_rows()){

							$aUpdateLang = array(
							 $larray[$il]=>(isset($aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]])?$aData[$lg.$larray[$il].$tt.'_'.$aData[$lg.$larray[$il]]]:'')
							);
							$this->db->where('record_id',$r_last[0]['id']);
							$this->db->where('module_name','news');
							$this->db->where('table_name','news');
							$this->db->where('lang',$aData[$lg.$larray[$il]]);
							$this->db->update('modules_translation',$aUpdateLang);
			
				
				}else{
						
					$aInsertLang = array(
					 "module_name"=>'news',
					 "table_name"=>'news',
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

 function delete_data($id){
  $this->db->where('id',$id);
  return $this->db->delete('news');
 }

 function copyDellGroup($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `news` WHERE `id` = $item");
   }
   break;

  }

 }
 
 function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','news');
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