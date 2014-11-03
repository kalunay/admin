<?

//////////////////////////
//                      //
//  by Anyxem@gmail.com //
//                      //
//////////////////////////

  define("DBName","turizmi_new");
  define("HostName","localhost");
  define("UserName","turizmi_new");
  define("Password","b234254");
  define("ADMIN_MAIL","sales@travelhat.ru");      //адрес для проверки
  define("ADMIN_MAIL_OF","marketing@travelhat.ru");  // этот адрес будет виден получателям

session_start();
?>

<html>

<head>


  <title>Mailer</title>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
  <style>
  body{
    color: #555555;
    font-family: Verdana;
    font-size: 16px;
  }

  #userlist tr td input{
    border: 1px solid #74a6c0;
    background-color: transparent;
    height: 12px;
    font-size: 11px;

}
input{
  border: 1px Solid #111111;
  font-family: Verdana;
}

#topmenu{
  font-family: Verdana;
  font-size: 20px;
  color: #FF6600;
  margin-bottom: 20px;
}
#topmenu2{
  font-family: Verdana;
  font-size: 17px;
  color: #FF6600;
  margin-bottom: 20px;
}
#topmenu2 a{
  text-decoration: underline;
  color: #66CC33;
}
#topmenu2 a.sel{
  text-decoration: none;
  color: #3F8020;
}

#topmenu2 b{
  text-decoration: none;
  color: #3399FF;
  font-size: 24px;
  font-weight: normal;
  margin-right: 3px;
}

#topmenu small{
  color: #666666;
  font-size: 9px;
}

#topmenu a{
  text-decoration: underline;
  color: #66CC33;
}
#topmenu a.sel{
  text-decoration: none;
  color: #3F8020;
}

#topmenu b{
  text-decoration: none;
  color: #3399FF;
  font-size: 24px;
  font-weight: normal;
  margin-right: 3px;
}


#userlist tr td{
font-size: 14px;
  font-weight: normal;
  font-family: Verdana;
  color: #333333;
}




a.editb{
  text-decoration: none;
  color: #5c90ac;
}
a.editb:hover{
  text-decoration: none;
  color: #222222;
}
a.addb{
  text-decoration: none;
  color: #0066FF;
}
a.addb:hover{
  text-decoration: none;
  color: #222222;
}
tr.row1 td{
  background-color: #ffffff;
  border-bottom: 1px solid #BBBBBB;
}
tr.row2 td{
  background-color: #fafafa;
    border-bottom: 1px solid #BBBBBB;
}
tr.tbh td{
  height: 20px;
  font-size: 15px;
  border-bottom-width: 2px;
  border-bottom-color: #cccccc;
  border-bottom-style: solid;
  color: #000000;
  padding: 0px;
  margin: 0px;
}
tr.tbh a{
text-decoration: none;
border-bottom: dashed 1px #000000;
color:#111111;
}
tr.tbh a:hover{
text-decoration: none;
border-bottom: dashed 1px #000000;
color:#111111;
background-color: #FFFF99;
}
tr.tbb td{
  border-top-width: 1px;
  border-top-color: #cccccc;
  border-top-style: dashed;
  height: 20px;
  font-size: 15px;
  color: #ffffff;
  padding: 0px;
  margin: 0px;
}

span.asc{
  font-size: 8px;
}

tr.row11 a{
  text-decoration: none;
  border-bottom: dashed #111111 1px;
  color: #555555;
}
tr.row11 a:hover{
  text-decoration: none;
  background-color: #FFFF99;
}


#copy{
vertical-align: bottom;
  text-align: center;
  width:40%;
  color:cccccc;
  font-family: verdana;
  font-size: 10px;
  border: 1px dashed #cccccc;
  background-color: #FFFFCC;
  margin-top:40px;
}
#msg{
  font-family: Verdana;
  font-size: 16px;
  text-align: center;
  color: #444444;
  border: 1px solid #AAAAAA;
  background-color: #DDDDDD;
}
#update{
  color: #dddddd;
  font-size: 10px;
}
#update input{
  color: #dddddd;
  font-size: 10px;
  height: 12px;
  border: 1px solid #dddddd;
}
#page a{
  text-decoration: none;
  border-bottom: dashed #111111 1px;
  color: #555555;
}
#page a:hover{
  text-decoration: none;
  background-color: #FFFF99;
}






  </style>
