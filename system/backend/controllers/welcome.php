<?php

class Welcome extends Controller {

	var $modules;
	var $optionrcc;
	var $optionrcc_result;
	
	function Welcome()
	{
		parent::Controller();
        $this->load->language('strings');
		$this->load->model('model_users');
		
		// Get active modules
		$this->getActiveModules();
	}
	
	function index()
	{
		if($this->db->table_exists('news')){
		// rcc
		$this->optionrcc_result ='';
		if(isset($_POST['rccok']) && $_POST['rccok']=='Разослать'){
			$msgrcc='';
			if($_POST['newsrassylka'][0]=='all'){
				
				$this->db->where('publish',1);
				$this->db->order_by('pos','desc');
				$qrccn = $this->db->get('news');
				if($qrccn->num_rows()>0){
					$msgrcc.='<table border="0" cellpadding="3" cellspacing="0">';
					foreach($qrccn->result_array() as $rccn){
						$msgrcc.='<tr>
						'.(isset($rccn['image']) && $rccn['image']!=''?'
						<td valign="top" align="justify" width="200">
							<img src="http://'.$_SERVER['SERVER_NAME'].'/userfiles/image/news/'.$rccn['image'].'" alt="" width="200" />
						</td>
						':'').'
						<td valign="top" align="justify" colspan="2">
						<strong>'.$rccn['name'].'</strong><br />'.$rccn['text'].'
						</td>
						</tr>';
					}
					$msgrcc.='</table>';
				}
				
			}else{
			
				$ircc=0;
				$msgrcc.='<table border="0" cellpadding="3" cellspacing="0">';
				while(isset($_POST['newsrassylka'][$ircc])){
					$this->db->where('publish',1);
					$this->db->where('id',$_POST['newsrassylka'][$ircc]);
					$qrccn = $this->db->get('news');
					if($qrccn->num_rows()>0){
						foreach($qrccn->result_array() as $rccn){
							$msgrcc.='<tr>
							'.(isset($rccn['image']) && $rccn['image']!=''?'
							<td valign="top" align="justify" width="200">
								<img src="http://'.$_SERVER['SERVER_NAME'].'/userfiles/image/news/'.$rccn['image'].'" alt="" width="200" />
							</td>
							':'').'
							<td valign="top" align="justify" colspan="2" width="100%">
							<strong>'.$rccn['name'].'</strong><br />'.$rccn['text'].'
							</td>
							</tr>';
						}
					}
					$ircc++;
				}
				$msgrcc.='</table>';
			
			}
			
				$nrss=0;
				$all_nrss=0;
				$qmr = $this->db->get('mailer');
				if($qmr->num_rows()>0){
					foreach($qmr->result_array() as $rmr){
						mail($rmr['mail'], 'Новости сайта http://'.$_SERVER['SERVER_NAME'], $msgrcc, 'From: admin@'.$_SERVER['SERVER_NAME']."\r\n".'Content-Type: text/html; charset=utf-8');
					}					
					$nrss=1;
					$all_nrss += $qmr->num_rows();
				}
				
				$this->db->where('mailer', 1);
				$qmr2 = $this->db->get('user');
				if($qmr2->num_rows()>0){
					foreach($qmr2->result_array() as $rmr2){
						mail($rmr2['email'], 'Новости сайта http://'.$_SERVER['SERVER_NAME'], $msgrcc, 'From: admin@'.$_SERVER['SERVER_NAME']."\r\n".'Content-Type: text/html; charset=utf-8');
					}					
					$nrss=1;
					$all_nrss += $qmr2->num_rows();
				}
				
				if($nrss==1){
					$this->optionrcc_result = '<p>Новости разосланы<br />по '.$all_nrss.' адресам.</p>';
				}
			
			
		}
		
		$this->db->where('publish',1);
		$this->db->order_by('pos','desc');
		$qrcc = $this->db->get('news');
		if($qrcc->num_rows()>0){
			$this->optionrcc='';
			foreach($qrcc->result_array() as $rcc){
				$this->optionrcc.='<option value="'.$rcc['id'].'">('.$rcc['date'].') '.$rcc['name'].'</option>';
			}
		}
		/////// rcc
		}
					
		$this->load->view('welcome', $this);
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

    function login(){
      $msg = array();
      $msg['warning'] = 0;
      if(isset($_POST['login'])){
	  
	  $this->db->where('name',$_POST['login']);
	  $this->db->where('psw',md5($_POST['pass']));
	  $qp = $this->db->get('config');
	  
      if($qp->num_rows()>0 && $_POST['login']=='admin'){
        $this->session->set_userdata('admin','1');
        redirect('');
      }elseif($qp->num_rows()>0 && $_POST['login']=='manager'){
        $this->session->set_userdata('admin','2');
        redirect('');
      }else{
        $msg['warning'] = '1';
      }
      }
      $this->load->view('login',$msg);

    }

    function logout(){
      $this->session->sess_destroy();
      $this->session->unset_userdata('admin');
      redirect();
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */