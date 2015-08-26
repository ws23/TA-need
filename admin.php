<?php  
require_once(dirname(__FILE__) . "/lib/std.php"); 
require_once(dirname(__FILE__) . "/config.php"); 
if(!isset($_SESSION['stuID'])){
	setLog($DBmain, "warning", "Illegal Entry. "); 
	locate($URLPv . "index.php"); 
}
else{ ?>
<h2>申請填寫完畢者：</h2>
<p>
<?php
$result = $DBmain->query("SELECT `stuID` FROM `apply` WHERE `page` = 99; "); 
while($row = $result->fetch_array(MYSQLI_BOTH)){ ?>
<a href="<?php echo $URLPv . "print.php?stu=" . $row['stuID']; ?>"><?php echo $row['stuID']; ?></a>&nbsp; 

<?php } ?>
</p>

<h2>正在填寫申請者：</h2>
<p>
<?php
$result = $DBmain->query("SELECT `stuID` FROM `apply` WHERE `page` != 99; "); 
while($row = $result->fetch_array(MYSQLI_BOTH)){ ?>
<a href="<?php echo $URLPv . "print.php?stu=" . $row['stuID']; ?>"><?php echo $row['stuID']; ?></a>&nbsp; 

<?php } ?>
</p>


<?php } ?>