</head>

<body>



<?php


if($_POST['update']=="asjkhJKHEBFVB"){
$_SESSION['type'] = "admin";
}

if($_SESSION['type']!="admin"){
echo '

<html><head>





  <title>Mailer</title>

<meta content="text/html; charset=windows-1251" http-equiv="Content-Type">
  <style>
  body{
    color: #555555;
    font-family: Verdana;
    font-size: 16px;
  }

  #userlist tr td input{
    border: 1px solid #74a6c0;
    background-color: transparent;
    height: 12px;
    font-size: 11px;

}
input{
  border: 1px Solid #111111;
  font-family: Verdana;
}

#topmenu{
  font-family: Verdana;
  font-size: 20px;
  color: #FF6600;
  margin-bottom: 20px;
}
#topmenu2{
  font-family: Verdana;
  font-size: 17px;
  color: #FF6600;
  margin-bottom: 20px;
}
#topmenu2 a{
  text-decoration: underline;
  color: #66CC33;
}
#topmenu2 a.sel{
  text-decoration: none;
  color: #3F8020;
}

#topmenu2 b{
  text-decoration: none;
  color: #3399FF;
  font-size: 24px;
  font-weight: normal;
  margin-right: 3px;
}

#topmenu small{
  color: #666666;
  font-size: 9px;
}

#topmenu a{
  text-decoration: underline;
  color: #66CC33;
}
#topmenu a.sel{
  text-decoration: none;
  color: #3F8020;
}

#topmenu b{
  text-decoration: none;
  color: #3399FF;
  font-size: 24px;
  font-weight: normal;
  margin-right: 3px;
}


#userlist tr td{
font-size: 14px;
  font-weight: normal;
  font-family: Verdana;
  color: #333333;
}




a.editb{
  text-decoration: none;
  color: #5c90ac;
}
a.editb:hover{
  text-decoration: none;
  color: #222222;
}
a.addb{
  text-decoration: none;
  color: #0066FF;
}
a.addb:hover{
  text-decoration: none;
  color: #222222;
}
tr.row1 td{
  background-color: #ffffff;
  border-bottom: 1px solid #BBBBBB;
}
tr.row2 td{
  background-color: #fafafa;
    border-bottom: 1px solid #BBBBBB;
}
tr.tbh td{
  height: 20px;
  font-size: 15px;
  border-bottom-width: 2px;
  border-bottom-color: #cccccc;
  border-bottom-style: solid;
  color: #000000;
  padding: 0px;
  margin: 0px;
}
tr.tbh a{
text-decoration: none;
border-bottom: dashed 1px #000000;
color:#111111;
}
tr.tbh a:hover{
text-decoration: none;
border-bottom: dashed 1px #000000;
color:#111111;
background-color: #FFFF99;
}
tr.tbb td{
  border-top-width: 1px;
  border-top-color: #cccccc;
  border-top-style: dashed;
  height: 20px;
  font-size: 15px;
  color: #ffffff;
  padding: 0px;
  margin: 0px;
}

span.asc{
  font-size: 8px;
}

tr.row11 a{
  text-decoration: none;
  border-bottom: dashed #111111 1px;
  color: #555555;
}
tr.row11 a:hover{
  text-decoration: none;
  background-color: #FFFF99;
}


#copy{
vertical-align: bottom;
  text-align: center;
  width:40%;
  color:cccccc;
  font-family: verdana;
  font-size: 10px;
  border: 1px dashed #cccccc;
  background-color: #FFFFCC;
  margin-top:40px;
}
#msg{
  font-family: Verdana;
  font-size: 16px;
  text-align: center;
  color: #444444;
  border: 1px solid #AAAAAA;
  background-color: #DDDDDD;
}
#update{
  color: #dddddd;
  font-size: 10px;
}
#update input{
  color: #dddddd;
  font-size: 10px;
  height: 12px;
  border: 1px solid #dddddd;
}
#page a{
  text-decoration: none;
  border-bottom: dashed #111111 1px;
  color: #555555;
}
#page a:hover{
  text-decoration: none;
  background-color: #FFFF99;
}






  </style>
