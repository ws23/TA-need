<?php session_start(); 
require_once(dirname(__FILE__) . "/lib/std.php"); 
require_once(dirname(__FILE__) . "/config.php"); 
if(!isset($_SESSION))
	locate($URLpv . "index.php"); 

?>
<!Doctype html>
<html>
<head>
	<meta charset="utf8">
	<title>104-1通識教育中心教學助理申請表（教師用）</title>
	<link rel="stylesheet" href="<?php echo $URLPv; ?>lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $URLPv; ?>index.css">
	<script src="<?php echo $URLPv; ?>lib/jquery/jquery-1.11.2.js"></script>
	<script src="<?php echo $URLPv; ?>lib/bootstrap/js/bootstrap.js"></script>
	<script>
		print(); 
		function wait(){
			setTimeout('window.location.href = "<?php echo $URLPv; ?>print.php"', 10); 
		}
	</script>
</head>
<body onload="wait(); ">
<div class="container body">
<?php
	$result = $DBmain->query("SELECT * FROM `need` WHERE `id` = '{$_SESSION['stuID']}'; ");
	$row = $result->fetch_array(MYSQLI_BOTH);
	$id = $_SESSION['stuID'];
	$DBmain->query("UPDATE `need` SET `printTimes` = " . ($row['printTimes']+1) . " WHERE `id` =  '{$id}'; "); 
?>

<?php 	
	$full = array("專任", "兼任"); 
	$title = array("教授", "副教授", "助理教授", "專案教師", "講師"); 
	$pro = array("一般講授課程", "講座課程(邀請講員演講5場以上)", "特殊課程(如學生以外籍生居多、電腦操作、戶外課程多(例如出海)等", "語言課程", "服務學習課程"); 
	$with = array("否", "是"); 
	$week = array("日", "一", "二", "三", "四", "五", "六"); 
	$TA = array("點名", "借用器材及設定軟硬體", "影印講義、考卷或其他資料", "協助作業或考卷批改", "翻譯", "講者接洽", "帶領團體討論", "戶外教學帶隊", "教學PPT製作"); 
?>
	<div class="print-table printable">
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
				<td rowspan="2" style="width: 70px" class="text-center need-hour">預期每週工作時數</td>
				<td rowspan="2" colspan="2"><?php echo $row['TAhours'] . "小時"; ?></td>
				<td rowspan="2" colspan="2" class="text-center">時段</td>
				<td rowspan="2" colspan="5">
					<?php 
					for($i=0; $i<count($week); $i++)
						if($row['TAworkday'][$i]=='Y')
							echo "星期" . $week[$i] . "、"; 
					echo "<br />"; 
					if($row['TAworktime'][0]=='Y')
						echo $i+8 . ":00 ~ "; 
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
				<td colspan="5" rowspan="2" style="width: 220px; ">
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
		<p style="margin-top: -15px; " class="text-right">填表時間：<?php echo $row['applyTime']; ?><br />
		列印時間：<?php echo date("Y-m-d H:i:s", time()); ?></p>
    </p>
<p class="notice" style="font-size: 8pt; margin-top: -50px; ">注意事項：
<ol>
<li>104-1學期起通識教育中心教學助理(TA)全面改採申請制。</li>
<li>申請教師請務必確認該學期教學計劃表是否已上傳，通識教育中心將會印下教學計劃表
為附件。</li>
<li>該申請書截止收件日為每學期開學前7日。</li>
<li>貴課程教學數理(TA)點數確認日為開學前5日。</li>
<li>如已有屬意之教學助理，請於點數確認日後提醒該助理至通識教育中心網站報名。</li>
<li>最終各課程點數及教學助理名單仍需依通識教育中心審核為準。</li>
<li>以上個人資料本中心將遵守個人資料保護法及資訊安全保密之相關規定，不另做其他私
人或商業用途。</li>
    </ol>
</p>
	</div>
