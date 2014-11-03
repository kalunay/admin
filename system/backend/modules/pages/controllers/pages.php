<?

Class Pages extends Controller {

var $modules;

	function Pages(){
		parent::Controller();
        $this->load->model('model_pages');
        $this->load->helper('editor');
        $this->load->language('strings');
		
		// Get active modules
		$this->getActiveModules();
	}
	
	function index(){
		$this->ilist();
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
	
	
  function savearrange(){
    parse_str($_POST['post'],$data);
    $data = array_shift($data);
  
  		//print_r($_POST);
	
    foreach($data as $pos => $cat_id){
      $this->db->where('page_id',$cat_id);
      $this->db->update('pages',array('arrange'=>$pos));
   	}
    echo "<p class='msg done'>".$this->lang->line('arrange_saved')."</p>";

  }
	
	
	function ilist(){
	    $lists = $this->model_pages->get_pages();
		
		$data['list'] = array();
		  if ($lists) foreach($lists as $list){
		   $data['list'][(int)$list['parent_id']][$list['id']] = $list;
		  }
		
		$data['modules'] = $this->modules;
		$this->load->view("content+pages",$data);
	}
	
    function add(){
        $data = array();
        if(isset($_POST['add'])){
          if($this->model_pages->add_page($_POST)){
            $this->session->set_flashdata('msg',$this->lang->line('msg_page_added'));
            redirect('pages');
          }
        }

		$data['options'] = $this->model_pages->get_pages_active();
		
		$data['options_gallery_cat_id'] = $this->model_pages->get_gallery();
		
		$data['modules'] = $this->modules;
		$this->load->view("content+pages+add",$data);
    }

    function edit($id){
        $data = array();
        if(isset($_POST['edit'])){
          if($this->model_pages->edit_page($_POST)){
            $this->session->set_flashdata('msg',$this->lang->line('msg_page_saved'));
            redirect('pages');
          }
        }
		
		$data['item'] = $this->model_pages->get_id($id);
		
		$data['item_lang'] = $this->model_pages->get_lang_id($id);
		
		$data['options'] = $this->model_pages->get_pages_active();
		
		$data['options_gallery_cat_id'] = $this->model_pages->get_gallery();
		
		$data['modules'] = $this->modules;
		$this->load->view("content+pages+edit",$data);
    }

    function delete($id){
          if($this->model_pages->delete_page($id)){
            $this->session->set_flashdata('msg',$this->lang->line('msg_page_deleted'));
          }
		redirect('pages');
    }

   	function copydellgroup(){
		if (@$_POST['id']){
		$this->model_pages->copyDellGroup($_POST['copy_dell_group'],$_POST['id']);
		$this->session->set_flashdata('msg',($_POST['copy_dell_group']=='dell'?$this->lang->line('msg_pagegroup_copied'):$this->lang->line('msg_pagegroup_deleeted')));
		}
		redirect('pages');
	}
	
    function delete_field($field){
         $update['active']=0;
		 $this->db->where('module_name','pages');
		 $this->db->where('field_name',$field);
		 $this->db->update('modules_table_fields',$update);
		redirect('pages/add');
    }


	
}