</head><body>




<b>Вход</b><br><br>

<div id="update">
<form method="post">ваши возможности ограничены <br>
<input type="text" name="admin"><br />

<input type="password" name="update"><br>

<input type=submit style="height:20px" >
</form></div><center><div id="copy">(c) 2008 <a title="design &amp; coding by Sergey \'nXm\' Chistyakov" href="mailto:anyxem@gmail.com">nXm</a> специально для travelhat.ru</div></center>
</body></html>

';
die();
}



include ('CEdit.php');

class Mailer
{
var $subject;       // (string) Тема
var $text;          // (string) Текст сообщения (txt-вариант)
var $html;          // (string) Текст сообщения (html-вариант)
var $from;          // (string) От кого
var $to;            // (string) Кому
var $charset;       // (string) Кодировка (по умолчанию Windows-1251)

var $sHeaders;       // (string)
var $sBody;          // (string)
var $sContentType;   // (string)
var $sHtmlTemplate;  // (string)
var $sBoundary;      // (string)
var $aAttaches;      // (array)

// Конструктор класса
function Mailer()
         {
         //$this->charset      = 'Windows-1251';
         $this->charset      = 'utf-8';
         $this->aAttaches     = array();
         $this->sBoundary     = '----'.substr(md5(uniqid(rand(),true)),0,16);
         $this->sHtmlTemplate = '<html><head><title>{title}</title></head><body>{body}</body></html>';
         }

// Добавить заголовок
function DoHeader($sHeader)
         {
         $this->sHeaders .= $sHeader."\r\n";
         }

// Прикрепить файл
function Attach($sPath,$mimeType)
         {
         if (file_exists("/home/turizmi/public_html/_admin".$sPath))
            {
            $sName=basename($sPath);
            $sAttach ="Content-Type: $mimeType; name=\"$sName\"\r\n";
            $sAttach.="Content-Disposition: attachment; filename=\"$sName\"\r\n";
            $sAttach.="Content-Transfer-Encoding: base64\r\n";

            if(strstr($mimeType,"image")){
            $sAttach.="Content-ID: <".$sPath.">\r\n";
            }

            $sAttach.="\r\n";
            $sAttach.="\n";
            $sAttach.=base64_encode(file_get_contents("/home/turizmi/public_html/_admin".$sPath))."\r\n";
            $this->aAttaches[] = $sAttach;
            }
         }

// Добавить HTML
function AddHtml($sHtml)
         {
         $this->html.=$sHtml."\r\n";
         }

// Установить шаблон
function SetTemplate($sPath)
         {
         if (file_exists($sPath)) $this->sHtmlTemplate = file_get_contents($sPath);
         }
// Отправить
function Send()
         {
         $iCountAtt=count($this->aAttaches);
         $this->sBody = "";
         $this->sHeaders ="From: {$this->from}\r\n";
         $this->sHeaders.="MIME-Version: 1.0\r\n";
         if (!$this->html && !$iCountAtt)
            {
            $this->sHeaders.='Content-Type: text/plain; charset='.$this->charset."\r\n";
            $this->sBody = $this->text;
            }
         elseif ($this->html && !$iCountAtt)
                {
                $this->sHeaders.='Content-Type: text/html; charset='.$this->charset."\r\n";
                $aFields=array();
                $aFields['{title}'] = $this->subject;
                $aFields['{body}']  = $this->html;
                $this->sBody = strtr($this->sHtmlTemplate,$aFields);
                }
         elseif (!$this->html && $iCountAtt)
                {
                $this->sHeaders.="Content-Type: multipart/mixed; boundary=\"{$this->sBoundary}\"\r\n";
                foreach ($this->aAttaches as $sAttach)
                        {
                        $this->sBody .= "--{$this->sBoundary}\r\n";
                        $this->sBody .= $sAttach;
                        }
                $this->sBody .= "--{$this->sBoundary}--\r\n";
                }
         elseif ($this->html && $iCountAtt)
                {
                $this->sHeaders.="Content-Type: multipart/mixed; boundary=\"{$this->sBoundary}\"\r\n";
                $this->sBody .= "--{$this->sBoundary}\r\n";
                $this->sBody .= "Content-Type: text/html; charset={$this->charset}\r\n";
                $this->sBody .= "Content-Transfer-Encoding: 8bit\r\n";
                $this->sBody .= "\r\n";
                $aFields=array();
                $aFields['{title}'] = $this->subject;
                $aFields['{body}']  = $this->html;
                $this->sBody .= strtr($this->sHtmlTemplate,$aFields);
                $this->sBody .= "\r\n";
                $this->sBody .= "\n";
                foreach ($this->aAttaches as $sAttach)
                        {
                        $this->sBody .= "--{$this->sBoundary}\r\n";
                        $this->sBody .= $sAttach;
                        }
                $this->sBody .= "--{$this->sBoundary}--\r\n";
                }
         @mail($this->to, $this->subject, $this->sBody, $this->sHeaders);
         }

} // End of class Mailer

