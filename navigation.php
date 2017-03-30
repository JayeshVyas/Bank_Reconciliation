<!DOCTYPE html>
<html>
    <title>W3.CSS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        #navMenu{
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            z-index:51;
        }
    </style>
    <body>
        <div id="navMenu" class="w3-container">
            <div class="w3-bar w3-border w3-light-grey">
                <a href="index.php" id="n" class="w3-bar-item w3-button w3-border-right">Home</a>
                <a href="bank_statement.php" id="n" class="w3-bar-item w3-button w3-border-right">Import Bank Statement</a>
                <a href="internal_statement.php" id="n" class="w3-bar-item w3-button w3-border-right">Import Internal Statement</a>
                <a href="#" id="n" class="w3-bar-item w3-button w3-border-right">Reconciled Records</a>
                <a href="managereconcile.php" id="n" class="w3-bar-item w3-button w3-border-right">Unreconciled Records</a>
                <a href="" id="n" class="w3-bar-item w3-button w3-border-right" style="float: right">Logout</a>
            </div>
        </div>
    </body>
</html>