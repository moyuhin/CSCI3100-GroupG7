<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Main Menu</title>
    <link rel="stylesheet" href="mystyle.css">
    <script type="text/javascript" src="myscript.js"></script>
</head>
<body>
<!-- Tab links -->
<?php
session_start();
//when logout is checked, destroy session file
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: AdminMenu.php");
}
//if login as restaurant
if(isset($_SESSION['userID'])) {
    ?>
    <div id="flex-container">
        <div class="tab">
            <a href="OrderManagement.php" class="tablinks">OrderManagement</a>
            <a href="CreateNewItem.php" class="tablinks">CreateNewItem</a>
            <a href="AccountManagement.php" class="tablinks">AccountManagement</a>
            <a href="AdminMenu.php?logout=true" class="tablinks">Logout</a>
        </div>
    </div>
            
    <div class="selection">
       <h1>AdminMenu</h1>
        <h2>Welcome <?php echo $_SESSION['adminName']?>!!</h2>
    </div>
    <?php
}else{
//    no session file, means have not logged in, back to login page
    header("Location: index.php");
}
?>
</body>
</html>