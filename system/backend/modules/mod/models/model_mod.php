<?
class Model_mod extends Model{
  function Model_mod(){
    parent::Model();
  }

  function get_mod(){
	$q = $this->db->get('modules');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
  }
  
    function get_mod_structure(){
	$this->db->order_by('module_name','asc');
	$q = $this->db->get('modules_table_fields');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
  }

  function set_mod($data){
	for($m=0; $m<$data['index']; $m++){
		if(isset($data['idhid'])){
			$update['active'] = (isset($data['id'][$m])?1:0);
			$this->db->where('id',$data['idhid'][$m]);
			$this->db->update('modules',$update);
			
			if($update['active']==1){
				$this->db->where('id',$data['idhid'][$m]);
				$qt = $this->db->get('modules');
				$rt = $qt->result_array();
				$nt = $qt->num_rows();
					if($nt && file_exists($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$rt[0]['name'].'/install.php') && !$this->db->table_exists($rt[0]['name'])){
						$install = $_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$rt[0]['name'].'/install.php';
						include($install);
						$it=0;
						while(isset($base_schema[$it])){
							$this->db->query($base_schema[$it]);
							$it++;
						}
					}
			}
		}
	}
	return 1;	
  }
  
    function set_mod_structure($data){
		for($m=0; $m<$data['index']; $m++){
//echo $data['fieldname'][$m].(isset($data['id'][$m])?1:0); 
				$update['active'] = (isset($data['id'][$m])?1:0);
				$this->db->where('module_name',$data['module'][$m]);
				$this->db->where('field_name',$data['fieldname'][$m]);
				$this->db->update('modules_table_fields',$update);

		}
	return 1;	
  }


}