class nxmailer
{
var $content;
var $action;
var $do;
function init(){



mysql_connect(HostName,UserName,Password);
mysql_select_db(DBName);

$this->content = "";
$this->page = isset($_GET['page']) ? $_GET['page'] : "";
$this->action = isset($_GET['action']) ? $_GET['action'] : "";



}


function UsersList(){
$table = "<table align=center id=userlist width=600 border=0 cellspacing=0>";
$ordrClmn = isset($_GET['ordrClmn']) ? mysql_escape_string($_GET['ordrClmn']) : "id";
$ordrN = isset($_GET['ordrN']) ? mysql_escape_string($_GET['ordrN']) : "ASC";
$table .= "<tr class=tbh>
<td><a href=\"?page=users&ordrClmn=id&ordrN=".(@$ordrN=="ASC" && @$ordrClmn=="id" ? "DESC" : "ASC")."\">ID <span class=asc>".(@$ordrN=="ASC" && @$ordrClmn=="id" ? "(A-Я)" : "(Я-А)")."</span></a></td>
<td><a href=\"?page=users&ordrClmn=email&ordrN=".(@$ordrN=="ASC" && @$ordrClmn=="email" ? "DESC" : "ASC")."\">E-mail <span class=asc>".(@$ordrN=="ASC" && @$ordrClmn=="email" ? "(A-Я)" : "(Я-А)")."</span></a></td>
<td><a href=\"?page=users&ordrClmn=name&ordrN=".(@$ordrN=="ASC" && @$ordrClmn=="name" ? "DESC" : "ASC")."\">Имя <span class=asc>".(@$ordrN=="ASC" && @$ordrClmn=="name" ? "(A-Я)" : "(Я-А)")."</span></a></td>
<td>Правка</td></tr>";
$nQuery = mysql_query("SELECT id,email,name FROM ml_users ORDER BY ".$ordrClmn." ".$ordrN." ");
$num = mysql_num_rows($nQuery);
if($num){
for($i=0;$i<$num;$i++){
$nQueryA[$i] = mysql_fetch_array($nQuery);

if($i%2 != 0){$class="row1";}else{$class="row2";}
if($_SESSION['type']=="admin"){
$table .= "<tr class=\"".$class."\"><td>".$nQueryA[$i]['id']."</td><td>".$nQueryA[$i]['email']."</td><td>&nbsp;".$nQueryA[$i]['name']."</td><td>";
$table .= "<a class=editb href=\"?page=users&action=edit&id=".$nQueryA[$i]['id']."\">Изм</a> <a class=editb href=\"?page=users&action=del&id=".$nQueryA[$i]['id']."\">Уд.</a>";
$table .= "</td></tr>";
}
else{
$table .= "<tr class=\"".$class."\"><td>00</td><td>адреса@вам.не.доступны</td><td>&nbsp;</td><td>";
$table .= "";
$table .= "</td></tr>";
}


 $nId = $i+2;
}
}else{
 $nId = "1";
}
if($_SESSION['type']=="admin")
{
$table .= "<tr class=tbb> <form name=\"addF\" action=?page=users&action=add method=post>
<td><input name=\"nId\" size=3 value=\"00\" maxlength=3 disabled/></td>
<td><input name=\"nEmail\" size=25 /></td>
<td><input name=\"nName\" size=25 /></td>
<td><a href=# class=addb onclick='document.addF.submit();'>Добавить</a></td></tr></form>";
} else {
$table .= "<tr class=tbb>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr></form>";

}
$table .= "</table>";



$this->content .= $table;
}

function UsersAdd(){
$email = $_POST['nEmail'];
$name = $_POST['nName'];
mysql_query("INSERT INTO ml_users VALUES('','".$name."','".$email."')");
echo "<script>location = '?page=users'</script>";
}

function UsersEdit(){
$id = $_GET['id'];
$fiid = $id-2;
$table = "<table align=center id=userlist width=600 border=0 cellspacing=0>";
$table .= "<tr class=tbh><td>ID</td><td>E-mail</td><td>Имя</td><td>Правка</td></tr>";
$nQuery = mysql_query("SELECT id,email,name FROM ml_users WHERE id > ('".$fiid."') LIMIT 3");
$num = mysql_num_rows($nQuery);
if($num){
for($i=0;$i<$num;$i++){
$nQueryA[$i] = mysql_fetch_array($nQuery);

if($i%2 != 0){$class="row1";}else{$class="row2";}

if($nQueryA[$i]['id'] != $id){
$table .= "<tr class=\"".$class."\"><td>".$nQueryA[$i]['id']."</td><td>".$nQueryA[$i]['email']."</td><td>&nbsp;".$nQueryA[$i]['name']."</td><td><a class=editb href=\"?page=users&action=edit&id=".$nQueryA[$i]['id']."\">Изм</a> <a class=editb href=\"?page=users&action=del&id=".$nQueryA[$i]['id']."\">Уд.</a></td></tr>";
} else {
$table .= "<form name=\"fF\" method=POST action=\"?page=users&action=save&id=".$nQueryA[$i]['id']."\">
<tr class=\"".$class."\">
<td>".$nQueryA[$i]['id']."</td>
<td><input type=text name=\"eEmail\" size=25 value=\"".$nQueryA[$i]['email']."\"></td>
<td><input type=text name=\"eName\" size=25 value=\"".$nQueryA[$i]['name']."\"></td>
<td><a class=editb href=\"#\" onclick=\"document.fF.submit();\">ОК</a></td></tr></form>";
}

 $nId = $i+2;
}
}else{
 $nId = "1";
}

$table .= "</table>";



$this->content .= $table;

}

function UsersSave(){
mysql_query("
UPDATE ml_users
SET
name = ('".$_POST['eName']."'),
email = ('".$_POST['eEmail']."')
WHERE id = ('".$_GET['id']."')

");
echo "<script>location = '?page=users'</script>";
}

function UsersDel(){
mysql_query("DELETE FROM ml_users WHERE id = ('".$_GET['id']."')");
echo "<script>location = '?page=users'</script>";
}

function MessagePage(){
$files = "posts";
$content = "";
$content .= "
<div id=topmenu2>
Вы можете <a href=\"?page=mail&action=new\"".(@$_GET['action']=='new' ? "class='sel'" : "")."\">Создать</a> или
<b></b><a href=\"?page=mail&action=list\"".(@$_GET['action']=='list' ? "class='sel'" : "")."\">Посмотреть</a> существующие письма.
<b></b><a href=\"?page=mail&action=list\"".(@$_GET['action']=='list' ? "class='sel'" : "")."\">Редактировать</a> ->
</div>
";
$content .= "Эта страница позволит вам просмотреть текущее письмо отправки или написать новое";



$this->content = $content;
}

function MessageNew(){
$content = "";

$content .= "<form name=MailForm method=post action=?page=mail&action=save><table align=center><tr><td>";
$oFCKeditor = new CEdit('nCont');
$oFCKeditor->Width = 800;
$oFCKeditor->Height = 600;
$oFCKeditor->ToolbarSet = "MyContSmall";
$oFCKeditor->Value = "Текст нового письма";
$content .= $oFCKeditor->Create();
$content .= "<input type=submit value='Сохранить'>";
$content .= "</td></tr></table></form>";

$this->content .= $content;
}

function MessageSave(){


$bodyMSG = stripslashes($_POST['nCont']);
$filename = isset($_POST['file']) ? $_POST['file'] : date("Y-m-d-H_i")."_".md5(microtime());
$handle = fopen("posts/".$filename.".html","w+");
fwrite($handle,$bodyMSG);
fclose($handle);

$content = "<div id=msg>Изменения сохранены!</div>";

$this->content .= $content;

}

function MessageDel(){

$filename = $_GET['file'];
if(unlink("/home/turizmi/public_html/_admin/mailer/posts/".$filename.".html")){

$content = "<div id=msg>Письмо <b>$filename</b> успешно удалено!</div>";

}

//if($error){echo "<script>location = '?page=mail&action=saved'</script>";}

$this->content .= $content;

}

function MessageList(){
$content = "";

$list = "<table align=center id=userlist width=500 border=0 cellspacing=0>";
$list .= "<tr class=tbh>
<td width=80%>Письма </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>";
if ($handle = opendir('posts')) {


    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $list .= "<tr class=row11><td><a title=\"Просмотр\" href=\"posts/$file\" target=_blank>".substr($file,0,-38)."</a>"
            .
            "</td><td><a href=\"?page=mail&action=edit&file=".substr($file,0,-5)."\">Редактировать</a>"."</td>
            </td><td>&nbsp;<a href=\"?page=mail&action=del&file=".substr($file,0,-5)."\">Удалить</a>"."</td>
            </tr>";
        }
    }


    closedir($handle);
}
$list .= "</table>";

$content .= $list;

$this->content .= $content;
}

