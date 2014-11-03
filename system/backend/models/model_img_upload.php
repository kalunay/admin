<?

class Model_img_upload extends Model{
  function Model_img_upload(){
    parent::Model();
  }


 function transliterate ($text,$limit=0){                     // transliterate to small Eng
    $text = strToLower($text); // may don't work
    $tr_table = array (
 "À" => "a","Á" => "b","Â" => "v","Ã" => "g","Ä" => "d","Å" => "e","Æ" => "zh","Ç" => "z","È" => "i",
 "É" => "y","Ê" => "k","Ë" => "l","Ì" => "m","Í" => "n","Î" => "o","Ï" => "p","Ð" => "r","Ñ" => "s",
 "Ò" => "t","Ó" => "u","Ô" => "f","Õ" => "h","Ö" => "ts","×" => "ch","Ø" => "sh","Ù" => "sch","Ú" => "",
 "Û" => "y","Ü" => "","Ý" => "e","Þ" => "yu","ß" => "ya","¨" => "ye","ª" =>"e","¯"=>"i","²"=>"i",
 "à" => "a","á" => "b","â" => "v","ã" => "g","ä" => "d","å" => "e","æ" => "zh","ç" => "z","è" => "i",
 "é" => "y","ê" => "k","ë" => "l","ì" => "m","í" => "n","î" => "o","ï" => "p","ð" => "r","ñ" => "s",
 "ò" => "t","ó" => "u","ô" => "f","õ" => "h","ö" => "ts","÷" => "ch","ø" => "sh","ù" => "sch","ú" => "",
 "û" => "y","ü" => "","ý" => "e","þ" => "yu","ÿ" => "ya","¸" => "ye","º" =>"e","¿"=>"i","³"=>"i"," "=> "-"
    );
    $text = strtr($text,$tr_table);
    if (!is_int($limit)) $limit = strpos($text,$limit);
    if ($limit>0) $text = substr($text,0,$limit);
    return $text;
 
 }

 function imageUpload ($config=array()){
  if(isset($_FILES['userfile'])){
  $_FILES['userfile']['name'] = $this->transliterate($_FILES['userfile']['name']);
   $config['upload_path'] = isset($config['upload_path'])?$config['upload_path']:$_SERVER['DOCUMENT_ROOT'].'/userfiles/images/' ;
   if (!file_exists($config['upload_path']))
    if (phpversion() >= 5) mkdir($config['upload_path'],0755,true); else {
     $paths = split("/",$config['upload_path']); $makepath="";
     foreach ($paths as $p){ $makepath .=$p."/"; if (!file_exists($makepath)) mkdir($makepath,0755); }
    }
   $config['allowed_types'] = isset($config['allowed_types'])?$config['allowed_types']:'jpg|gif|png' ;
   $config['max_size'] = isset($config['max_size'])?$config['max_size']:'1000' ;
   $config['max_width'] = isset($config['max_width'])?$config['max_width']:'2048' ;
   $config['max_height'] = isset($config['max_height'])?$config['max_height']:'2048' ;
   $this->load->library('upload', $config);
   if ( ! $this->upload->do_upload()) {
    $error = array('error' => $this->upload->display_errors());
//    print_r($error);
    return false;
   } else  {
    $imgdata = $this->upload->data();
    $config['image_library'] = 'GD2' ;
    $config['source_image'] = $imgdata['full_path'];
    $config['quality'] = isset($config['quality'])?$config['quality']:"100%" ;
    $config['create_thumb'] = isset($config['create_thumb'])?$config['create_thumb']:TRUE ;
    $config['maintain_ratio'] = isset($config['maintain_ratio'])?$config['maintain_ratio']:TRUE ;
    $config['width'] = isset($config['width'])?$config['width']:140 ;
    $config['height'] = isset($config['height'])?$config['height']:115 ;
    $this->load->library('image_lib', $config);
    $this->image_lib->resize();
    return $imgdata['file_name'];
   }
  }
 }




}