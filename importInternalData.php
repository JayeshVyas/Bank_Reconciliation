<?php
//load the database configuration file
include 'DBConfig.php';

if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE)
            {
                //check whether data already exists in database with same entries
                $prevResults='SELECT * from internalStatement';
                $prevQuery = "SELECT id FROM internalStatement WHERE particulars = '".$line[1]."' and cdate = '".$line[0]."' and reference= '".$line[2]."' and deposits = '".$line[4]."' and withdrawals = '".$line[5]."' and bankname = '".$line[3]."'";
                
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0)
                {
                    
                }
                else
                {
                    //insert internal data into database
                    $sql= "INSERT INTO internalStatement (cdate, particulars, reference, deposits, withdrawals, bankname) VALUES ('$line[0]','$line[1]','$line[2]','$line[4]','$line[5]', '$line[3]');";
                    $db->query($sql);
                }
            }
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: internal_statement.php".$qstring);