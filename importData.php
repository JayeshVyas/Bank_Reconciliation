<?php
include 'DBConfig.php';
?>

<?php
if(isset($_POST['importSubmit']))
{
    //Checking whether the uploaded file is csv or not
    $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if(in_array($_FILES['file']['type'],$mimes))
    {
        if(is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $csv = fopen($_FILES['file']['tmp_name'], 'r');
            $bank = $_POST["selectBank"];
            
            //Skipping lines
            if($bank == 'SBI')
            {
                for($i=0; $i<20; $i++)
                    fgetcsv($csv);
            }
            else
            {
                fgetcsv($csv);
            }
            
            //Reading data from file
            while(($line = fgetcsv($csv)) !== FALSE)
            {
                //If data is already present then skip
                $prevResults='SELECT * from bankStatement';
                echo $bank;
                if($bank == 'HDFC')
                {
                    $prevQuery = "SELECT id FROM bankStatement WHERE particulars = '".$line[1]."' and cdate = '".$line[0]."' and reference= '".$line[2]."' and deposits = '".$line[4]."' and withdrawals = '".$line[5]."' and bankname = '".$bank."'";
                }
                else if($bank == 'SBI' && $line[2]!='')
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
            fclose($csv);
            $st = 'success';
        }
        else
            $st = 'error';
    }
    else
        $st = 'invalid_file';
}

//redirect to the listing page
header("Location: index.php?st=".$st);
?>
