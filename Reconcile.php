<?php
//load the database configuration file
include 'DBConfig.php';

$sql = "SELECT * from internalStatement;";
$result = $db->query($sql);
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        if($row["status"] != 0 && $row["reference"] != '')
        {
            
            $query = "SELECT * from bankStatement;";
            $result1 = $db->query($query);
            while($row1 = $result1->fetch_assoc())
            {
                if($row1["status"] != 0)
                {
                    if(($row["reference"] == $row1["reference"]) && ($row["deposits"] == $row1["deposits"]) && ($row["withdrawals"] == $row1["withdrawals"]) && ($row["bankname"] == $row1["bankname"]))
                    {
                        $change = "UPDATE `bankstatement` SET `status` = '0' WHERE `bankstatement`.`id` =" . $row1["id"];
                        $change1 = "UPDATE `internalstatement` SET `status` = '0' WHERE `internalstatement`.`id` =" . $row["id"];
                        $db->query($change);
                        $db->query($change1);
                    }
                }
            }
        }
    }
}

?>