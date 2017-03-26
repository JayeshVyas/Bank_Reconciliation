<?php
//load the database configuration file
include 'DBConfig.php';
//$option1 = $_POST['reconciled'];
//$option2 = $_POST['reconciled2'];

if(isset($_POST['reconciled']) && (isset($_POST['reconciled2']))) {
$option1 = $_POST['reconciled'];
$option2 = $_POST['reconciled2'];
$change = "UPDATE bankstatement SET status='1' WHERE id=$option1";
$change1 = "UPDATE internalstatement SET status='1' WHERE id=$option2";
$db->query($change);
$db->query($change1);
echo"data Reconciled Successfully";
echo"\n";
}
else
{
echo"error";
echo"\n";
}


?>
  