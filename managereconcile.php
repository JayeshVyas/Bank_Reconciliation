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
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <script src="js/js1.js"></script>
    <script src="js/js2.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js" ></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script>
        x = 0;
        function myFunction(a)
        {
            if (x==0)
            {
                document.getElementById(a).innerHTML = a;
                x = 1;
            }
            else
            {
                b = a.substring(0, 8);
                document.getElementById(a).innerHTML = b;
                x = 0;
            }
        }
    </script>
    <style>
        body, td, th
        {
            font-size: 14px;
        }
        td 
        {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<form action="changestatus.php" method="post" id="manage">
<div class="container-fluid" >
  <?php if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
        } ?>
		
		
		 
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="background-color:white;"></nav>


  <div class="row">
    <div class="col-sm-6" style="background-color:white">
    	                                                                             
  <div class="table-responsive">          
  <table  id="preTable" class="table table-striped" >
						<thead>
							<tr>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Cheque/Ref.</th>
                                <th>Deposits</th>
                                <th>Withdrawals</th>
                                <th>Bank</th>
                                <th>Rec.</th>
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
                                
                                <td>
                                    <?php
                                        $date = $row['cdate'];
                                        echo substr("$date", 0, 6);
                                    ?>
                                </td>
                                
                                <?php $particulars = $row['particulars'];?>
                                <td onclick="myFunction('<?php echo $particulars; ?>');">
                                    <span id="<?php echo $particulars; ?>">
                                        <?php
                                            echo substr("$particulars", 0, 8) . "...";
                                        ?>
                                    </span>
                                </td>
                                
                                <?php $ref = $row['reference'];?>
                                <td onclick="myFunction('<?php echo $ref; ?>');">
                                    <span id="<?php echo $ref; ?>">
                                        <?php
                                            echo substr("$ref", 0, 7) . "...";
                                        ?>
                                    </span>
                                </td>
                                
                                <td><?php echo $row['deposits']; ?></td>
                                <td><?php echo $row['withdrawals']; ?></td>
                                <td><?php echo $row['bankname']; ?></td>
                                <td>
                                    <input type="radio" name="reconciled" value="<?php echo $row['id'] ?>"><br>
                                    <label for="reconcile bank stmt"></label>
                                </td>

                    
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
                                <th>Rec.</th>
                                <th>Date</th>
                                <th>Particulars</th>
                                <th>Cheque/Ref.</th>
                                <th>Deposits</th>
                                <th>Withdrawals</th>
                                <th>Bank</th>
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
                             <td>
                                 <input type="radio" name="reconciled2" value="<?php echo $row['id'] ?>"><br>
                                 <label for="reconcile bank stmt"></label>
                             </td>
                             
                             <td>
                                 <?php
                                    $date = $row['cdate'];
                                    echo substr("$date", 0, 6);
                                ?>
                            </td>
                             
                            <?php $particulars = $row['particulars'];?>
                            <td onclick="myFunction('<?php echo $particulars; ?>');">
                                <span id="<?php echo $particulars; ?>">
                                <?php
                                    echo substr("$particulars", 0, 8) . "...";
                                ?>
                                </span>
                            </td>
                             
                             <?php $ref = $row['reference'];?>
                                <td onclick="myFunction('<?php echo $ref; ?>');">
                                    <span id="<?php echo $ref; ?>">
                                        <?php
                                            echo substr("$ref", 0, 7) . "...";
                                        ?>
                                    </span>
                                </td>
                             
                        <td><?php echo $row['deposits']; ?></td>
                        <td><?php echo $row['withdrawals']; ?></td>
                        <td><?php echo $row['bankname']; ?></td>
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
