<?

class Model_basket extends Model {
 function Model_basket(){
  parent::Model();

 }

 function get_listAll(){
 $this->db->where('active',1);
  $this->db->order_by('id','desc');
  $q = $this->db->get('basket');
  return $q->num_rows();
 }
 
 function get_list($limit=20,$offset=0){
 $this->db->where('active',1);
 // $this->db->limit($limit,$offset);
  $this->db->order_by('id','desc');
  $q = $this->db->get('basket');
  return $q->result_array();
 }

  function get_list_archiveAll(){
  $this->db->where('active',0);
  $this->db->order_by('id','desc');
  $q = $this->db->get('basket');
  return $q->num_rows();
 }
 
  function get_list_archive($limit=20,$offset=0){
  $this->db->where('active',0);
  //$this->db->limit($limit,$offset);
  $this->db->order_by('id','desc');
  $q = $this->db->get('basket');
  return $q->result_array();
 }
 
  function get_list_valuta(){
  $this->db->order_by('name','asc');
  $q = $this->db->get('basket_vals');
  return $q->result_array();
 }

   function add_valuta($aData){
   
   if(isset($aData['now'])){
	$aUpdate['now']=0;
	$this->db->update('basket_vals',$aUpdate);
   }
   
   
  $aInsert = array(
  "name"=>(isset($aData['name'])?$aData['name']:''),
  "name_k"=>(isset($aData['name_k'])?$aData['name_k']:''),
  "value"=>(isset($aData['value'])?$aData['value']:0),
  "now"=>(isset($aData['now'])?$aData['now']:0)
  );
  $this->db->insert('basket_vals',$aInsert);
  
  return 1;
 }
 
    function edit_valuta($aData){
	
	 if(isset($aData['now'])){
	$aUpdate['now']=0;
	$this->db->update('basket_vals',$aUpdate);
   }
	
$aUpdate = array(
  "name"=>(isset($aData['name'])?$aData['name']:''),
  "name_k"=>(isset($aData['name_k'])?$aData['name_k']:''),
  "value"=>(isset($aData['value'])?$aData['value']:0),
  "now"=>(isset($aData['now'])?$aData['now']:0)
  );
  $this->db->where('id',$aData['id']);
  $this->db->update('basket_vals',$aUpdate);
  
  return 1;
 }
 
  function get_valuta($id){
  $this->db->where('id',$id);
  $q = $this->db->get('basket_vals');
  return reset($q->result_array());
 }
 
 function get_info($id){
  $this->db->where('id',$id);
  $q = $this->db->get('basket');
  return reset($q->result_array());
 }
 
 function selectObjects(){
  $this->db->order_by('name','asc');
  $q = $this->db->get('catalog_object');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
 function getUserName($id){
  $this->db->where('id',$id);
  $q = $this->db->get('user');
  if($q->num_rows()){
  $r = $q->result_array();
	return $r[0]['name'];
  }else{
	return 0;
  }
 }
 
 function selectUser(){
  $this->db->order_by('name','asc');
  $q = $this->db->get('user');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
  function selectObjectsZakaz($ozid){  
  $this->db->where('id',$ozid);
  $q = $this->db->get('catalog_object');
  if($q->num_rows()){
	return $q->result_array();
  }else{
	return 0;
  }
 }
 
   function selectPriceGroup($ozid){  
  $this->db->where('object_id ',$ozid);
  $this->db->where('field_id ',8);
  $q = $this->db->get('catalog_dopvalues');
  if($q->num_rows()){
	$r = $q->result_array();
	return $r[0]['value'];
  }else{
	return 0;
  }
 }
 
 function valnow(){
	$this->db->where('now',1);
	$qn = $this->db->get('basket_vals');
	if($qn->num_rows()>0){
		$rn = $qn->result_array();
		return $rn[0]['value'];
	}else{
		return 1;
	}
 }
 
 function converterValuta($sum=0){
	$t='';
	
	$know = $this->valnow();
	
	$qd = $this->db->get('basket_vals');
	if($qd->num_rows()>0){
		foreach($qd->result_array() as $rd){
		
			if($rd['now']==1){
				$t .= $sum.' '.$rd['name_k'].' (';
			}	
			
		}
		$ic=0;
		foreach($qd->result_array() as $rd){
		
			if($rd['now']!=1){
				$nols = $know*$sum/$rd['value'];
				$t .= ($ic!=0?', ':'').round($nols,2).' '.$rd['name_k'];
			}	
			$ic++;
		}
		$t.=')';
		return $t;
	}else{
		return 0;
	}
 
 }
 
    function selectPriceIndividual($ozid){  
  $this->db->where('object_id ',$ozid);
  $this->db->where('field_id ',9);
  $q = $this->db->get('catalog_dopvalues');
  if($q->num_rows()){
	$r = $q->result_array();
	return $r[0]['value'];
  }else{
	return 0;
  }
 }

 function add_data($aData){
 
 $iw=0;
 $oi='';
 while(isset($aData['object_id'][$iw])){
	$oi .= $aData['object_id'][$iw].'-';
	$iw++;
 }
 
  $aInsert = array(
  "name"=>(isset($aData['name'])?$aData['name']:''),
  "datetime"=>date('Y-m-d H:i:s'),
  "email"=>$aData['email'],
  "phone"=>(isset($aData['phone'])?$aData['phone']:''),
  "description"=>$aData['description'],
  "user_id"=>$aData['user_id'],
  "object_id"=>$oi,
  "modify"=>time(),
  "active"=>$aData['active'],
  "keygen"=>rand(100000,999999),
  "status"=>$aData['status']
  );
  $this->db->insert('basket',$aInsert);
  
  return 1;
 }

 function edit_data($aData){
 
  $iw=0;
 $oi='';
 while(isset($aData['object_id'][$iw])){
	$oi .= $aData['object_id'][$iw].'-';
	$iw++;
 }
 
  $aUpdate = array(
  "name"=>(isset($aData['name'])?$aData['name']:''),
  "email"=>$aData['email'],
  "phone"=>(isset($aData['phone'])?$aData['phone']:''),
  "description"=>$aData['description'],
  "object_id"=>$oi,
  "modify"=>time(),
  "active"=>$aData['active'],
  "status"=>$aData['status']
  );
  $this->db->where('id',$aData['id']);
  $this->db->update('basket',$aUpdate);
  
  return 1;
 }

 function delete_data($id){
  $this->db->where('id',$id);
  return $this->db->delete('basket');
 }
 
  function delete_valuta($id){
  $this->db->where('id',$id);
  return $this->db->delete('basket_vals');
 }

 function copyDellGroup($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `basket` WHERE `id` = $item");
   }
   break;

  }

 }
 
 function field_active($field=''){
 
	if($field!=''){
		$this->db->select('active');
		$this->db->where('module_name','basket');
		$this->db->where('field_name',$field);
		$q = $this->db->get('modules_table_fields')->result_array();
		if($q[0]['active']==1){
			return 1;
		}else{
			return 0;
		}
	}else{
		return 1;
	}
 
 }


}