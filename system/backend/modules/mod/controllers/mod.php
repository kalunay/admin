<?
class Mod extends Controller {

var $modules;

    function Mod(){
      parent::Controller();
	  $this->load->model('model_mod');
      $this->load->language('strings');
      
	  // Get active modules
		$this->getActiveModules();
	  }

	function getActiveModules(){
	
		// Get active modules
		$this->db->where('active',1);
		$this->db->order_by('title','asc');
		$m = $this->db->get('modules');
		if($m->num_rows()>0){
			$this->modules = $m->result_array();
		}
	
	}
	  
    function index(){
		if(isset($_POST['save'])){
		  $vars = $_POST;
		  unset($vars['save']);
		  $this->model_mod->set_mod($vars);
		  $data['msg'] = "saved";
		  redirect('mod');
		}else{
			$this->listmod();
		}
    }
	
	function structure(){
		if(isset($_POST['save'])){
		  $vars = $_POST;
		  unset($vars['save']);
		  $this->model_mod->set_mod_structure($vars);
		  $data['msg'] = "saved";
		  redirect('mod/structure');
		}else{
			$this->listmodstructure();
		}
	}
	
	function listmodstructure(){
		$data['modules'] = $this->modules;
	  $this->load->view('modstructure_view',$data);
	}
	
	function listmod(){
	
	//exists install.php
	if($handle = opendir($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/')){
				while (false !== ($file = readdir($handle))) {
					$this->db->where('name', $file);
					$query = $this->db->get('modules');
					$qn = $query->num_rows();
					$qr = $query->result_array();
					if ($file != ".." && 
					$file != "." && 
					$qn==0 && 
					file_exists($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$file.'/install.php')){
						$install = $_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$file.'/install.php';
						include($install);				
						
							if(isset($base_schema) && isset($mod_name)){ //&& $this->db->query($base_schema)							
								$insert['name'] = $file;
								$insert['title'] = $mod_name;
								$insert['active'] = 0;
								$this->db->insert('modules', $insert);
							}
						
					}
				}
		}
	//end exists
	
	// delete module
	$query = $this->db->get('modules');
	$qn = $query->num_rows();
	$qr = $query->result_array();
	if($qn>0){
		foreach($qr as $r){
			if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/system/backend/modules/'.$r['name'])){
				$this->db->where('id', $r['id']);
				$this->db->delete('modules');
				
				$this->db->where('module_name', $r['name']);
				$this->db->delete('modules_table_fields');
				
				// удаляются все таблицы модуля, файлы которого были удалены.
				$tables = $this->db->list_tables();
				$this->load->dbforge();
				foreach ($tables as $table){
				   if(strstr($table,$r['name']) && strpos($table,$r['name'])==0){
				   		$this->dbforge->drop_table($table);
				   }
				} 
				
			}
		}
	}
	//end delete module
	
	  $data['modules'] = $this->modules;
	  $this->load->view('mod_view',$data);
	}
	

}