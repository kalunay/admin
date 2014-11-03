<?

class News extends Controller {
 var $image_path ="/userfiles/image/news/";
var $modules;

 function News (){
  parent::Controller();
  $this->load->model('model_img_upload');
  $this->load->model('model_news');
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
  $this->list = $this->model_news->get_list();
  $this->load->view("main",$this);
 }

 function add(){
  $this->action ="add";
  if(isset($_POST['edit'])){
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_news->add_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_added'));
    redirect('news');
   }
  }
  $this->load->view("edit",$this);
 }

 function edit($id){
  $this->action ="edit";
  if (empty($_POST["id"])) $_POST["id"]  = $id;
  if(isset($_POST['edit'])){
   $_POST['image'] = $this->model_img_upload->imageUpload($this->imUploadConfig);
   if($this->model_news->edit_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
    redirect('news');
   }
  }
  $this->item = $this->model_news->get_info($id);
  $this->item_lang = $this->model_news->get_lang_info($id);
  $this->load->view("edit",$this);
 }

 function delete($id){
  $this->db->where('id',$id);
  $q = $this->db->get('news');
  if ($q->num_rows()) {
	$data = reset($q->result_array());
   if($this->model_news->delete_data($id)){
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image'].".jpg");
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image']."_thumb.jpg");
     $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
   }
  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
  redirect('news');
 }
 
  function deletephoto($id){
  $update['image']='';
  $this->db->where('id',$id);
  $this->db->update('news', $update);
  redirect('news/edit/'.$id);
  //$this->item = $this->model_news->get_info($id);
  //$this->load->view("edit",$this);
 }

 function copydellgroup(){
  if (@$_POST['id']){
   $this->model_news->copyDellGroup($_POST['copy_dell_group'],$_POST['id']);
   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
  }
  redirect('news');
 }
 
 function delete_field($field){
         $update['active']=0;
		 $this->db->where('module_name','news');
		 $this->db->where('field_name',$field);
		 $this->db->update('modules_table_fields',$update);
		redirect('news/add');
    }


}