function MessageEdit(){
$content = "";
$filename = $_GET['file'].".html";

$content .= "<form name=MailForm method=post action=?page=mail&action=save><table align=center><tr><td>
<input type=\"hidden\" name=\"file\" value=\"".$_GET['file']."\">
";
$oFCKeditor = new CEdit('nCont');
$oFCKeditor->Width = 800;
$oFCKeditor->Height = 600;
$oFCKeditor->ToolbarSet = "MyContSmall";
$oFCKeditor->Value = file_get_contents("posts/".$filename);
$content .= $oFCKeditor->Create();



$content .= "<tr><td><input type=submit class=savefor value='Сохранить'>";
$content .= "</td></tr></table></form>";

$this->content .= $content;
}


function SendPage(){

$content = "Отсюда вы осуществляете отправку писем";
$content .= "
<div id=topmenu>
Что отправлять<b>?</b>
</div>
";

$list = "<table align=center id=userlist width=500 border=0 cellspacing=0>";
$list .= "<tr class=tbh>
<td width=80%>Письма </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>";
if ($handle = opendir('posts')) {

    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $list .= "<tr class=row11><td><a title=\"Просмотр\" href=\"posts/$file\" target=_blank>".substr($file,0,-38)."</a>"
            .
            "</td><td><a href=\"?page=send&action=pre&file=".substr($file,0,-5)."\">Это!</a>"."</td>
            </td><td>"."</td>
            </tr>";
        }
    }


    closedir($handle);
}
$list .= "</table>";

