<?php
include 'DBConfig.php';
$msg= '';
if(!empty($_GET['st']))
{
    if($_GET['st'] == 'success')
    {
        $msg = 'Statement has been uploaded successfully.';
    }
    else if($_GET['st'] == 'error')
    {
        $msg = 'Some problem occurred. Please try again.';
    }
    else if($_GET['st'] == 'invalid_file')
    {
        $msg = 'Please upload a valid CSV file.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bank Reconciliation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style1.css">

    <script src="js/js1.js"></script>
    <script src="js/js2.js"></script>
    <style type="text/css">
        a:link, a:visited, a:active{
            color: #F39C12;
        }
        a:hover{
            color: #E59866;
        }
        #importFrm{
            margin-bottom: 20px;
            display: none;
        }
        #importFrm input[type=file] {
            display: inline;
        }
    </style>
    </head>

    <body>
        <div class="container">
            <h2 align="center">Internal Statement</h2>
            
        
    <div class="panel">
        
        <?php
        if($msg == '')
        {
            
        }
        else if($msg=='Statement has been uploaded successfully.'){ ?>
            <div id="deletesuccess" style="display:inline-block; float:right; background-color: #ABEBC6; padding: 10px 40px 10px 40px; width: 100%; border: 0px solid; border-radius=10%;">
                <?php echo $msg; ?>
            </div>
            <?php }
            else{?>
            <div id="deletesuccess" style="display:inline-block; float:right; background-color: #F5B7B1; padding: 10px 40px 10px 40px; width: 100%; border-radius=5%;">
                <?php echo $msg; ?>
            </div>
            <?php } ?>
        
        <div class="panel-body" id="maindiv">
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();" style="font-size:18px; text-decoration:none;">Import Another Statement</a>
            
            <form action="importInternalData.php" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-warning btn-small" name="importSubmit" value="Import">
            </form>
            
            <script type="text/javascript"> 
                $(document).ready( function() {
                    $('#deletesuccess').delay(2000).fadeOut();
                });
            </script>
            
            <table class="table" border="1px groove" style="border-color: #85929E">
                <thead>
                    <tr border="1px">
                        <th>Date</th>
                        <th>Particulars</th>
                        <th>Cheque/Ref. No.</th>
                        <th>Deposits</th>
                        <th>Withdrawals</th>
                        <th>Bank Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //get rows query
                    $query = $db->query("SELECT * FROM internalstatement");
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){
                            if($row['status'] == 0)
                            {
                        ?>
                    <tr style="background-color: #FDEDEC">
                        <td><?php echo $row['cdate']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['deposits']; ?></td>
                        <td><?php echo $row['withdrawals']; ?></td>
                        <td><?php echo $row['bankname']; ?></td>
                        <td>Unreconciled</td>
                    </tr>
                    <?php
                            }
                            else
                            {
                            ?>
                    <tr style="background-color: #E8F8F5">
                        <td><?php echo $row['cdate']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['deposits']; ?></td>
                        <td><?php echo $row['withdrawals']; ?></td>
                        <td><?php echo $row['bankname']; ?></td>
                        <td>Reconciled</td>
                    </tr>
                    <?php
                            }
                            ?>
                    <?php } }else{ ?>
                    <tr><td colspan="8">No statement(s) to be displayed...</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

