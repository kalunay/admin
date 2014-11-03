<?php include(APPPATH.'views/_header.php'); ?>



<style type="text/css">

/* Стили для jQuery UI Datepicker */
#datepicker_div, .datepicker_inline {
	font-family: "Trebuchet MS", Tahoma, Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	padding: 0;
	margin: 0;
	background: #DDD;
	width: 185px;
}
#datepicker_div {
	display: none;
	border: 1px solid #FF9900;
	z-index: 10;
}
.datepicker_inline {
	float: left;
	display: block;
	border: 0;
}
.datepicker_dialog {
	padding: 5px !important;
	border: 4px ridge #DDD !important;
}
button.datepicker_trigger {
	width: 25px;
}
img.datepicker_trigger {
	margin: 2px;
	vertical-align: middle;
}
.datepicker_prompt {
	float: left;
	padding: 2px;
	background: #DDD;
	color: #000;
}
*html .datepicker_prompt {
	width: 185px;
}
.datepicker_control, .datepicker_links, .datepicker_header, .datepicker {
	clear: both;
	float: left;
	width: 100%;
	color: #FFF;
}
.datepicker_control {
	background: #FF9900;
	padding: 2px 0px;
}
.datepicker_links {
	background: #E0F4D7;
	padding: 2px 0px;
}
.datepicker_control, .datepicker_links {
	font-weight: bold;
	font-size: 80%;
	letter-spacing: 1px;
}
.datepicker_links label {
	padding: 2px 5px;
	color: #888;
}
.datepicker_clear, .datepicker_prev {
	float: left;
	width: 34%;
}
.datepicker_current {
	float: left;
	width: 30%;
	text-align: center;
}
.datepicker_close, .datepicker_next {
	float: right;
	width: 34%;
	text-align: right;
}
.datepicker_header {
	padding: 1px 0 3px;
	background: #83C948;
	text-align: center;
	font-weight: bold;
	height: 1.3em;
}
.datepicker_header select {
	background: #83C948;
	color: #000;
	border: 0px;
	font-weight: bold;
}
.datepicker {
	background: #CCC;
	text-align: center;
	font-size: 100%;
}
.datepicker a {
	display: block;
	width: 100%;
}
.datepicker .datepicker_titleRow {
	background: #B1DB87;
	color: #000;
}
.datepicker .datepicker_daysRow {
	background: #FFF;
	color: #666;
}
.datepicker_weekCol {
	background: #B1DB87;
	color: #000;
}
.datepicker .datepicker_daysCell {
	color: #000;
	border: 1px solid #DDD;
}
#datepicker .datepicker_daysCell a {
	display: block;
}
.datepicker .datepicker_weekEndCell {
	background: #E0F4D7;
}
.datepicker .datepicker_daysCellOver {
	background: #FFF;
	border: 1px solid #777;
}
.datepicker .datepicker_unselectable {
	color: #888;
}
.datepicker_today {
	background: #B1DB87 !important;
}
.datepicker_currentDay {
	background: #83C948 !important;
}
#datepicker_div a, .datepicker_inline a {
	cursor: pointer;
	margin: 0;
	padding: 0;
	background: none;
	color: #000;
}
.datepicker_inline .datepicker_links a {
	padding: 0 5px !important;
}
.datepicker_control a, .datepicker_links a {
	padding: 2px 5px !important;
	color: #000 !important;
}
.datepicker_titleRow a {
	color: #000 !important;
}
.datepicker_control a:hover {
	background: #FDD !important;
	color: #333 !important;
}
.datepicker_links a:hover, .datepicker_titleRow a:hover {
	background: #FFF !important;
	color: #333 !important;
}
.datepicker_multi .datepicker {
	border: 1px solid #83C948;
}
.datepicker_oneMonth {
	float: left;
	width: 185px;
}
.datepicker_newRow {
	clear: left;
}
.datepicker_cover {
	display: none;
	display/**/: block;
	position: absolute;
	z-index: -1;
	filter: mask();
	top: -4px;
	left: -4px;
	width: 193px;
	height: 200px;
}
/* Стили для jQuery UI Datepicker */

#exampleRange {
  float:left;
  position:relative;
  width:200px;
  right:10px;
}
input {
  background-color:#ECF3F8;
  font-family: "Trebuchet MS", Tahoma, Verdana, Arial, Helvetica, sans-serif;
  text-align:center;
  border:1px solid #000;
}

</style>



<h1><?=$this->lang->line('module_name')?></h1>
<form action="user/alllistsearch" method="post">
<br /><br />
<input type="text" id="exampleRange" name="dateselect" value="поиск по дате в интервале" /> <input type="submit" name="searchuser" value="Найти" /><br />
<br />
<table class="tablesorter">
				<tbody>


<? if($lists2){ foreach($lists2 as $i): ?>
<tr>
<td><?=$i['name']?></td>
<td><?=$i['email']?></td>
</tr>
<? endforeach; }else{ ?>
По заданному интервалу даты нет зарегистрированных пользователей.
<? } ?>

                </tbody>
			</table>


<script type="text/javascript">
$(document).ready(function(){
  // ---- Календарь -----
  $('#exampleRange').attachDatepicker({
  	rangeSelect: true,
  	yearRange: '2000:2010',
  	firstDay: 1
  });
  // ---- Календарь -----
});
</script>			
		
<?=(isset($pagination_link)?$pagination_link:'');?>
		
</form>
  <p><?=anchor("user","<span>".$this->lang->line('user')."</span>",array('class'=>'btn-create'))?></p>

<?php include(APPPATH.'views/_footer.php'); ?>