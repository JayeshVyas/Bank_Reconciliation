<?php
//load the database configuration file
include 'DBConfig.php';
//$option1 = $_POST['reconciled'];
//$option2 = $_POST['reconciled2'];

if(isset($_POST['reconciled'])) {
$option1 = $_POST['reconciled'];
$change = "UPDATE bankstatement SET status='1' WHERE id=$option1";
$db->query($change);
echo"Bank data Reconciled Successfully";
echo"\n";
}
else
{
echo"No data selected from bank statement";
echo"\n";
}
if(isset($_POST['reconciled2'])) {
$option2 = $_POST['reconciled2'];
$change1 = "UPDATE internalstatement SET status='1' WHERE id=$option2";
$db->query($change1);
echo"Internal Statement data Reconciled Successfully";
echo"\n";
}
else
{
echo "No data selected from internal statement";
echo"\n";
}

?>
  