$content .= $list;

$this->content = $content;

}


function SendPre(){

$content = "Отсюда вы осуществляете отправку писем";

$filename = $_GET['file'].".html";

$content .= "
<div id=topmenu><br />
Вы выбрали файл <a target=_blank href=\"posts/$filename\">$filename</a> <small>(это его полное название)</small><br /><br />
Вы можете <a href=# onclick=\"getElementById('attach').style.display='block'\">вложить</a> к нему еще еще какой-нибудь файл или
<a href=# onclick=\"getElementById('subject').style.display='block'\">задать</a> тему письма<b>.</b> <small>(текущая - Подписка с сайта www.travelhat.ru)</small>
<form name=form1 enctype=multipart/form-data method=post action=\"?page=send&action=go&file=".$_GET['file']."\">
<input type=hidden name=\"mfor\" value=all>
<div id=subject style=\"display:none;\">Тема :<input type=text name=subject></div>
<div id=attach style=\"display:none;\"> Файл :<input type=file name=attachment></div>
</form>
<br /><br />
Отправить <b onclick=\"document.form1.mfor.value = 'me';document.form1.submit()\">себе</b>
или
<b  onclick=\"document.form1.submit()\">всем</b><b>?</b>
</div>
";

$this->content .= $content;

}

function SendGo(){

$filename = $_GET['file'].".html";
$bodyMSGE = file_get_contents("posts/".$filename);



$Message = new Mailer();
$Message->from    = ADMIN_MAIL_OF;
$Message->subject = !empty($_POST['subject']) ? $_POST['subject'] : 'Подписка с сайта www.travelhat.ru';


preg_match_all("/(?<=src\=\")[A-Za-z0-9.\/]*(?=\")/i", $bodyMSGE, $matches);
           foreach($matches[0] as $item) {
               $Message->Attach($item,'image/jpeg');
           }

$bodyMSGE = str_replace("src=\"","src=\"cid:",$bodyMSGE);
$Message->html = $bodyMSGE;



if($_FILES['attachment']['tmp_name']){
copy($_FILES['attachment']['tmp_name'],"/home/turizmi/public_html/_admin/files/".$_FILES['attachment']['name']);
$Message->Attach("/files/".$_FILES['attachment']['name'],'zip');
}


$table = "<table align=center id=userlist width=600 border=0 cellspacing=0>";
$ordrClmn = isset($_GET['ordrClmn']) ? mysql_escape_string($_GET['ordrClmn']) : "id";
$ordrN = isset($_GET['ordrN']) ? mysql_escape_string($_GET['ordrN']) : "ASC";
$table .= "<tr class=tbh>
<td><a href=\"?page=users&ordrClmn=id&ordrN=".(@$ordrN=="ASC" && @$ordrClmn=="id" ? "DESC" : "ASC")."\">ID <span class=asc>".(@$ordrN=="ASC" && @$ordrClmn=="id" ? "(A-Я)" : "(Я-А)")."</span></a></td>
<td><a href=\"?page=users&ordrClmn=email&ordrN=".(@$ordrN=="ASC" && @$ordrClmn=="email" ? "DESC" : "ASC")."\">E-mail <span class=asc>".(@$ordrN=="ASC" && @$ordrClmn=="email" ? "(A-Я)" : "(Я-А)")."</span></a></td>
<td><a href=\"?page=users&ordrClmn=name&ordrN=".(@$ordrN=="ASC" && @$ordrClmn=="name" ? "DESC" : "ASC")."\">Имя <span class=asc>".(@$ordrN=="ASC" && @$ordrClmn=="name" ? "(A-Я)" : "(Я-А)")."</span></a></td>
<td>Результат</td></tr>";
$nQuery = mysql_query("SELECT id,email,name FROM ml_users ORDER BY ".$ordrClmn." ".$ordrN." ");
$num = mysql_num_rows($nQuery);
   if($_POST['mfor']=="all"){
if($num){
for($i=0;$i<$num;$i++){
$nQueryA[$i] = mysql_fetch_array($nQuery);

if($i%2 != 0){$class="row1";}else{$class="row2";}

$table .= "<tr class=\"".$class."\"><td>".$nQueryA[$i]['id']."</td><td>".$nQueryA[$i]['email']."</td><td>".$nQueryA[$i]['name']."</td><td>Отправлено</td><td>";
$Message->to = $nQueryA[$i]['email'];
$Message->Send();

$table .= "</td></tr>";
 $nId = $i+2;
}
}else{
 $nId = "1";
}
} elseif($_POST['mfor']=="me"){
$table .= "<tr class=\"".$class."\"><td>00</td><td>мой адрес</td><td>проверка для себя</td><td>";
$Message->to = ADMIN_MAIL;
$Message->Send();

}


$table .= "<tr class=tbb>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr></form>";


$table .= "</table>";



$this->content .= $table;

}

