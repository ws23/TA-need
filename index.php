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

</head>
<body>
<?php require_once(dirname(__FILE__) . "/lib/header.php"); ?>
<div class="container body">
	<div class="need-form">
		<form action="index.php" method="post">
			<div class="form-horizontal">
				<div class="form-group">
					<input type="submit" value="Login" class="form-control btn btn-success"/>
				</div>
			</div>
		</form>
	</div>
</div>

<?php require_once(dirname(__FILE__) . "/lib/footer.php"); ?>
