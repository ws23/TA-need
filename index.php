<?php session_start();  ?>
<?php require_once(dirname(__FILE__) . "/lib/std.php");  ?>
<!Doctype html>
<?php require_once(dirname(__FILE__) . "/config.php");  ?>
<html>
<head>
	<meta charset="utf8">
	
	<title>通識課程TA需求調查</title>
	<link rel="stylesheet" href="<?php echo $URLPv; ?>lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $URLPv; ?>index.css">
	<script src="<?php echo $URLPv; ?>lib/jquery/jquery-1.11.2.js"></script>
	<script src="<?php echo $URLPv; ?>lib/bootstrap/js/bootstrap.js"></script>
	<script src="<?php echo $URLPv; ?>lib/validator.min.js"></script>

</head>
<body>
<?php require_once(dirname(__FILE__) . "/lib/header.php"); 
	if(isset($_SESSION['stuID'])){
		$result = $DBmain->query("SELECT * FROM `need` WHERE `id` = {$_SESSION['stuID']}"); 
		$row = $result->fetch_array(MYSQLI_BOTH); 
	}
?>

<div class="container body">
	<h2>104-1通識課程TA需求調查</h2>
	<p>
親愛的老師您好，本學期起因中心配合勞動部政策，通識教學助理(TA)皆要納保，因對經費上的影響甚鉅，故此本中心希望能提前了解貴課程TA的工作內容，以利行政上流程。
	</p>
	<div class="need-form">
		<form action="print.php" method="post" data-toggle="validator" role="form" class="form-horizontal">
			<div class="form-group">
				<label for="inputName" class="control-label">教師姓名</label>
				<span class="help-block">您與其他老師合授，請由一位老師代表填寫即可。</span>
				<input type="text" name="inputName" class="form-control" value="<?php if(isset($_SESSION['stuID'])) echo $row['name']; ?>" id="inputName" placeholder="教師姓名" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputDept" class="control-label">任職系所</label>
				<input type="text" name="inputDept" value="<?php if(isset($_SESSION['stuID'])) echo $row['dept']; ?>" class="form-control" id="inputDept" placeholder="任職系所" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputFull" class="control-label">專/兼任</label>
				<div class="radio" data-error="*必填">
					<label>
						<input type="radio" name="inputFull" value="full" <?php if(isset($_SESSION['stuID'])) if($row['fullOrParttime']==1) echo "checked "; ?>required>
						專任
					</label>
					<label>
						<input type="radio" name="inputFull" value="part" <?php if(isset($_SESSION['stuID'])) if($row['fullOrParttime']==2) echo "checked "; ?>required>
						兼任
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTitles" class="control-label">教師職稱</label>
				<div class="radio" data-error="*必填">
					<?php 
						$arr = array(
							array("professor", "教授"), 
							array("associate", "副教授"), 
							array("assistant", "助理教授"), 
							array("project", "專案教師"), 
							array("lecturer", "講師")
						); 
						for($i=0; $i<count($arr); $i++) { ?>
					<label>
						<input type="radio" name="inputTitles" value="<?php echo $arr[$i][0]; ?>" <?php if(isset($_SESSION['stuID'])) if($row['titles']==($i+1)) echo "checked "; ?>required>
						<?php echo $arr[$i][1]; ?>
					</label>
					<?php } ?>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputMobile" class="control-label">教師手機</label>
				<input type="text" name="inputMobile" value="<?php if(isset($_SESSION['stuID'])) echo $row['mobile']; ?>" class="form-control" id="inputMobile" placeholder="0912-345678" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputExt" class="control-label">校內分機</label>
				<input type="text" name="inputExt" value="<?php if(isset($_SESSION['stuID'])) echo $row['ext']; ?>" class="form-control" id="inputExt" placeholder="2602">
			</div>
			<div class="form-group">
				<label for="inputEmail" class="control-label">Email</label>
				<input type="email" name="inputEmail" value="<?php if(isset($_SESSION['stuID'])) echo $row['email']; ?>" class="form-control" id="inputEmail" placeholder="xxxxx@xxxxxx" data-error="*必填，若已填請檢查是否輸入格式錯誤" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputCourseCode" class="control-label">科目代碼</label>
				<span class="help-block">可至<a href="http://sys.ndhu.edu.tw/aa/class/course/Default.aspx" target="_blank">全校開課查詢系統</a>查詢。課程如屬性相同(例如語文類或開兩門以上課名相同的課程)，可合在這份問卷填寫，代碼之間以"、"號隔開</span>
				<input type="text" name="inputCourseCode" value="<?php if(isset($_SESSION['stuID'])) echo $row['courseCode']; ?>" class="form-control" id="inputCourseCoed" placeholder="GC__xxxxx、GC__xxxxxx" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputCourseName" class="control-label">科目名稱</label>
				<span class="help-block">課程如屬性相同(例如語文類或開兩門以上課名相同的課程)，可合在這份問卷填寫，名稱之間以"、"號隔開</span>
				<input type="textarea" name="inputCourseName" value="<?php if(isset($_SESSION['stuID'])) echo $row['courseName']; ?>" class="form-control" id="inputCourseName" placeholder="中文能力與涵養AB、資訊與倫理" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputCourseProperty" class="control-label">課程屬性</label>
				<div class="radio" data-error="*必填">
					<?php 
						$arr = array(
							array("general", "一般講授課程"), 
							array("lecture", "講座課程(邀請講員演講5場以上)"), 
							array("special", "特殊課程(如學生以外籍生居多、電腦操作、戶外課程多(例如出海)等"), 
							array("language", "語言課程"), 
							array("service", "服務學習課程")
						); 
					for($i=0; $i<count($arr); $i++) {
					?>
					<label>
						<input type="radio" name="inputCourseProperty" value="<?php echo $arr[$i][0]; ?>" <?php echo isset($_SESSION['stuID'])? ($row['courseProperty']==($i+1)? "checked ":""):""; ?>required> 
					<?php echo $arr[$i][1]; ?>
					</label>
					<?php } ?>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTAamount" class="control-label">TA需求人數</label>
				<div class="radio" data-error="*必填">
					<?php for($i=0; $i<5; $i++) { ?>
					<label>
						<input type="radio" name="inputTAamount" value="<?php echo $i; ?>" <?php echo isset($_SESSION['stuID'])? ($row['TAamount']==$i? "checked ":""):""; ?>required>
						<?php echo $i==4? "{$i}人以上":"{$i}人"; ?>
					</label>
					<?php } ?>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTAwithClass" class="control-label">TA需要跟課與否</label>
				<div class="radio" data-error="*必填">
					<label>
						<input type="radio" name="inputTAwithClass" value="Y" <?php echo isset($_SESSION['stuID'])? ($row['TAwithClass']==1? "checked ":""):""; ?>required>
						是
					</label>
					<label>
						<input type="radio" name="inputTAwithClass" value="N" <?php echo isset($_SESSION['stuID'])? ($row['TAwithClass']==0? "checked ":""):""; ?>required>
						否
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTAhours" class="control-label">預期每週工作時數</label>
				<div class="input-group">
					<input type="text" class="form-control" id="inputTAhours" name="inputTAhours" value="<?php echo isset($_SESSION['stuID'])? $row['TAhours']:""; ?>"data-error="*必填" required>
					<span class="input-group-addon">小時</span>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTAworkday" class="control-label">預期TA工作日</label>
				<div class="checkbox">
					<?php 
						$weekday = array("日", "一", "二", "三", "四", "五", "六"); 
						for($i=0; $i<count($weekday); $i++) { ?>
					<label>
						<input type="checkbox" name="inputTAworkday[]" value="<?php echo $i; ?>" <?php echo isset($_SESSION['stuID'])? ($row['TAworkday'][$i]=='Y'? "checked ":""):""; ?> data-error="*必填">
						星期<?php echo $weekday[$i]; ?>
					</label>
					<?php } ?>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTAworktime" class="control-label">預期TA工作時段</label>
				<div class="checkbox">
					<?php 
						for($i=0; $i<13; $i++) { ?>
					<label>
						<input type="checkbox" name="inputTAworktime[]" value="<?php echo $i; ?>" <?php echo isset($_SESSION['stuID'])? ($row['TAworktime'][$i]=='Y'? "checked ":""):""; ?> data-error="*必填">
						<?php echo ($i+8) . "：00～" . ($i+9) . "：00"; ?>
					</label>
					<?php } ?>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTAcontent" class="control-label">TA工作內容</label>
				<div class="checkbox">
					<?php 
						$arr = array("點名", "借用器材及設定軟硬體", "影印講義、考卷或其他資料", "協助作業或考卷批改", "翻譯", "講者接洽", "帶領團體討論", "戶外教學帶隊", "教學PPT製作");
						for($i=0; $i<count($arr); $i++) {
					?>
					<label>
						<input type="checkbox" name="inputTAcontent[]" value="<?php echo $i; ?>" <?php echo isset($_SESSION['stuID'])? ($row['TAcontent'][$i]=='Y'? "checked ":""):""; ?>>
						<?php echo $arr[$i]; ?>
					</label>
					<?php } ?>
					<label>
						<input type="checkbox" name="inputTAcontent[]" id="other" value="<?php echo count($arr); ?>" <?php echo isset($_SESSION['stuID'])? ($row['TAcontent'][$i]=='Y'? "checked ":""):""; ?>>
					其他：
					<input type="text" name="other" onclick="document.getElementById('other').setAttribute('checked', ''); ">
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">送出</button>
			</div>
		</form>
	</div>
	</div>
</div>

<?php require_once(dirname(__FILE__) . "/lib/footer.php"); ?>
