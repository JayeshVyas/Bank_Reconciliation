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
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <script src="js/js1.js"></script>
        <script src="js/js2.js"></script>
        <script src="js/js3.js"></script>
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
            table, td, th
            {
                font-size: 12px;
            }
            td 
            {
                text-align: center;
                vertical-align: middle;
            }
        </style>
        
        <style>
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 52; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            /* The Close Button */
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
        
        <style>
            #btn1{
                position: fixed;
                top: 70px;
                z-index: 51;
                right: 200px;
            }
            a:link, a:visited, a:active, a:hover{
                color: #fff;
                text-decoration: none;
            }
            li a, .dropbtn {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
            li a:hover, .dropdown:hover .dropbtn {
                background-color: #1A5276;
            }
            #n{
                color: black;
            }
            #fixButton{
                position: fixed;
                z-index: 50;
                top: 40px;
                left: 0px;
                background-color: white;
                height: 80px;
                width: 100%;
            }
            #myBtn{
                margin-left: 200px;
            }
        </style>
    </head>
    
    <body>
        <?php include"navigation.php"; ?>
        <div id="fixButton">
        <button class="btn btn-primary" id="myBtn" style="margin-top: 30px;">Auto Reconcile</button>
        </div>
        <div id="myModal" class="modal">

          <!-- Modal content -->
            <div class="modal-content">
                <script language="JavaScript">
                    function toggle(source) {
                        checkboxes = document.getElementsByName('cashEntry[]');
                        for(var i=0, n=checkboxes.length;i<n;i++) {
                            checkboxes[i].checked = source.checked;
                        }
                    }
                </script>
                <input type="checkbox" onClick="toggle(this)" />Check/ Uncheck all<br/>
                <span class="close">&times;</span>
                <form action="reconcileCash.php" method="post">
                    <input type="checkbox" name="cashEntry[]" id="cashEntry" value="0" checked hidden>
                    <table align="center" border="1px" cellpadding="10px" class="table table-bordered">
                        <tr>
                            <th>Reconcile</th>
                            <th>Bank Particulars</th>
                            <th>Internal Particulars</th>
                            <th>Bank Reference</th>
                            <th>Internal Reference</th>
                            <th>Deposits</th>
                            <th>Withdrawals</th>
                            <th>Bank Name</th>
                        </tr>
                        
                        <?php
                        //load the database configuration file
                        include 'DBConfig.php';

                        $sql = "SELECT * from internalStatement where `status`='0';";
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
                                            $id = $row["id"];
                                            ?>
                        <tr>
                            <td><input type="checkbox" name="cashEntry[]" id="cashEntry" value="<?php echo $id;?>"></td>
                            <td><?php echo $row1["particulars"];?></td>
                            <td><?php echo $row["particulars"];?></td>
                            <td><?php echo $row1["reference"];?></td>
                            <td><?php echo $row["reference"];?></td>
                            <td><?php echo $row["deposits"];?></td>
                            <td><?php echo $row["withdrawals"];?></td>
                            <td><?php echo $row["bankname"];?></td>
                        </tr>
                        <?php
                                        }
                                    }
                                }
                            }    
                        }
                        else
                        {
                            echo "No records found...";
                        }
                        ?>
                        <tr>
                            <td colspan="8"><input class="btn btn-primary" type="submit" value="Reconcile"></td>
                        </tr>
                        </table>
                </form>
            </div>
        
        </div>

        <script>
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
        
        <form action="sample.php" method="post" id="manage">
            <div class="container-fluid" style="margin-top: 5%">
                <?php
                if(!empty($statusMsg))
                {
                    echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                }
                ?>
                
                
                <div class="row" style="margin-top: 3%;">
                    <div class="col-sm-6" style="background-color:#FCF3CF" style="padding-top: 10px;">
                        <h3 align="center">Bank Statement Records</h3><br />
                        <div class="table-responsive">
                            
                            <table  id="preTable" class="table table-striped">
                                
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
                                    //require("filedata.php");
                                    $sql = "SELECT * FROM bankstatement";
                                    $result  = mysqli_query($db,$sql);
                                    if($result->num_rows > 0)
                                    {
                                        while($row=mysqli_fetch_array($result))
                                        {
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
                                                echo substr("$ref", 0, 6) . "...";
                                                ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row['deposits']; ?></td>
                                        <td><?php echo $row['withdrawals']; ?></td>
                                        <td><?php echo $row['bankname']; ?></td>
                                        <td>
                                            <input type="radio" name="reconciled" value="<?php echo $row['id'] ?>"><br><label for="reconcile bank stmt"></label>
                                        </td>
                                    </tr>
                                    
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-6" style="background-color:lavenderblush;">
                        <h3 align="center">Internal Statement Records</h3><br />
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
                                    //require("filedata.php");
                                    $sql = "SELECT * FROM internalstatement";
                                    $result  = mysqli_query($db,$sql);
                                    if($result->num_rows > 0)
                                    {
                                        while($row=mysqli_fetch_array($result))
                                        {
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
                                    
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
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
            <input type="submit" id="btn1" class="btn btn-primary" form="manage" name="Submit" value="Reconcile Checked"style="float: right;">
        </form>
    </body>
</html>
