<?php session_start(); 
require_once(dirname(__FILE__) . "/lib/std.php"); 
require_once(dirname(__FILE__) . "/config.php"); 
?>
<!Doctype html>
<html>
<head>
	<meta charset="utf8">
	<title>通識教育中心擔任教學助理（TA）申請</title>
	<link rel="stylesheet" href="<?php echo $URLPv; ?>lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $URLPv; ?>index.css">
	<script src="<?php echo $URLPv; ?>lib/jquery/jquery-1.11.2.js"></script>
	<script src="<?php echo $URLPv; ?>lib/bootstrap/js/bootstrap.js"></script>
</head>
<body>
<?php require_once(dirname(__FILE__) . "/lib/header.php"); ?>
<div class="container body">
<?php

	if(!isset($_POST['inputName'])) 
		locate($URLPv . "index.php");
	if(isset($_SESSION['stuID'])){
		$result = $DBmain->query("SELECT * FROM `need` WHERE `id` = '{$_SESSION['stuID']}'; ");
		$row = $result->fetch_array(MYSQLI_BOTH);
		$id = $_SESSION['stuID']; 
	}
	else {
		$result = $DBmain->query("SHOW TABLE STATUS LIKE 'need'; ");
		$row = $result->fetch_array(MYSQLI_BOTH); 
		$id = $row['Auto_increment'];
		$_SESSION['stuID'] = $id; 
		$DBmain->query("INSERT INTO `need` (`semester`) VALUES ('104-1'); "); 
	}
	$name = $_POST['inputName']; 
	$dept = $_POST['inputDept']; 
	$full = $_POST['inputFull']=='full'? 1:($_POST['inputFull']=='part'? 2:""); 
						$arr = array(
    			            array("professor", "教授"), 
                            array("associate", "副教授"), 
                            array("assistant", "助理教授"), 
                            array("project", "專案教師"), 
                            array("lecturer", "講師")
                        );	
	for($i=0; $i<count($arr); $i++){
		if($arr[$i][0]==$_POST['inputTitles']){
			$title = $i+1; 
			break;
		}
	}
	$mobile = $_POST['inputMobile']; 
	$ext = isset($_POST['inputExt'])? $_POST['inputExt']:""; 
	$mail = $_POST['inputEmail']; 
	$code = $_POST['inputCourseCode']; 
	$course = $_POST['inputCourseName']; 
                       $arr = array(
                            array("general", "一般講授課程"), 
                            array("lecture", "講座課程(邀請講員演講5場以上)"), 
                            array("special", "特殊課程(如學生以外籍生居多、電腦操作、戶外課程多(例如出>海)等"), 
                            array("language", "語言課程"), 
                            array("service", "服務學習課程")
                        ); 
    for($i=0; $i<count($arr); $i++) {
		if($arr[$i][0]==$_POST['inputCourseProperty']){
			$property = $i+1; 
			break;
		}
	}	
	$amount = $_POST['inputTAamount']; 
	$with = $_POST['inputTAwithClass']=='Y'? 1:0; 
	$hour = $_POST['inputTAhours']; 
	$week = "NNNNNNN"; 
	if(isset($_POST['inputTAworkday'])){ 
		for($i=0; $i<count($_POST['inputTAworkday']); $i++)
			$week[intval($_POST['inputTAworkday'][$i])] = 'Y'; 
	}
	$time = "NNNNNNNNNNNNN"; 
	if(isset($_POST['inputTAworktime'])) {
		for($i=0; $i<count($_POST['inputTAworktime']); $i++)
			$time[intval($_POST['inputTAworktime'][$i])] = 'Y'; 
	}
	$work = "NNNNNNNNNN"; 
	if(isset($_POST['inputTAcontent'])) {
		for($i=0; $i<count($_POST['inputTAcontent']); $i++)
			$work[intval($_POST['inputTAcontent'][$i])] = 'Y'; 
	}
	$work .= isset($_POST['other'])? $_POST['other']:""; 

	$str = "UPDATE `need` SET "; 
	$str .= "`name` = '{$name}', "; 
	$str .= "`dept` = '{$dept}', "; 
	$str .= "`fullOrParttime` = {$full}, "; 
	$str .= "`titles` = {$title}, "; 
	$str .= "`mobile` = '{$mobile}', "; 
	$str .= "`ext` = '{$ext}', "; 
	$str .= "`email` = '{$mail}', "; 
	$str .= "`courseCode` = '{$code}', "; 
	$str .= "`courseName` = '{$course}', "; 
	$str .= "`courseProperty` = {$property}, "; 
	$str .= "`TAamount` = {$amount}, ";
	$str .= "`TAwithClass` = {$with}, ";
	$str .= "`TAhours` = {$hour}, ";
	$str .= "`TAworkday` = '{$week}', ";
	$str .= "`TAworktime` = '{$time}', ";
	$str .= "`TAcontent` = '{$work}', ";
	$str .= "`applyTime` = '" . date("Y-m-d H:i:s", time()) . "' ";
	$str .= "WHERE `id` = '{$_SESSION['stuID']}'; "; 
	
	$DBmain->query($str); 
	locate($URLPv . "print.php"); 	
?>
	<div class="print-table">

	</div>
<?php require_once(dirname(__FILE__) . "/lib/footer.php"); ?>
