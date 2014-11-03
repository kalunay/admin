<?

class Model_users extends Model{
  function Model_users(){
    parent::Model();
    if(!$this->session->userdata('admin') && $this->uri->segment(2)!='login'){
      redirect('welcome/login');
    }
  }
  
    function field_active($field='', $module_name='user'){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name',$module_name);
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