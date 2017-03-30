<html>
    
    <head>
        <title>Bank Reconciliation</title>
        <link rel="stylesheet" type="text/css" href="css/navigation.css">
        
        <script>
            function myFunction()
            {
                alert("Hello");
            }
        </script>
        <style>
            a:hover{
                color: white;
                text-decoration: none;
            }
        </style>
    </head>
    
    <body>
        
        <div>
            <ul>
                <li class="dropdown">
                    <span href="Home.php" class="dropbtn" onclick="myFunction();">Home</span>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Statements</a>
                    <div class="dropdown-content">
                        <a href="bank_statement.php">Import Bank Statement</a>
                        <a href="internal_statement.php">Import Internal Statement</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Reconciled Records</a>
                </li>
                <li class="dropdown">
                    <a href="managereconcile.php" class="dropbtn">Unreconciled Records</a>
                </li>
                <li class="dropdown" style="float:right">
                        <a href="javascript:void(0)" class="dropbtn">Logout</a>
                </li>
            </ul>
        </div>
        
        <div id="mainDiv">
        </div>
        
    </body>
</html>
