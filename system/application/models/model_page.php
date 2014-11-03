<?
class Model_page extends Model{

 function Model_page(){
  parent::Model();
 } 

function getPage($alias){
	$this->db->where('alias',$alias);
	$this->db->where('publish',1);
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q;
	}else{
		return 0;
	}
}

function getNumPage(){
	$this->db->where('publish',1);
	$q = $this->db->get('pages');
	return $q->num_rows();

}

function getNumGuestbook(){
	$this->db->where('publish',1);
	$q = $this->db->get('guestbook');
	return $q->num_rows();

}

function getGuestbook($limit=20,$offset=0){
	
	$this->db->where('publish',1);
	$this->db->limit($limit,$offset);
	$this->db->order_by('date','desc');
	$q = $this->db->get('guestbook');
	if($q->num_rows()>0){
		return $q->result_array();
	}else{
		return 0;
	}
}

function setGuestbook($post){
	
	$insert['name']=$post['fio'];
	$insert['email']=$post['email'];
	$insert['text']=$post['text'];
	$insert['date']=date('Y-m-d');
	$insert['publish']=0;
	
	if($this->db->insert('guestbook',$insert)){
		return 1;
	}else{
		return 0;
	}
}

function getPagesMenuTop(){
	$this->db->where('show_menu_top',1);
	$this->db->where('publish',1);
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q;
	}else{
		return 0;
	}
}

function getPagesMenuRight(){
	$this->db->where('show_menu_right',1);
	$this->db->where('publish',1);
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q;
	}else{
		return 0;
	}
}

function getPagesMenuBottom(){
	$this->db->where('show_menu_bottom',1);
	$this->db->where('publish',1);
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q;
	}else{
		return 0;
	}
}

function getPagesMenuLeft(){
	$this->db->where('show_menu_left',1);
	$this->db->where('publish',1);
	$q = $this->db->get('pages');
	if($q->num_rows()>0){
		return $q;
	}else{
		return 0;
	}
}
 
 
}