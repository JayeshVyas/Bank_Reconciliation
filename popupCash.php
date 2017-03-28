<!DOCTYPE html>
<html>
    <head>
        <style>
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
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
    </head>
    
    <body>

        <h2>Modal Example</h2>

        <!-- Trigger/Open The Modal -->
        <button id="myBtn">Open Modal</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                    <form action="reconcileCash.php" method="post">
                    <table align="center" border="1px" cellpadding="10px">
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

                        $sql = "SELECT * from internalStatement;";
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
                        ?>
                        <tr>
                            <td colspan="7"><input type="submit"></td>
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

    </body>
</html>
