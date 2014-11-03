<?php

class Main extends Controller{

var $alias='';


 function Main() 

 { 

  parent::Controller();
  $this->load->model('model_page');

 }
 
/////////////////////////////////////////////////////////////////////////////////  Parametrs

 function parametrs(){
 
  //////////////// page START

 $q = $this->model_page->getPage($this->alias);

   if($q){

	   $r = $q->result_array();
	   $data['page'] = $r[0];

   }else{
		
	/*	if($this->model_page->getNumPage()){
   
		   $this->page['title'] = 'Страница не найдена';
		   $this->page['name'] = 'Ошибка 404';
		   $this->page['text'] = 'Страница не найдена.';
		   $this->page['alias'] = 'error';
		   $this->output->set_status_header('404');
		   redirect('/','refresh');
	   
	   }else{*/
	   
		   $data['page']['title'] = 'Новый сайт';
		   $data['page']['name'] = 'Новый сайт';
		   $data['page']['text'] = 'В разработке ...';
		   $data['page']['id'] = 0;
		   $data['page']['parent_id'] = 0;
		   $data['page']['menu_name'] = '';
		   $data['page']['keywords'] = '';
		   $data['page']['description'] = '';
		   $data['page']['alias'] = '/';
		   $data['page']['date'] = '';
		   $data['page']['modify'] = '';
		   $data['page']['show_menu_top'] = 0;
		   $data['page']['show_menu_right'] = 0;
		   $data['page']['show_menu_bottom'] = 0;
		   $data['page']['show_menu_left'] = 0;
		   $data['page']['publish'] = 0;
		   $data['page']['pos'] = 0;
	   
	   //}
   
   }
   
   $qmt = $this->model_page->getPagesMenuTop();
   if($qmt){
		$data['page']['array_menu_top'] = $qmt->result_array();
	}else{
		$data['page']['array_menu_top'] = 0;
   }
   
   $qmr = $this->model_page->getPagesMenuRight();
   if($qmr){
		$data['page']['array_menu_right'] = $qmr->result_array();
	}else{
		$data['page']['array_menu_right'] = 0;
   }
   
   $qmb = $this->model_page->getPagesMenuBottom();
   if($qmb){
		$data['page']['array_menu_bottom'] = $qmb->result_array();
	}else{
		$data['page']['array_menu_bottom'] = 0;
   }
   
   $qml = $this->model_page->getPagesMenuLeft();
   if($qml){
		$data['page']['array_menu_left'] = $qml->result_array();
	}else{
		$data['page']['array_menu_left'] = 0;
   }
   
////////////////////// page END

return $data;

 }

 
 
 ////////////////////////////////////////////////////////////////////////////////////////// guestbook
 
 function guestbook($page=0){
 
 $t = '<p align="right"><a href="/guestbook/add">Добавить отзыв</a></p>';
 
 if($_SERVER['REQUEST_URI']=='/guestbook/add'){
 
 
 if(isset($_POST['ok'])){
	include("securimage/securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true && isset($_POST['fio']) && $_POST['fio']!='' && isset($_POST['text']) && $_POST['text']!='') {
  
	$this->model_page->setGuestbook($_POST);
  
    $t .= "<h2>Спасибо, введён верный код.</h2>";
  } else {
    $t .= "<h2>Извините, введён неправильный код или не все обязательные поля заполнены.  <a href=\"javascript:history.go(-1)\">Go back</a> попробуйте снова.</h2>";
  }
 }
 
 
 $t.='
 <br />
 <form action="" method="post" name="guestbookform">
 <table width="400" border="0">
 <tr><td align="right">Имя *</td><td align="left"><input type="text" name="fio" value=""></td></tr>
 <tr><td align="right">Email</td><td align="left"><input type="text" name="email" value=""></td></tr>
 <tr><td align="right" valign="top">Отзыв *</td><td align="left"><textarea name="text"></textarea></td></tr>
 <tr><td align="right">&nbsp;</td><td align="left"><img src="/securimage/securimage_show.php?sid='.md5(uniqid(time())).'"></td></tr>
 <tr><td align="right">&nbsp;</td><td align="left"><input type="text" name="code" /></td></tr>
 <tr><td align="right">&nbsp;</td><td align="left"><input type="submit" name="ok" value="Отправить" /></td></tr>
 </table><br />
 * - обязательные для ввода поля.
 </form>
 <br />
 ';
 }

 
	if ($this->db->table_exists('guestbook')){
	
		$rgb = $this->model_page->getGuestbook(2,$page);
	   
	   $this->load->library('pagination');

		$config['base_url'] = '/guestbook/';
		$config['total_rows'] = $this->model_page->getNumGuestbook();
		$config['per_page'] = '2';
		$config['uri_segment'] = 2;
		$config['num_links'] = 5;

		$this->pagination->initialize($config);

		$pagination_link = $this->pagination->create_links();
		
		if($rgb){
			
			$t .='<table border="0" width="100%" cellpadding="3" cellspacing="0">';
			
			foreach($rgb as $r){
				$t .='<tr><td valign="top">'.(isset($r['email'])?'<a href="mailto:'.$r['email'].'">':'').$r['name'].(isset($r['email'])?'</a>':'').' : '.$r['date'].'</td></tr>
					<tr><td valign="top" align="justify">'.$r['text'].'</td></tr>';
			}
			$t .='</table>';
			$t .='<br /><br />'.$pagination_link;
			
			
		}
		
	   
	}
 
 return $t;
 }
 
 
 

 /////////////////////////////////////////////////////////////////////////////////////////// index
 function index($alias="index",$page=0){

 $this->alias = $alias;
 $data = $this->parametrs(); 

 
 // guestbook
 if($alias=='guestbook'){
	$data['guestbook'] = $this->guestbook($page);
	}else{
	$data['guestbook'] = '';
	}
 //////////////////// views 

  $this->load->view('main_view', $data);

 }
	 



}

