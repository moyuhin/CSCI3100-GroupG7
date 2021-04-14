<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="mystyle.css">
    <script type="text/javascript" src="myscript.js"></script>
</head>
<!--focus to userID field when page onload-->

<body onload="document.getElementById('loginID').focus();">
    <?php
//destroy the session file whenever user comes to this page
session_start();
    if(isset($_SESSION['adminID'])) {
        session_destroy();
    }
        ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="container">
            <h1>Admin Login</h1>
            <p>
                <label for="uID">AdminID</label>
                <input type="text" placeholder="Enter AdminID" id="loginID" name="loginID" onfocusout="validateID();" required>
                <label for="confirmID" id="lblID"></label>
            </p>
            <p>
                <label for="pw">Password</label>
                <input type="password" id="pw" placeholder="Enter Password" name="pw" onfocusout="validatePW();" required>
                <label for="confirmPW" id="lblPW"></label>
            </p>

            <p><input type="submit" value="Login" />
                <input type="reset" value="Reset" onclick="clearLbl();" />
            </p>
        </div>
    </form>
    <?php
    if(isset($_POST['loginID'])) {
        $id = $_POST['loginID'];
        $pw=$_POST['pw'];
        include '../component/dbOpen.php'; 
        $sql = "SELECT adminid AS adminID,name FROM `admin` WHERE adminid='$id' and Password='$pw'";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($rs) <= 0) {
            echo "<p>Invalid user id or password!</p>";
            mysqli_free_result($rs);
            mysqli_close($conn);
        }
        else {
            $rc = mysqli_fetch_assoc($rs);
            extract($rc);
            session_start();
            $_SESSION['adminID'] = $adminID;
            $_SESSION['adminName'] = $name;
            mysqli_free_result($rs);
            mysqli_close($conn);
            header("Location: AdminMenu.php");
        }
    }
    ?>
</body>

</html>
