<?php session_start(); 
require_once(dirname(__FILE__) . "/lib/std.php"); 
require_once(dirname(__FILE__) . "/config.php"); 
?>
<!Doctype html>
<html>
<head>
	<meta charset="utf8">
	<title>通識課程TA需求調查</title>
	<link rel="stylesheet" href="<?php echo $URLPv; ?>lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $URLPv; ?>index.css">
	<script src="<?php echo $URLPv; ?>lib/jquery/jquery-1.11.2.js"></script>
	<script src="<?php echo $URLPv; ?>lib/bootstrap/js/bootstrap.js"></script>
</head>
<body>
<?php require_once(dirname(__FILE__) . "/lib/header.php"); ?>
<div class="container body">
<?php

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

if(isset($_POST['inputName'])){	
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
}
?>

<?php 	
	$full = array("專任", "兼任"); 
	$title = array("教授", "副教授", "助理教授", "專案教師", "講師"); 
	$pro = array("一般講授課程", "講座課程(邀請講員演講5場以上)", "特殊課程(如學生以外籍生居多、電腦操作、戶外課程多(例如出海)等", "語言課程", "服務學習課程"); 
	$with = array("否", "是"); 
	$week = array("日", "一", "二", "三", "四", "五", "六"); 
	$TA = array("點名", "借用器材及設定軟硬體", "影印講義、考卷或其他資料", "協助作業或考卷批改", "翻譯", "講者接洽", "帶領團體討論", "戶外教學帶隊", "教學PPT製作"); 
?>
	<div class="print-table">
		<h3>國立東華大學通識教育中心<br />
		<?php echo $row['semester']; ?>教學助理申請表（教師用）</h3>
		<table class="table text-left">
			<tr><th colspan="12" class="text-center">教師申請資料</th></tr>
			<tr>
				<td class="text-center">教師姓名</td>
				<td colspan="11"><?php echo $row['name']; ?></td>
			</tr>
			<tr>
				<td class="text-center">任職系所</td>
				<td colspan="7"><?php echo $row['dept']; ?></td>
				<td colspan="2" class="text-center">專/兼任</td>
				<td colspan="2"><?php echo $full[($row['fullOrParttime']-1)]; ?></td>
			</tr>
			<tr>
				<td class="text-center">教師職稱</td>
				<td colspan="11"><?php echo $title[($row['titles']-1)]; ?></td>
			</tr>
			<tr>
				<td class="text-center">手機</td>
				<td colspan="7"><?php echo $row['mobile']; ?></td>
				<td colspan="2" class="text-center">分機</td>
				<td colspan="2"><?php echo $row['ext']; ?></td>
			</tr>
			<tr>
				<td class="text-center">E-mail</td>
				<td colspan="11"><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td class="text-center">課程名稱</td>
				<td colspan="11"><?php echo $row['courseName']; ?></td>
			</tr>
			<tr>
				<td class="text-center">科目代碼</td>
				<td colspan="11"><?php echo $row['courseCode']; ?></td>
			</tr>
			<tr>
				<td class="text-center">TA人數</td>
				<td><?php echo $row['TAamount'] . ($row['TAamount']>=4? "人以上":"人"); ?></td>
				<td rowspan="2" class="text-center need-hour">預期每週工作時數</td>
				<td rowspan="2" colspan="2"><?php echo $row['TAhours'] . "小時"; ?></td>
				<td rowspan="2" colspan="2" class="text-center">時段</td>
				<td rowspan="2" colspan="5">
					<?php 
					for($i=0; $i<count($week); $i++)
						if($row['TAworkday'][$i]=='Y')
							echo "星期" . $week[$i] . "、"; 
					echo "<br />"; 
					if($row['TAworktime'][0]=='Y')
						echo 8 . ":00 ~ "; 
					for($i=1; $i<strlen($row['TAworktime']); $i++){
						if($row['TAworktime'][$i]=='Y' && $row['TAworktime'][($i-1)]=='N')
							echo $i+8 . ":00 ~ "; 
						else if($row['TAworktime'][$i]=='N' && $row['TAworktime'][($i-1)]=='Y')
							echo $i+8 . ":00、";
					}
					if($row['TAworktime'][strlen($row['TAworktime'])-1]=='Y')
						echo strlen($row['TAworktime'])-1+9 . ":00"; 
					?>
				</td>
			</tr>
			<tr>
				<td class="text-center">上傳教學計畫表</td>
				<td><?php echo $with[$row['TAwithClass']]; ?></td>
			</tr>
			<tr class="top bottom">
				<td class="text-center">課程屬性</td>
				<td colspan="11"><?php echo $pro[($row['courseProperty']-1)]; ?></td>
			</tr>
			<tr class="top">
				<td rowspan="2" class="text-center">申請說明（含TA需協助事項）</td>
				<td colspan="5" rowspan="2">
					<?php
						for($i=0; $i<count($TA); $i++){
							if($row['TAcontent'][$i]=='Y')
								echo "■ "; 
							else 
								echo "□ "; 
							echo $TA[$i] . "<br />"; 
						}
					?>
				</td>
				<td colspan="6" style="vertical-align: top; height: 130px; ">
					其他說明：<br />	
				<?php 
					for($i=10; $i<strlen($row['TAcontent']); $i++)
						echo $row['TAcontent'][$i]; 
				?></td>
			</tr>
			<tr>
				<td colspan="2" class="text-center">審核結果</td>
				<td colspan="4">點數：</td>
			</tr>
			<tr>
				<td class="text-center need-apply">申請人<br />簽名</td>
				<td colspan="3" class="need-sign"></td>
				<td class="text-center need-gen">通識中心<br />主任</td>
				<td colspan="5" class="need-sign"></td>
				<td class="text-center need-ce">共同教育<br />委員會<br />主委</td>
				<td class="need-sign"></td>
			</tr>
		</table>
		<p class="text-right">填表時間：<?php echo $row['applyTime']; ?></p>
		<p class="text-center"><a class="print-btn" href="<?php echo $URLPv; ?>index.php"><button class="btn btn-danger">返回修改資料</button></a>
		<a class="print-btn" href="<?php echo $URLPv; ?>printable.php"><button class="btn btn-success">確認，列印申請表</button></a></p>
	</div>
<?php require_once(dirname(__FILE__) . "/lib/footer.php"); ?>
