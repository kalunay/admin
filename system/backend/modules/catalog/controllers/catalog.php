<?

class Catalog extends Controller {
 var $image_path ="/userfiles/image/catalog/";
var $modules;

 function Catalog(){
  parent::Controller();
  $this->load->model('model_img_upload');
  $this->load->model('model_catalog');
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
  $this->lists = $this->model_catalog->get_list();
  
  $data['list'] = array();
  if ($this->lists) foreach($this->lists as $list){
   $data['list'][(int)$list['parent_id']][$list['id']] = $list;
  }
  $this->list = $data['list'];
  
  $this->load->view("main",$this);
 }

 function add(){
  $this->action ="add";
  if(isset($_POST['edit'])){
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_catalog->add_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_added'));
    redirect('catalog');
   }
  }
  $this->options = $this->model_catalog->get_catalog_active();
  $this->options_gallery_cat_id = $this->model_catalog->get_catalog_gallery();
  $this->load->view("edit",$this);
 }

 function edit($id){
  $this->action ="edit";
  if (empty($_POST["id"])) $_POST["id"]  = $id;
  if(isset($_POST['edit'])){
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_catalog->edit_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
    redirect('catalog');
   }
  }
  $this->item = $this->model_catalog->get_info($id);
  $this->item_lang = $this->model_catalog->get_info_lang($id);
  $this->options = $this->model_catalog->get_catalog_active();
  $this->options_gallery_cat_id = $this->model_catalog->get_catalog_gallery();
  $this->dopfields = $this->model_catalog->get_list_dopfield();
  $this->load->view("edit",$this);
 }

 function delete($id){
  $this->db->where('id',$id);
  $q = $this->db->get('catalog');
  if ($q->num_rows()) {
	$data = reset($q->result_array());
   if($this->model_catalog->delete_data($id)){
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image'].".jpg");
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image']."_thumb.jpg");
     $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
   }
  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
  redirect('catalog');
 }
 
  function deletephoto($id){
  $update['image']='';
  $this->db->where('id',$id);
  $this->db->update('catalog', $update);
  redirect('catalog/edit/'.$id);
  //$this->item = $this->model_catalog->get_info($id);
  //$this->load->view("edit",$this);
 }

 function copydellgroup(){
  if (@$_POST['id']){
   $this->model_catalog->copyDellGroup($_POST['copy_dell_group'],$_POST['id']);
   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
  }
  redirect('catalog');
 }
 
 
 
 
 ///////////////// objects
 
 function objects($action='list', $cat_id=0, $object_id=0){
	switch($action){
		case 'copydellgroup': 
			if (@$_POST['id']){
			   $this->model_catalog->copyDellGroup_object($_POST['copy_dell_group'],$_POST['id']);
			   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
			  }
			  redirect('catalog/objects/list/'.$cat_id);
		
		
			break;
		case 'add': 
			
			$this->action_object ="add";
			  if(isset($_POST['edit'])){
			   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
			   if($this->model_catalog->add_data_object($_POST, $cat_id)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
				redirect('catalog/objects/list/'.$cat_id);
			   }
			  }
			  $this->cat_id = $cat_id;
			  $this->options_gallery_cat_id = $this->model_catalog->get_catalog_gallery();
			  $this->dopfields = $this->model_catalog->get_list_dopfield();
			  $this->load->view("edit_object",$this);
  
			break;
		
		case 'edit': 
			$this->action_object ="edit";
			  if (empty($_POST["id"])) $_POST["id"]  = $object_id;
			  if(isset($_POST['edit'])){
			   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
			   if($this->model_catalog->edit_data_object($_POST, $cat_id)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
				redirect('catalog/objects/list/'.$cat_id);
			   }
			  }
			  $this->cat_id = $cat_id;
			  $this->object_id = $object_id;
			  $this->item = $this->model_catalog->get_info_object($object_id);
			  $this->item_lang = $this->model_catalog->get_info_object_lang($object_id);
			  $this->options_gallery_cat_id = $this->model_catalog->get_catalog_gallery();
			  $this->dopfields = $this->model_catalog->get_list_dopfield();
			  $this->load->view("edit_object",$this);
			
			break;
		case 'delete': 
			
			$this->db->where('id',$object_id);
			  $q = $this->db->get('catalog_object');
			  if ($q->num_rows()) {
				$data = reset($q->result_array());
			   if($this->model_catalog->delete_data_object($object_id)){
			   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image'].".jpg");
			   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image']."_thumb.jpg");
				 $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
			   }
			  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
			  redirect('catalog/objects/list/'.$cat_id);
		
			break;
		case 'deletephoto': 
			
			  $update['image']='';
			  $this->db->where('id',$object_id);
			  $this->db->update('catalog_object', $update);
			  redirect('catalog/objects/edit/'.$cat_id.'/'.$object_id);
			break;
		case 'list': 
			$this->cat_id = $cat_id;
			$this->list_objects = $this->model_catalog->get_list_objects($cat_id);
			$this->load->view("main_object",$this);
			break;
		case 'delete_field': 
			$update['active']=0;
			 $this->db->where('module_name','catalog_object');
			 $this->db->where('field_name',$object_id);
			 $this->db->update('modules_table_fields',$update);
			redirect('catalog/objects/add/'.$cat_id);
			break;
			
		default: break;
	}

 }
 
 ///////////////// adddopfield
 
 function adddopfield($action='list', $dopfield_id=0){
	switch($action){
		case 'copydellgroup': 
			if (@$_POST['id']){
			   $this->model_catalog->copyDellGroup_adddopfield($_POST['copy_dell_group'],$_POST['id']);
			   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
			  }
			  redirect('catalog/adddopfield/list');
		
		
			break;
		case 'add': 
			
			$this->action_adddopfield ="add";
			  if(isset($_POST['edit'])){
			   if($this->model_catalog->add_data_dopfield($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
				redirect('catalog/adddopfield/list');
			   }
			  }

			  $this->load->view("edit_dopfield",$this);
  
			break;
		
		case 'edit': 
			$this->action_adddopfield ="edit";
			  if (empty($_POST["id"])) $_POST["id"]  = $dopfield_id;
			  if(isset($_POST['edit'])){
			   if($this->model_catalog->edit_data_dopfield($_POST)){
				$this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
				redirect('catalog/adddopfield/list/');
			   }
			  }
			  $this->item = $this->model_catalog->get_info_dopfield($dopfield_id);
			  $this->item_lang = $this->model_catalog->get_info_dopfield_lang($dopfield_id);
			  $this->load->view("edit_dopfield",$this);
			
			break;
		case 'delete': 
			
			$this->db->where('id',$dopfield_id);
			  $q = $this->db->get('catalog_dopfields');
			  if ($q->num_rows()) {
				$data = reset($q->result_array());
			   if($this->model_catalog->delete_data_dopfield($dopfield_id)){
				 $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
			   }
			  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
			  redirect('catalog/adddopfield/list/');
		
			break;
		case 'list': 
			$this->list_dopfield = $this->model_catalog->get_list_dopfield();
			$this->load->view("main_dopfield",$this);
			break;
			
		default: break;
	}

 }

 
     function delete_field($field){
         $update['active']=0;
		 $this->db->where('module_name','catalog');
		 $this->db->where('field_name',$field);
		 $this->db->update('modules_table_fields',$update);
		redirect('catalog/add');
    }
 

}