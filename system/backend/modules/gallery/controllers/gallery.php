<?

Class Gallery extends Controller {

var $modules;

 function Gallery(){
  parent::Controller();
  $this->load->model('model_gallery');
  $this->load->helper('editor');
  $this->load->language('common');
  $this->load->language('strings');
  $this->load->library('session');
  
  
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
  $items = $this->model_gallery->get_gallery_cat();
  $data['items'] = array();
  if ($items) foreach($items as $item){
   $data['items'][(int)$item['parent_id']][$item['gallery_cat_id']] = $item;
  }
$data['modules'] = $this->modules;
  $this->load->view('content+gallery_cat',$data);
 }

 function upload (){
  $this->model_gallery->upload($_POST);
  redirect('gallery/edit/'.$_POST['gallery_cat_id']);
 }

 function delete_photo($gallery_cat_id,$photo_id){
  $this->model_gallery->delete_photo($photo_id);
  redirect('gallery/edit/'.$gallery_cat_id);
 }

 function add(){
  $data = array("action"=>"add");
  if(isset($_POST['save'])){
   if($this->model_gallery->save_gallery_cat("",$_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_item_added'));
    redirect('gallery');
   } else $this->session->set_flashdata('msg',$this->lang->line('msg_item_add_error'));
  }
  $data['modules'] = $this->modules;
  $this->load->view("content+gallery_cat+edit",$data);
 }

 function edit($id,$page=0){
  $data = array();
  if(isset($_POST['save'])){
   if($this->model_gallery->save_gallery_cat($id,$_POST)){
    $this->session->set_flashdata('msg',$this->lang->line('msg_item_saved'));
    redirect('gallery');
   } else $this->session->set_flashdata('msg',$this->lang->line('msg_item_save_error'));
  }
  
  if(!$this->session->userdata('perpage')){
	$this->session->set_userdata('perpage', 12);
  }

  $this->db->where('gallery_cat_id',$id);
  $q = $this->db->get('gallery_photo');
  $this->load->library('pagination');
  $config['base_url'] = "gallery/edit/$id/";
  $config['uri_segment'] = 4;
  $config['cur_tag_open'] = "<a href='gallery/edit/$id/$page' class='pagination-active'>";
  $config['cur_tag_close'] = '</a>';
  $config['next_link'] =  '&gt;';
  $config['prev_link'] = '&lt;';
  $config['first_link'] = '&lt;&lt;&lt;';
  $config['last_link'] = '&gt;&gt;&gt;';
  $config['num_links'] = 5;
  $config['total_rows'] = $q->num_rows();
  $config['per_page'] = $this->session->userdata('perpage');
  $this->pagination->initialize($config);

  $data['item'] = $this->model_gallery->get_info($id);
  $data['item_lang'] = $this->model_gallery->get_lang_info($id);
  $data['page'] = $page;
  $data['pagination'] = $this->pagination->create_links();
  $data['modules'] = $this->modules;
  $this->load->view("content+gallery_cat+edit",$data);
 }

 function delete($id){
  if ($this->model_gallery->delete_gallery_cat($id)) {
   $this->session->set_flashdata('msg',$this->lang->line('msg_item_deleted'));
  } else $this->session->set_flashdata('msg',$this->lang->line('msg_item_delete_error'));
  redirect('gallery');
 }

 function actionwith_cat(){
  if (@$_POST['gallery_cat_id']){
   $this->model_gallery->actionwith_cat($_POST['copy_dell_group'],$_POST['gallery_cat_id']);
  }
  redirect('gallery');
 }

 function actionwith_photo($cat_id){
  if (@$_POST['photo_id']){
   $this->model_gallery->actionwith_photo($_POST['action'],$_POST['photo_id']);
  }
  redirect('gallery/edit/'.$cat_id);
 }

 function enable_gallery_cat($gallery_cat_id){
  $this->model_gallery->enable_gallery_cat($gallery_cat_id);
  redirect('gallery');
 }
 function disable_gallery_cat($gallery_cat_id){
  $this->model_gallery->disable_gallery_cat($gallery_cat_id);
  redirect('gallery');
 }

 function enable_photo($gallery_cat_id,$photo_id){
  $this->model_gallery->enable_photo($photo_id);
  redirect('gallery/edit/'.$gallery_cat_id);
 }
 function disable_photo($gallery_cat_id,$photo_id){
  $this->model_gallery->disable_photo($photo_id);
  redirect('gallery/edit/'.$gallery_cat_id);
 }
 function perpage($gallery_cat_id){
 
 $this->model_gallery->if_new_name($gallery_cat_id);
 
  $this->session->set_userdata('perpage', $_POST['perpage']);
  redirect('gallery/edit/'.$gallery_cat_id);
 }
 
 
  function perpage_pagin($gallery_cat_id){

  $this->session->set_userdata('perpage', $_POST['perpage']);
  redirect('gallery/edit/'.$gallery_cat_id);
 }

 function pos(){
  parse_str($_POST['post'],$data);
  $data = array_shift($data);
//  print_r($data);

  foreach($data as $pos => $id){
   $this->db->where('photo_id',$id);
   if (!$this->db->update('gallery_photo',array('pos'=>$pos))) {
     echo "<p class='msg error'>".$this->lang->line("msg_pos_save_error")."</p>";
     exit;
   }
  }
  echo "<p class='msg done'>".$this->lang->line("msg_pos_saved")."</p>";

 }

 function pos_cat(){
  parse_str($_POST['post'],$data);
  $data = array_shift($data);
//  print_r($data);

  foreach($data as $pos => $id){
   $this->db->where('gallery_cat_id',$id);
   if (!$this->db->update('gallery',array('pos'=>$pos))) {
     echo "<p class='msg error'>".$this->lang->line("msg_pos_save_error")."</p>";
     exit;
   }
  }
  echo "<p class='msg done'>".$this->lang->line("msg_pos_saved")."</p>";

 }

    function delete_field($field){
         $update['active']=0;
		 $this->db->where('module_name','gallery');
		 $this->db->where('field_name',$field);
		 $this->db->update('modules_table_fields',$update);
		redirect('gallery/add');
    }

}