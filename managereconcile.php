<?php
//load the database configuration file
include 'DBConfig.php';
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
<form action="managerecon.php" method="post" id="manage">
    <div class="container">
        <h2>Bank Statement</h2>
        <?php if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
        } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Statement
        </div>
        <div class="panel-body">

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
                    $i=0;
                        while($row = $query->fetch_assoc()){
                        ?>
                         <form action="" method="post" enctype="multipart/form-data">
                         <tr>
                            <td><?php echo $row['cdate']; ?></td>
                            <td><?php echo $row['particulars']; ?></td>
                            <td><?php echo $row['reference']; ?></td>
                            <td><?php echo $row['deposits']; ?></td>
                            <td><?php echo $row['withdrawals']; ?></td>
                            <td><?php echo $row['bankname']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><input type="checkbox" name="ch[$i++]"/><label for="reconcile bank stmt"></label></td>
                        </tr>
                     </form>
                    <?php } 
                    }else{ ?>
                    <tr><td colspan="8">No record(s) found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
        <h2>Internal Statement</h2>
        <?php if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
        } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Statement
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Particulars</th>
                        <th>Cheque/Ref. No.</th>
                        <th>Bank Name</th>
                        <th>Deposits</th>
                        <th>Withdrawals</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //get rows query
                    $query = $db->query("SELECT * FROM internalstatement");
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
                        <td><input type="checkbox" name="ch1"/><label for="reconcile internal"></label></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="8">No record(s) found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

 </form>
 <button type="submit" form="manage" value="Submit" style="float: right;">Reconcile Checked</button>
</body>
</html>
