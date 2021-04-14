<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Meun</title>
    <link rel="stylesheet" href="mystyle.css">
    <script type="text/javascript" src="myscript.js"></script>
    <script>
        function changePassword() {
            var OPw = document.getElementById("opw").value;
            var Pw = document.getElementById("pw").value;
            var Pw2 = document.getElementById("pw2").value;
            if (OPw == "") {
                document.getElementById("lblWarning").innerText = "Please input the Old Password!";
                return false;
            }
            if (Pw != "" && Pw2 != "") {
                if (Pw.indexOf(' ') >= 0) {
                    document.getElementById("lblWarning").innerText = "Whitespace is not allowed for the password!!";
                    return false;
                }
                if (Pw != Pw2) {
                    document.getElementById("lblWarning").innerText = "The confirm password is different to the password";
                    return false;
                } else {
                    return confirm('Are you sure to create the password?');
                }
            } else {
                document.getElementById("lblWarning").innerText = "Please input the new password and the confirm new password!";
                return false;
            }
        }

    </script>
</head>

<body>
    <?php
session_start();
//when logout is checked, destroy session file
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: AdminMenu.php");
}
if(isset($_SESSION['adminID'])) {
    ?>
    <div id="flex-container">
        <div class="tab">
            <a href="AdminMenu.php" class="tablinks"><?php echo $_SESSION['adminName']?></a>
            <a href="OrderManagement.php" class="tablinks">OrderManagement</a>
            <a href="ItemManagement.php" class="tablinks">ItemManagement</a>
            <a href="AccountManagement.php" class="tablinks">AccountManagement</a>
            <a href="AdminMenu.php?logout=true" class="tablinks">Logout</a>
        </div>
    </div>

    <div class="selection">
        <h1>AdminMenu</h1>
        <h2>Welcome <?php echo $_SESSION['adminName']?>!!</h2>
        <br><br>
        <?php
                    if(isset($_POST['opw'])){
                        extract($_POST);
                        include '../component/dbOpen.php';
                        $sql="UPDATE `admin` SET `password`='$pw' WHERE adminId='{$_SESSION['adminID']}' and password='$opw';";
                        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        $num = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        if ($num != 1) {
                            echo "<h1>The Old password is wrong!</h1>";
                        }else{
                            echo "<h1>Password is modified successfully !</h1>";
                        }
                    }
                ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return changePassword();" method="post" enctype="multipart/form-data">
            <h2>Change Password</h2>
            <p>
                <label for="warning" id="lblWarning"></label>
            </p>
            <p>Old Password : <input type="password" name="opw" id="opw" value=""></p>
            <p>New Password : <input type="password" name="pw" id="pw" value=""></p>
            <p>Confirm New Password: <input type="password" name="pw2" id="pw2" value=""></p>
            <p><input type="submit" value="Confirm" name="submit_btn"><input type="button" value="Cancel" onclick="window.location.href='AdminMenu.php';" />
            </p>
        </form>
    </div>
    <?php
}else{
//    no session file, means have not logged in, back to login page
    header("Location: index.php");
}
?>
</body>

</html>
