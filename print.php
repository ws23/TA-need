<?php session_start(); 
require_once(dirname(__FILE__) . "/lib/std.php"); 
require_once(dirname(__FILE__) . "/config.php"); 
if(!isset($_SESSION['stuID'])){
	setLog($DBmain, "warning", "Illegal Entry. "); 
	locate($URLPv . "index.php"); 
}
else{
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
	if(isset($_SESSION['admin'])){
		require_once(dirname(__FILE__) . "/admin.php"); 
		if(isset($_GET['stu'])){
			$result = $DBmain->query("SELECT * FROM `apply` WHERE `stuID` = '{$_GET['stu']}'; "); 
			if($result->num_rows>0)
				$_SESSION['stuID'] = $_GET['stu']; 
			else
				$_SESSION['stuID'] = '0'; 
		}
		else
			$_SESSION['stuID'] = '0'; 
	}
	$result = $DBmain->query("SELECT * FROM `apply` WHERE `stuID` = '{$_SESSION['stuID']}'; ");
	$row = $result->fetch_array(MYSQLI_BOTH); 
	if($row['page'] != 99 && !isset($_SESSION['admin']))
		locate($URLPv . "apply.php"); 
?>
	<div class="apply">
		<div class="reg-title">
			<h3>通識教育中心擔任教學助理（TA）申請書</h3>
			<h4><?php echo $row['semester']; ?>學期</h4>
		</div>
		<div class="reg-info">
			<table class="table table-conedensed table-bordered text-center">
				<tr class="reg-info-id">
					<td class="col-sm-1">學號</td>
					<td class="col-sm-3"><?php echo $row['stuID']; ?></td>
					<td class="col-sm-2">系所/年級</td>
					<td class="col-sm-6" colspan="3"><?php echo $row['dept'] . "/" . $row['grade']; ?></td>
				</tr>
				<tr class="reg-info-name">
					<td class="col-sm-1">姓名</td>
					<td class="col-sm-3"><?php echo $row['name']; ?></td>
					<td class="col-sm-2">行動電話</td>
					<td class="col-sm-2"><?php echo $row['mobile']; ?></td>
					<td class="col-sm-2">學校分機</td>
					<td class="col-sm-2"><?php echo $row['ext']; ?></td>
				</tr>
				<tr class="reg-info-identity">
					<td class="col-sm-1" rowspan="3">身份別</td>
					<td class="col-sm-3" rowspan="3"><?php echo $row['identity']; ?></td>
					<td class="col-sm-2">Email</td>
					<td class="col-sm-6" colspan="3"><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<td class="col-sm-4" colspan="2">TA培訓課程參與場次</td>
					<td class="col-sm-4" colspan="2"><?php echo $row['training']>=5? "5場以上":$row['training'] . "場"; ?></td>
				</tr>
				<tr>
					<td class="col-sm-6" colspan="3">外國留學生、僑生居留台灣天數</td>
					<td class="col-sm-2"><?php echo $row['over183Days']==1? '超過183天':($row['over183Days']==null? '':'未超過183天'); ?></td> 
				</tr>
				<tr class="reg-info-otherjob">
					<td class="col-sm-4" colspan="2">其他單位工作與薪資</td>
					<td class="col-sm-8 text-left" colspan="4"><?php echo $row['otherTA']; ?></td>
				</tr>
				<tr class="reg-info-recommend">
					<td class="col-sm-4" colspan="2">備註/授課老師推薦</td>
					<td class="col-sm-8 text-left" colspan="4"><?php echo $row['recommend']; ?></td>
				</tr>
			</table>
		</div>
		<?php
			function zero($var){
				if($var<10)
					return '0' . $var; 
				return $var; 
			}

			$week = array(
				"Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"
			); 
		?>
		<div class="reg-time">
			<h4>可擔任TA的時段</h4>
			<table class="table table-condensed table-bordered text-center">
				<tr>
					<th class="text-center">#</th>
					<?php for ($i=8; $i<=19; $i++){ ?>
					<th class="text-center"><?php echo zero($i) . "-" . zero($i+1); ?></th>
					<?php } ?>
				</tr>
				<?php for ($i=0; $i<7; $i++) { ?>
				<tr>
					<td><?php echo $week[$i]; ?></td>
					<?php for ($j=0; $j<12; $j++) { ?>
					<td><?php echo $row[$week[$i]][$j]=='Y'? 'O':''; ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="reg-notice">
			<h5>注意事項：</h5>
			<ol>
				<li>本學期起TA改採報名申請制，每位TA薪資設定為5000～10000之間。</li>
				<li>如果您是授課老師推薦的TA，中心會依TA提供的時段，再媒合其他課程，每人負擔至少需二堂課以上。</li>
				<li>本學期因勞動部政策每人需納入勞健保，並簽訂僱用契約書，實際領取薪資等於薪資設定額-勞健保。</li>
				<li>敬請配合於每月20日前上傳TA工作月誌。</li>
				<li>請將此申請書列印並簽名後，於期限內送至通識教育中心始得完成申請。</li>
			</ol>

			<p>以上個人資料及影本證件皆為證明教學助理身份使用，本中心將遵守個人資料保護法及資訊安全保密之相關規定，不另做其他私人或商業用途。</p>
		</div>
		<div class="reg-sign">
			<h3>申請人：_____________</h3>
		</div>
		<div class="reg-attach">
			<?php if($row['cardIDFront']!=null){ ?>
			<h5>身份證影本</h5>
			<table class="table table-bordered text-center">
				<tr>
					<td><img src="<?php echo $URLPv . $row['cardIDFront']; ?>"></td>
					<td><img src="<?php echo $URLPv . $row['cardIDBack']; ?>"></td>
				</tr>
			</table>
			<?php } if($row['AICFront']!=null){ ?>
			<h5>居留證影本</h5>
			<table class="table table-bordered text-center">
				<tr>
					<td><img src="<?php echo $URLPv . $row['AICFront']; ?>"></td>
					<td><img src="<?php echo $URLPv . $row['AICBack']; ?>"></td>
				</tr>
			</table>
			<?php } if($row['workPermissionFront']!=null){ ?>
			<table class="table table-bodered text-center">
				<h5>工作許可證影本</h5>
				<tr>
					<td><img src="<?php echo $URLPv . $row['workPermissionFront']; ?>"></td>
					<td><img src="<?php echo $URLPv . $row['workPermissionBack']; ?>"></td>
				</tr>
			</table>
			<?php } ?>
		</div>
	</div>
</div>
<?php }
