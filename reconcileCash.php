<?php
$name = $_POST['cashEntry'];

// optional
// echo "You chose the following color(s): <br>";

foreach ($name as $cashEntry)
{
    
    //load the database configuration file
    include 'DBConfig.php';

    $sql = "SELECT * from internalStatement where `id`='$cashEntry';";
    $result = $db->query($sql);
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $query = "SELECT * from bankStatement;";
            $result1 = $db->query($query);
            while($row1 = $result1->fetch_assoc())
            {
                //Reconcile record with cash
                $iparticulars = $row["particulars"];
                $iparticulars = strtolower($iparticulars);

                $bparticulars = $row1["particulars"];
                $bparticulars = strtolower($bparticulars);

                //Regular expression
                if (preg_match('/cash/',$iparticulars) && preg_match('/cash/',$bparticulars))
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
            }
        }    
    }
}
?>