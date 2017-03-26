<?php
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
<html lang="en">
<head>
  <title>Bank Statement</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js" ></script>
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
  
</head>
<body>
<form action="changestatus.php" method="post" id="manage">
<div class="container-fluid" >
  <?php if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
        } ?>
		
		
		 
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="background-color:white;">
    <!--<div class="container-fluid">
                     Statement
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Another Statement</a>
			<form action="importData.php" method="post" enctype="multipart/form-data" id="importFrm">
                Select Bank <br />
                <input type="radio" name="selectBank" value="HDFC" checked> HDFC &nbsp;&nbsp;
                <input type="radio" name="selectBank" value="SBI"> SBI &nbsp;&nbsp;
                <br />
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
    </div>-->
</nav>


  <div class="row">
    <div class="col-sm-6" style="background-color:white">
    	                                                                             
  <div class="table-responsive">          
  <table  id="preTable" class="table table-striped" >
						<thead>
							<tr>
                        <th>Date</th>
                        <th>Particulars</th>
                        <th>Cheque/Ref. No.</th>
                        <th>Deposits</th>
                        <th>Withdrawals</th>
                        <th>Bank Name</th>
                        <th>Status</th>
						<th></th>
                    </tr>	
						</thead>
						<tbody>
						<?php
						//	require("filedata.php");
						$sql = "SELECT * FROM bankstatement";
						$result  = mysqli_query($db,$sql);
						if($result->num_rows > 0){
						while($row=mysqli_fetch_array($result)){
                                                   if($row['status'] == 0)
                                                   {			
?>						
						 <tr>
						
                        <td><?php echo $row['cdate']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['deposits']; ?></td>
                        <td><?php echo $row['withdrawals']; ?></td>
                        <td><?php echo $row['bankname']; ?></td>
                        <td><?php echo $row['status'];?></td>
						<td><input type="radio" name="reconciled" value="<?php echo $row['id'] ?>"><br><label for="reconcile bank stmt"></label></td>

                    
					</tr>
					
						<?php }
}
}						?>
						</tbody>
						</table>
  </div>
    
    </div>
    <div class="col-sm-6" style="background-color:lavenderblush;">
                                     
  <div class="table-responsive">          
  <table  id="preTable2" class="table table-striped" >
						<thead>
							<tr>
						<th></th>
                        <th>Date</th>
                        <th>Particulars</th>
                        <th>Cheque/Ref. No.</th>
                        <th>Deposits</th>
                        <th>Withdrawals</th>
                        <th>Bank Name</th>
                        <th>Status</th>
						<th></th>
                    </tr>	
						</thead>
						<tbody>
						<?php 	
						//	require("filedata.php");
						$sql = "SELECT * FROM internalstatement";
						$result  = mysqli_query($db,$sql);
						if($result->num_rows > 0)
						{
						while($row=mysqli_fetch_array($result)){
                                                  if($row['status'] == 0)
                                                  {					
?>						
						 <tr>
						<td><input type="radio" name="reconciled2" value="<?php echo $row['id'] ?>"><br><label for="reconcile bank stmt"></label></td>
                        <td><?php echo $row['cdate']; ?></td>
                        <td><?php echo $row['particulars']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['deposits']; ?></td>
                        <td><?php echo $row['withdrawals']; ?></td>
                        <td><?php echo $row['bankname']; ?></td>
                        <td><?php echo $row['status'];?></td>
						</tr>
						<?php }
}
}						?>
    </tbody>
  </table>
  </div>
    </div>
  </div>
</div>
    <script>
			$(document).ready(function(){    
			$('#preTable').dataTable({
				"order": [[ 1, "desc" ]],
				responsive: true
			});
			
			$('#preTable2').dataTable({
				"order": [[ 1, "desc" ]],
				responsive: true
			});
	});
	</script>
		<input type="submit" form="manage" name="Submit" value="Reconcile Checked"style="float: right;"></button>

	
	</form>
</body>
</html>
