<?

class Basket extends Controller {
var $modules;

 function Basket(){
  parent::Controller();
  $this->load->model('model_basket');
  $this->load->helper('editor');
  $this->load->language('strings');
  $this->load->language('module');
  $this->load->library('pagination');


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
  $this->list = $this->model_basket->get_list(20,$page);
  
		$config['base_url'] = '/_admin/basket/ilist/';
		$config['total_rows'] = $this->model_basket->get_listAll();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;

		$this->pagination->initialize($config);

		$this->pagination_link = $this->pagination->create_links();
  
  $this->load->view("main",$this);
 }
 
  function archive($page=0){
  $this->list = $this->model_basket->get_list_archive(20,$page);
  
  		$config['base_url'] = '/_admin/basket/archive/';
		$config['total_rows'] = $this->model_basket->get_list_archiveAll();
		$config['per_page'] = '20';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;

		$this->pagination->initialize($config);

		$this->pagination_link = $this->pagination->create_links();
  
  $this->load->view("main_archive",$this);
 }
 
   function valuta($action='list',$id=0){
   switch($action){
	case 'list':
		$this->list = $this->model_basket->get_list_valuta();
		$this->load->view("main_valuta",$this);
	break;
	case 'add':
	$this->action ="add";
		if(isset($_POST['edit'])){
		   if($this->model_basket->add_valuta($_POST)){
			$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
			redirect('basket/valuta');
		   }
		  }
		  $this->load->view("edit_valuta",$this);
	break;
	case 'edit':
$this->action ="edit";	
		if(isset($_POST['edit'])){
		$_POST["id"] = $id;
		   if($this->model_basket->edit_valuta($_POST)){
			$this->session->set_flashdata('msg',$this->lang->line('msg_added'));
			redirect('basket/valuta');
		   }
		  }
		  $this->item = $this->model_basket->get_valuta($id);
		  $this->load->view("edit_valuta",$this);
	break;
	case 'delete':
		$this->db->where('id',$id);
		  $q = $this->db->get('basket_vals');
		  if ($q->num_rows()) {
			$data = reset($q->result_array());
		   $this->model_basket->delete_valuta($id);
		  }
		  redirect('basket/valuta');
	break;
	default:
		  $this->list = $this->model_basket->get_list_valuta();
		  $this->load->view("main_valuta",$this);
	break;
   }
 }

 function add(){
  $this->action ="add";
  if(isset($_POST['edit'])){
   if($this->model_basket->add_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_added'));
    redirect('basket');
   }
  }
  $this->load->view("edit",$this);
 }

 function edit($id){
  $this->action ="edit";
  if (empty($_POST["id"])) $_POST["id"]  = $id;
  if(isset($_POST['edit'])){
   if($this->model_basket->edit_data($_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_edit'));
    redirect('basket');
   }
  }
  $this->item = $this->model_basket->get_info($id);
  $this->load->view("edit",$this);
 }

 function delete($id){
  $this->db->where('id',$id);
  $q = $this->db->get('basket');
  if ($q->num_rows()) {
	$data = reset($q->result_array());
   $this->model_basket->delete_data($id);
  } else $this->session->set_flashdata('msg',"#$id: ".$this->lang->line('msg_record_not_found'));
  redirect('basket');
 }
 
 function copydellgroup(){
  if (@$_POST['id']){
   $this->model_basket->copyDellGroup($_POST['copy_dell_group'],$_POST['id']);
   $this->session->set_flashdata('msg',$this->lang->line('msg_group_'.$_POST['copy_dell_group']));
  }
  redirect('basket');
 }
 
 function delete_field($field){
         $update['active']=0;
		 $this->db->where('module_name','basket');
		 $this->db->where('field_name',$field);
		 $this->db->update('modules_table_fields',$update);
		redirect('basket/add');
    }


}