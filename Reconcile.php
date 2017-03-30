<?php
//load the database configuration file
include 'DBConfig.php';

$sql = "SELECT * from internalStatement;";
$result = $db->query($sql);
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $query = "SELECT * from bankStatement;";
        $result1 = $db->query($query);
        while($row1 = $result1->fetch_assoc())
        {
            $bref = $row1["reference"];
            $iref = $row["reference"];
            $bref = ltrim($bref, '0');
            $iref = ltrim($iref, '0');
            
            if($row["status"] != 1 && $row["reference"] != '' && $row1["status"] != 1)
            {
                //Reconcile record having common reference number
                if(($iref == $bref) && ($row["deposits"] == $row1["deposits"]) && ($row["withdrawals"] == $row1["withdrawals"]) && ($row["bankname"] == $row1["bankname"]))
                {
                    $bid = $row1["id"];
                    $change = "UPDATE `bankstatement` SET `status` = '1' WHERE `bankstatement`.`id` =" . $row1["id"];
                    $change1 = "UPDATE `internalstatement` SET `status` = '1' WHERE `internalstatement`.`id` =" . $row["id"];
                    $change2 = "UPDATE `internalstatement` SET `bid`=$bid WHERE `internalstatement`.`id` =" . $row["id"];
                    $db->query($change);
                    $db->query($change1);
                    $db->query($change2);
                }
            }
            
            //Reconcile record with cash
            $iparticulars = $row["particulars"];
            $iparticulars = strtolower($iparticulars);
            
            $bparticulars = $row1["particulars"];
            $bparticulars = strtolower($bparticulars);
            
            
            //Regular expression
            if (preg_match('/cash/',$iparticulars) && preg_match('/cash/',$bparticulars))
            {
                
            }
            
            //Regular expression
            else if (preg_match('/atm/',$iparticulars) && preg_match('/atm/',$bparticulars))
            {
                if(($row["deposits"] == $row1["deposits"]) && ($row["withdrawals"] == $row1["withdrawals"]) && ($row["bankname"] == $row1["bankname"]))
                {
                    $bid = $row1["id"];
                    $change = "UPDATE `bankstatement` SET `status` = '1' WHERE `bankstatement`.`id` =" . $row1["id"];
                    $change1 = "UPDATE `internalstatement` SET `status` = '1' WHERE `internalstatement`.`id` =" . $row["id"];
                    $change2 = "UPDATE `internalstatement` SET `bid`=$bid WHERE `internalstatement`.`id` =" . $row["id"];
                    $db->query($change);
                    $db->query($change1);
                    $db->query($change2);
                }
            }
            
            else if($row["status"] != 1 && $row["reference"] == '' && $row1["status"] != 1)
            {
                //Reconcile record having common reference number
                if($row["deposits"] == $row1["deposits"] && ($row["withdrawals"] == $row1["withdrawals"]) && ($row["bankname"] == $row1["bankname"]) && (strtolower(ltrim($row["particulars"], ' ')) == strtolower(ltrim($row1["particulars"], ' '))))
                {
                    $bid = $row1["id"];
                    $change = "UPDATE `bankstatement` SET `status` = '1' WHERE `bankstatement`.`id` =" . $row1["id"];
                    $change1 = "UPDATE `internalstatement` SET `status` = '1' WHERE `internalstatement`.`id` =" . $row["id"];
                    $change2 = "UPDATE `internalstatement` SET `bid`=$bid WHERE `internalstatement`.`id` =" . $row["id"];
                    $db->query($change);
                    $db->query($change1);
                    $db->query($change2);
                }
            }
        }
    }    
}
?>
