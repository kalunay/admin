<?

class Model_guestbook extends Model {
 function Model_guestbook(){
  parent::Model();

 }


 function get_list($limit=20,$offset=0){
 // $this->db->limit($limit,$offset);
  $this->db->order_by('date','desc');
  $q = $this->db->get('guestbook');
  return $q->result_array();
 }
 
  function get_list_all(){
  $this->db->order_by('date','desc');
  $q = $this->db->get('guestbook');
  return $q->num_rows();
 }

 function get_info($id){
  $this->db->where('id',$id);
  $q = $this->db->get('guestbook');
  return reset($q->result_array());
 }

 function add_data($aData){
  $aInsert = array(
  "name"=>$aData['name'],
  "date"=>$aData['date'],
  "email"=>$aData['email'],
  "text"=>$aData['text'],
  "publish"=>$aData['publish']
  );
  return $this->db->insert('guestbook',$aInsert);
 }

 function edit_data($aData){
  $aUpdate = array(
  "name"=>$aData['name'],
  "date"=>$aData['date'],
  "email"=>$aData['email'],
  "text"=>$aData['text'],
  "answer"=>$aData['answer'],
  "publish"=>$aData['publish']
  );
  $this->db->where('id',$aData['id']);
  return $this->db->update('guestbook',$aUpdate);
 }

 function delete_data($id){
  $this->db->where('id',$id);
  return $this->db->delete('guestbook');
 }

 function copyDellGroup($type,$id){
  switch ($type){
   case "del":
   foreach ($id as $item){
    $this->db->query("DELETE FROM `guestbook` WHERE `id` = $item");
   }
   break;

  }

 }


}