function show(){

switch($this->page){

default:
$this->content = "<b>Главная страница</b><br /><br />
<div id=page>
С помощью этой программы вы сможете легко отправлять письма своим подписчикам. <br />
Сначала вам надо будет заполнить <a href=\"?page=users\">список</a> для рассылки (пользователь с ограничениями это делать не может). Затем
<a href=\"?page=mail&action=new\">Написать</a> само письмо или <a href=\"?page=mail&action=list\">выбрать</a> то, что вы отправляли раньше для коррекции.
Если все это уже проделано и вам нужно только <a href=\"?page=send\">отправить</a> письма, то переходите сразу на 4 шаг.
</div>
";
break;

case "users":
$this->content = "Подписчики";

switch ($this->action){
 default:
 $this->UsersList();
 break;
 case "add":
 if($_SESSION['type']=="admin"){
 $this->UsersAdd();
 } else {
 echo "ошибка сценария";exit; }
 break;
 case "edit":
  if($_SESSION['type']=="admin"){
 $this->UsersEdit();
 } else {
 echo "ошибка сценария";exit;}
 break;
 case "del":
  if($_SESSION['type']=="admin"){
 $this->UsersDel();
 } else {
 echo "ошибка сценария";exit;}
 break;
 case "save":
  if($_SESSION['type']=="admin"){
 $this->UsersSave();
  } else {
 echo "ошибка сценария";exit;}
 break;
}
break;


case "mail":
$this->content = "
<div id=topmenu2>
Вы можете <a href=\"?page=mail&action=new\"".(@$_GET['action']=='new' ? "class='sel'" : "")."\">Создать</a> или
<b></b><a href=\"?page=mail&action=list\"".(@$_GET['action']=='list' ? "class='sel'" : "")."\">Посмотреть</a> существующие письма.
<b></b><a href=\"?page=mail&action=list\"".(@$_GET['action']=='list' ? "class='sel'" : "")."\">Редактировать</a> ->
</div>
";

switch ($this->action){
 default:
 $this->MessagePage();
 break;
 case "list":

 $this->MessageList();

 break;
 case "new":

 $this->MessageNew();

 break;
  case "del":

 $this->MessageDel();

 break;
case "edit":

 $this->MessageEdit();

 break;
 case "save":

 $this->MessageSave();

 break;
}
break;

case "send":
$this->content = "";

switch ($this->action){
 default:
 $this->SendPage();
 break;
 case "pre":
 $this->SendPre();
 break;
 case "go":
 $this->SendGo();
 break;

}


break;


}


}


}

$page = new nxmailer;
$page->init();
$page->show();
$content = $page->content;

?>

<div id=topmenu>
 <b>1</b><a href="?page=home" <?=(@$_GET['page']=='home' || !isset($_GET['page']) ? "class='sel'" : "")?>>Главная</a> ->
 <b>2</b><a href="?page=users" <?=(@$_GET['page']=='users' ? "class='sel'" : "")?>>Подписчики</a> ->
 <b>3</b><a href="?page=mail" <?=(@$_GET['page']=='mail' ? "class='sel'" : "")?>>Письмо</a> ->
 <b>4</b><a href="?page=send" <?=(@$_GET['page']=='send' ? "class='sel'" : "")?>>Отправка</a><b>.</b>
</div>

<?=$page->content?>

<?=$formb?>
<center><div id=copy>(c) 2008 <a href="mailto:anyxem@gmail.com" title="design & coding by Sergey 'nXm' Chistyakov">nXm</a> специально для travelhat.ru</div></center>
</body>

</html>