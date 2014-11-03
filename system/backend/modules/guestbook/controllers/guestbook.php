<?

class Guestbook extends Controller {

var $modules;
var $pagination_link;

 function Guestbook (){
  parent::Controller();

  $this->load->model('model_guestbook');
  $this->load->helper('editor');
  $this->load->language('strings');
  $this->load->language('module');


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
  $this->list = $this->model_guestbook->get_list(50,$page);
  
  
  $this->load->library('pagination');

	$config['base_url'] = '/_admin/guestbook/index/';
	$config['total_rows'] = $this->model_guestbook->get_list_all();;
	$config['per_page'] = '50';
	$config['uri_segment'] = 3;
	$config['num_links'] = 5;

	$this->pagination->initialize($config);

	$this->pagination_link = $this->pagination->create_links();
  
  
  
  $this->load->view("main",$this);
 }

 function edit($id){
  $this->action ="edit";
  if (empty($_POST["id"])) $_POST["id"]  = $id;
  if(isset($_POST['edit'])){
   if($this->model_guestbook->edit_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
    redirect('guestbook');
   }
  }
  $this->item = $this->model_guestbook->get_info($id);
  $this->load->view("edit",$this);
 }

 function delete($id){
  $this->db->where('id',$id);
  $q = $this->db->get('guestbook');
  if ($q->num_rows()) {
	$data = reset($q->result_array());
   if($this->model_guestbook->delete_data($id)){
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image'].".jpg");
   @unlink($_SERVER['DOCUMENT_ROOT'].$this->image_path.@$data['image']."_thumb.jpg");
     $this->session->set_flashdata('msg',$this->lang->line('msg_deleted'));
   }
  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
  redirect('guestbook');
 }

 function copydellgroup(){
  if (@$_POST['id']){
   $this->model_guestbook->copyDellGroup($_POST['copy_dell_group'],$_POST['id']);
   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
  }
  redirect('guestbook');
 }


}