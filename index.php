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
		
	}
?>

<div class="container body">
	<h2>104-1通識課程TA需求調查</h2>
	<p>
親愛的老師您好，本學期起因中心配合勞動部政策，通識教學助理(TA)皆要納保，因對經費上的影響甚鉅，故此本中心希望能提前了解貴課程TA的工作內容，以利行政上流程。
	</p>
	<div class="need-form">
		<form action="print.php" method="post" data-toggle="validator" role="form">
			<div class="form-group">
				<label for="inputName" class="control-label">教師姓名</label>
				<input type="text" class="form-control" value="" id="inputName" placeholder="教師姓名" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputDept" class="control-label">任職系所</label>
				<input type="text" class="form-control" id="inputDept" placeholder="任職系所" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputFull" class="control-label">專/兼任</label>
				<div class="radio" data-error="*必填">
					<label>
						<input type="radio" name="inputFull" id="inputFull" value="full" required>
						專任
					</label>
					<label>
						<input type="radio"  name="inputFull" id="inputFull" value="part" required>
						兼任
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputTitles" class="control-label">教師職稱</label>
				<div class="radio" data-error="*必填">
					<label>
						<input type="radio" name="inputTitles" id="inputTitles" value="professor" required>
						教授
					</label>
					<label>
						<input type="radio" name="inputTitles" id="inputTitles" value="associate" required>
						副教授
					</label>
					<label>
						<input type="radio" name="inputTitles" id="inputTitles" value="assistant" required>
						助理教授
					</label>
					<label>
						<input type="radio" name="inputTitles" id="inputTitles" value="project" required>
						專案教師
					</label>
					<label>
						<input type="radio" name="inputTitles" id="inputTitles" value="lecturer" required>
						講師
					</label>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputMobile" class="control-label">教師手機</label>
				<input type="text" class="form-control" id="inputMobile" placeholder="0912-345678" data-error="*必填" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label for="inputExt" class="control-label">校內分機</label>
				<input type="text" class="form-control" id="inputExt" placeholder="2602">
			</div>
			<div class="form-group">
				<label for="inputEmail" class="control-label">Email</label>
				<input type="email" class="form-control" id="inputEmail" placeholder="xxxxx@xxxxxx" data-error="*必填，若已填請檢查是否輸入格式錯誤" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary disabled">送出</button>
			</div>
		</form>
	</div>



  <div class="form-group">
    <div class="checkbox">
      <label>
        <input type="checkbox" id="terms" data-error="Before you wreck yourself" required>
        Check yourself
      </label>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</form>	
	
	</div>
</div>

<?php require_once(dirname(__FILE__) . "/lib/footer.php"); ?>
