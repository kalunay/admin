<?

class User extends Controller {
 var $image_path ="/userfiles/image/users/";
var $modules;

 function User(){
  parent::Controller();
  $this->load->model('model_img_upload');
  $this->load->model('model_user');
  $this->load->library('pagination');
  $this->load->helper('editor');
  $this->load->language('strings');
  $this->load->language('module');

  $this->imUploadConfig = array (
   'upload_path' =>$_SERVER['DOCUMENT_ROOT'].$this->image_path,
    'width' => 140 ,
    'height' => 115 ,
  );


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
	

 function index($page=0){
  $this->ilist($page);
 }

 function ilist($page=0){
  $this->list = $this->model_user->get_list_all(20,$page);
  $this->dopfields = $this->model_user->get_list_dopfield();
  
  $config['base_url'] = '/_admin/user/ilist/';
		$config['total_rows'] = $this->model_user->get_list_all_num();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;

		$this->pagination->initialize($config);

		$this->pagination_link = $this->pagination->create_links();
  
  
  $this->load->view("main",$this);
 }

  function add(){
  $this->action ="add";
  if(isset($_POST['edit'])){
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_user->add_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_added'));
    redirect('user');
   }
  }

  $this->load->view("edit",$this);
 }
 
 
 function convdate($date=''){
	if($date!=''){
		$d = split('\.',$date);
		return $d[2].'-'.$d[1].'-'.$d[0];
	}else{
		return '';
	}
 }
 
 
 function alllistsearch(){
 $d1='';
 $d2='';
	if(isset($_POST['searchuser']) && isset($_POST['dateselect'])){
	
		$ds=str_replace(" ", "", $_POST['dateselect']);
		
		if(strstr($ds,'-')){
		$dlist = split('-',$ds);
		}else{
			redirect('user/alllist');
		}
		
		if(isset($dlist[0])){
			$d1 = $this->convdate($dlist[0]);
		}
		
		if(isset($dlist[1])){
			$d2 = $this->convdate($dlist[1]);
		}
		
		$this->lists2 = $this->model_user->get_list_all_date($d1,$d2);
		
	
	}else{
		redirect('user/alllist');
	}
	
	 $this->load->view("main_all",$this);
 
 }
 
 
 function alllist($page=0){
 
	$this->lists2 = $this->model_user->get_list_all(50,$page);
	
		$config['base_url'] = '/_admin/user/alllist/';
		$config['total_rows'] = $this->model_user->get_list_all_num();
		$config['per_page'] = '50';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;

		$this->pagination->initialize($config);

		$this->pagination_link = $this->pagination->create_links();
	
  $this->load->view("main_all",$this);
 
 }
 
 
 
 function edit($id){
$this->action ="edit";
if (empty($_POST["id"])) $_POST["id"]  = $id;
  if(isset($_POST['edit'])){
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_user->edit_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
	redirect('user');
	}
  }

  $this->item = $this->model_user->get_info($id);
  $this->item_lang = $this->model_user->get_info_lang($id);
  $this->load->view("edit",$this);
 }
 
 
  function delete($id){
  $this->db->where('id',$id);
  $q = $this->db->get('user');
  if ($q->num_rows()) {
	$data = reset($q->result_array());
   if($this->model_user->delete_data($id)){
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image'].".jpg");
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image']."_thumb.jpg");
     $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
   }
  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
  redirect('user');
 }


  function deletephoto($id){
  $update['image']='';
  $this->db->where('id',$id);
  $this->db->update('user', $update);
  redirect('user/edit/'.$id);
 }
 
  function copydellgroup(){
  if (@$_POST['id']){
   $this->model_user->copyDellGroup($_POST['copy_dell_group'],$_POST['id']);
   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
  }
  redirect('user');
 }
 
 
 
 ///////////////// adddopfield
 
 function adddopfield($action='list', $dopfield_id=0){
	switch($action){
		case 'copydellgroup': 
			if (@$_POST['id']){
			   $this->model_user->copyDellGroup_adddopfield($_POST['copy_dell_group'],$_POST['id']);
			   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
			  }
			  redirect('user/adddopfield/list');
		
		
			break;
		case 'add': 
			
			$this->action_adddopfield ="add";
			  if(isset($_POST['edit'])){
			   if($this->model_user->add_data_dopfield($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
				redirect('user/adddopfield/list');
			   }
			  }

			  $this->load->view("edit_dopfield",$this);
  
			break;
		
		case 'edit': 
			$this->action_adddopfield ="edit";
			  if (empty($_POST["id"])) $_POST["id"]  = $dopfield_id;
			  if(isset($_POST['edit'])){
			   if($this->model_user->edit_data_dopfield($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
				redirect('user/adddopfield/list/');
			   }
			  }
			  $this->item = $this->model_user->get_info_dopfield($dopfield_id);
			  $this->item_lang = $this->model_user->get_info_dopfield_lang($dopfield_id);
			  $this->load->view("edit_dopfield",$this);
			
			break;
		case 'delete': 
			
			$this->db->where('id',$dopfield_id);
			  $q = $this->db->get('user_dopfields');
			  if ($q->num_rows()) {
				$data = reset($q->result_array());
			   if($this->model_user->delete_data_dopfield($dopfield_id)){
				 $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
			   }
			  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
			  redirect('user/adddopfield/list/');
		
			break;
		case 'list': 
			$this->list_dopfield = $this->model_user->get_list_dopfield();
			$this->load->view("main_dopfield",$this);
			break;
			
		default: break;
	}

 }
 

 ///////////////// addgroup
 
 function addgroupus($action='list', $dopfield_id=0){
	switch($action){
		case 'copydellgroup': 
			if (@$_POST['id']){
			   $this->model_user->copyDellGroup_addgroupus($_POST['copy_dell_group'],$_POST['id']);
			   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
			  }
			  redirect('user/addgroupus/');
		
		
			break;
		case 'add': 
			
			$this->action_addgroupus ="add";
			  if(isset($_POST['edit'])){
			   if($this->model_user->add_data_group($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
				redirect('user/addgroupus/');
			   }
			  }

			  $this->load->view("edit_gus",$this);
  
			break;
		
		case 'edit': 
			$this->action_addgroupus ="edit";
			  if (empty($_POST["id"])) $_POST["id"]  = $dopfield_id;
			  if(isset($_POST['edit'])){
			   if($this->model_user->edit_data_group($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
				redirect('user/addgroupus/');
			   }
			  }
			  $this->item = $this->model_user->get_info_group($dopfield_id);
			  $this->groups = $this->model_user->get_list_dopfield();
			  $this->load->view("edit_gus",$this);
			
			break;
		case 'delete': 
			
			$this->db->where('id',$dopfield_id);
			  $q = $this->db->get('user_groups');
			  if ($q->num_rows()) {
				$data = reset($q->result_array());
			   if($this->model_user->delete_data_group($dopfield_id)){
				 $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
			   }
			  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
			  redirect('user/addgroupus/');
		
			break;
		case 'list': 
			$this->list_gus = $this->model_user->get_list_group();
			$this->load->view("main_gus",$this);
			break;
			
		default: break;
	}

 }
 
  function delete_field($field){
         $update['active']=0;
		 $this->db->where('module_name','user');
		 $this->db->where('field_name',$field);
		 $this->db->update('modules_table_fields',$update);
		redirect('user/add');
    }


}