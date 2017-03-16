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
            
            $bank = $_POST["selectBank"];
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE)
            {
                //check whether data already exists in database with same entries
                $prevResults='SELECT * from bankStatement';
                echo $bank;
                if($bank == 'HDFC')
                {
                    $prevQuery = "SELECT id FROM bankStatement WHERE particulars = '".$line[1]."' and cdate = '".$line[0]."' and reference= '".$line[2]."' and deposits = '".$line[4]."' and withdrawals = '".$line[5]."' and bankname = '".$bank."'";
                }
                else if($bank == 'SBI')
                {
                    $prevQuery = "SELECT id FROM bankStatement WHERE particulars = '".$line[2]."' and cdate = '".$line[0]."' and reference= '".$line[3]."' and deposits = '".$line[5]."' and withdrawals = '".$line[4]."' and bankname = '".$bank."'";
                }
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0)
                {
                    
                }
                else
                {
                    //insert bank data into database
                    // If bank name is HDFC
                    if($bank == 'HDFC') 
                    {
                        $sql= "INSERT INTO bankStatement (cdate, particulars, reference, deposits, withdrawals, bankname) VALUES ('$line[0]','$line[1]','$line[2]','$line[4]','$line[5]', '$bank');";
                        $db->query($sql);
                    }
                    
                    //If bank name if SBI
                    else if($bank == 'SBI') 
                    {
                        $sql= "INSERT INTO bankStatement (cdate, particulars, reference, deposits, withdrawals, bankname) VALUES ('$line[0]','$line[2]','$line[3]','$line[5]','$line[4]', '$bank');";
                        $db->query($sql);
                    }
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
header("Location: index.php".$qstring);
