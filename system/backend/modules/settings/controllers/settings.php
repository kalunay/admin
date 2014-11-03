<?

class Settings extends Controller {
 var $image_path ="/userfiles/image/settings/";
var $modules;

 function Settings(){
  parent::Controller();
  $this->load->model('model_img_upload');
  $this->load->model('model_settings');
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
	

 function index(){
  $this->ilist();
 }

 function ilist(){
  $this->item = $this->model_settings->get_list();
  $this->dopfields = $this->model_settings->get_list_dopfield();
  $this->mailer = $this->model_settings->get_list_mailer();
  $this->load->view("edit",$this);
 }

 function edit(){

  if(isset($_POST['edit'])){
  if(isset($_FILES['mp3file']) && $_FILES['mp3file']['name']!=''){
	copy($_FILES['mp3file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/medias/file.mp3');
  }
  
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_settings->edit_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
   }
  }
redirect('settings');
 }


  function deletephoto($id){
  $update['image']='';
  $this->db->where('id',1);
  $this->db->update('settings', $update);
  redirect('settings/edit/'.$id);
 }
 
 
 
 
 ///////////////// adddopfield
 
 function adddopfield($action='list', $dopfield_id=0){
	switch($action){
		case 'copydellgroup': 
			if (@$_POST['id']){
			   $this->model_settings->copyDellGroup_adddopfield($_POST['copy_dell_group'],$_POST['id']);
			   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
			  }
			  redirect('settings/adddopfield/list');
		
		
			break;
		case 'add': 
			
			$this->action_adddopfield ="add";
			  if(isset($_POST['edit'])){
			   if($this->model_settings->add_data_dopfield($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
				redirect('settings/adddopfield/list');
			   }
			  }

			  $this->load->view("edit_dopfield",$this);
  
			break;
		
		case 'edit': 
			$this->action_adddopfield ="edit";
			  if (empty($_POST["id"])) $_POST["id"]  = $dopfield_id;
			  if(isset($_POST['edit'])){
			   if($this->model_settings->edit_data_dopfield($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
				redirect('settings/adddopfield/list/');
			   }
			  }
			  $this->dopfields = $this->model_settings->get_list_dopfield($dopfield_id);
			  $this->item = $this->model_settings->get_info_dopfield($dopfield_id);
			  $this->item_lang = $this->model_settings->get_info_dopfield_lang($dopfield_id);
			  $this->load->view("edit_dopfield",$this);
			
			break;
		case 'delete': 
			
			$this->db->where('id',$dopfield_id);
			  $q = $this->db->get('settings_dopfields');
			  if ($q->num_rows()) {
				$data = reset($q->result_array());
			   if($this->model_settings->delete_data_dopfield($dopfield_id)){
				 $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
			   }
			  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
			  redirect('settings/adddopfield/list/');
		
			break;
		case 'list': 
			$this->list_dopfield = $this->model_settings->get_list_dopfield();
			$this->load->view("main_dopfield",$this);
			break;
			
		default: break;
	}

 }


}