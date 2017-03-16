<?php
//load the database configuration file
include 'DBConfig.php';

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Statement has been uploaded successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bank Statement</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .panel-heading a{float: right;}
        #importFrm{margin-bottom: 20px;display: none;}
        #importFrm input[type=file] {display: inline;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Bank Statement</h2>
        <?php if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
        } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Statement
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Another Statement</a>
        </div>
        <div class="panel-body">
            <form action="importData.php" method="post" enctype="multipart/form-data" id="importFrm">
                Select Bank <br />
                <input type="radio" name="selectBank" value="HDFC" checked> HDFC &nbsp;&nbsp;
                <input type="radio" name="selectBank" value="SBI"> SBI &nbsp;&nbsp;
                <br />
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
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
                    $query = $db->query("SELECT * FROM bankstatement");
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){
                        ?>
                    <tr>
                        <td><?php echo $row['cdate']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['deposits']; ?></td>
                        <td><?php echo $row['withdrawals']; ?></td>
                        <td><?php echo $row['bankname']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="8">No record(s) found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
