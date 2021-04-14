<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Management</title>
    <link rel="stylesheet" href="mystyle.css">
    <script>
        function checkNewAccount() {
            var Pw = document.getElementById("pw").value;
            var Pw2 = document.getElementById("pw2").value;
            var acName = document.getElementById("acName").value;
            var email = document.getElementById("email").value;
            if (acName == "") {
                document.getElementById("lblWarning").innerText = "Please input the Name!";
                return false;
            }
            if (email == "") {
                document.getElementById("lblWarning").innerText = "Please input the email!";
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
                    return confirm('Are you sure to create this account?');
                }
            } else {
                document.getElementById("lblWarning").innerText = "Please input the password and the confirm password!";
                return false;
            }
        }

        function checkModifyAccount() {
            var Pw = document.getElementById("ModifyPassword").value;
            var acName = document.getElementById("ModifyName").value;
            var email = document.getElementById("ModifyEmail").value;
            if (acName == "") {
                document.getElementById("lblWarning2").innerText = "Please input the Name!";
                return false;
            }
            if (email == "") {
                document.getElementById("lblWarning2").innerText = "Please input the email!";
                return false;
            }
            if (Pw != "") {
                if (Pw.indexOf(' ') >= 0) {
                    document.getElementById("lblWarning2").innerText = "Whitespace is not allowed for the password!!";
                    return false;
                } else {
                    return confirm('Are you sure to modify this account?');
                }
            } else {
                document.getElementById("lblWarning2").innerText = "Please input the password!";
                return false;
            }
        }

        function deleteAccount() {
            var ID = document.getElementById("DeleteNormalUserId").value;
            return confirm('Are you sure to delete this account?');
        }

    </script>
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


        <div class="selection">
            <h1>AccountManagement</h1>
            <div id="create" class="">
                <?php
                    if(isset($_POST['DeleteNormalUserId'])){
                        extract($_POST);
                        include '../component/dbOpen.php';
                        $sql="DELETE FROM `normaluser` WHERE `normaluserId`='$DeleteNormalUserId';";
                        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        $num = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        if ($num != 1) {
                            echo "<h1>Cannot Delete this Account !</h1>";
                        }else{
                            echo "<h1>Account is deleted successfully !</h1>";
                        }
                    }
                ?>
                <?php
                    if(isset($_POST['ModifyName'])){
                        extract($_POST);
                        include '../component/dbOpen.php';
                        $sql="UPDATE `NormalUser` SET `name`='$ModifyName',`Password` = '$ModifyPassword', `Email`='$ModifyEmail' WHERE NormalUserId='$ModifyNormalUserId';";
                        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        $num = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        if ($num != 1) {
                            echo "<h1>Cannot modify this Account !</h1>";
                        }else{
                            echo "<h1>Account is modified successfully !</h1>";
                        }
                    }
                ?>
                <?php
                    if(isset($_POST['acName'])){
                        extract($_POST);
                        include '../component/dbOpen.php';
                        if($acType=="admin"){
                            $sql="INSERT INTO `Admin`(`Name`, `Password`,`Email`) VALUES ('$acName','$pw', '$email');";
                        }else{
                            $sql="INSERT INTO `NormalUser`(`Name`, `Password`,`Email`) VALUES ('$acName','$pw', '$email');";
                        }
                        
                        mysqli_query($conn, $sql) or die(mysqli_connect_error());
                        $num = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        if ($num != 1) {
                            echo "<h1>Cannot add this Account !</h1>";
                        }else{
                            echo "<h1>Account is created successfully !</h1>";
                        }
                    }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return checkNewAccount();" method="post" enctype="multipart/form-data">
                    <h2>Create a new Account</h2>
                    <p>
                        <label for="warning" id="lblWarning"></label>
                    </p>
                    <p>Account Type:<input type="radio" id="adminType" name="acType" value="admin" checked>
                        <label for="admin">Admin</label>
                        <input type="radio" id="NormalUserType" name="acType" value="user">
                        <label for="NormalUser">Normal User</label>
                    </p>
                    <p>Account Name : <input type="text" name="acName" id="acName" value=""></p>
                    <p>Email : <input type="email" name="email" id="email" value=""></p>
                    <p>Account Password : <input type="password" name="pw" id="pw" value=""></p>
                    <p>Confirm Password: <input type="password" name="pw2" id="pw2" value=""></p>
                    <p><input type="submit" value="Create" name="submit_btn"><input type="button" value="Cancel" onclick="window.location.href='AccountManagement.php';" />
                    </p>
                </form>
            </div>
            <h2>Check/Modify Normal User Account information</h2>
            <div class="search">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="">Search By Account ID:</label>
                    <input type="number" name="searchID">
                    <input type="submit" value="Search">
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="">Search By Name:</label>
                    <input type="text" name="searchName">
                    <input type="submit" value="Search">
                </form>
            </div>

            <?php
                include '../component/dbOpen.php'; 
                if(!isset($_POST['searchID'])&&!isset($_POST['searchName'])) {
                    $SQL = "SELECT NormalUserId, Name, Password, Email FROM `NormalUser` ORDER BY NormalUserId ASC;";
                }else if(isset($_POST['searchID'])){
                    $SQL = "SELECT NormalUserId, Name, Password, Email FROM `NormalUser` WHERE NormalUserId like '%{$_POST['searchID']}%' ORDER BY NormalUserId ASC;";
                }else{
                    $SQL = "SELECT NormalUserId, Name, Password, Email FROM `NormalUser` WHERE Name like '%{$_POST['searchName']}%' ORDER BY NormalUserId ASC;";
                }
                $rs = mysqli_query($conn, $SQL);
            ?>
            <table border="1">
                <tr>
                    <th>NormalUserId</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Click to Modify</th>
                </tr>
                <?php
                    while ($rc = mysqli_fetch_assoc($rs)) {
                        $string= "AccountManagement.php?NormalUserId={$rc['NormalUserId']}";
                        echo "<tr>
                            <td align='left'><input type='text' value='{$rc['NormalUserId']}' name='NormalUserId' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Name']}' name='AdminName' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Password']}' name='APW' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Email']}' name='APW' readonly></td>
                            <td><a href='$string'>Choose</a></td>
                        </tr>";
                    }
                    mysqli_free_result($rs);
                    mysqli_close($conn);
                    ?>
            </table>
        </div>

        <?php
                if (isset($_GET['NormalUserId'])) {
                extract($_GET);
                if (isset($_SESSION["NormalUserId"])) {
                    unset ($_SESSION["NormalUserId"]);
                }
                include '../component/dbOpen.php'; 
                $SQL = "SELECT NormalUserId, Name, Password, Email FROM `NormalUser` WHERE NormalUserId ='$NormalUserId';";
                $rs = mysqli_query($conn, $SQL);
                $rc = mysqli_fetch_assoc($rs);
                extract($rc);
                mysqli_free_result($rs);
                mysqli_close($conn);
            ?>

        <div id="create" class="">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return checkModifyAccount();" method="post" enctype="multipart/form-data">
                <h2>Modify Account</h2>
                <p>
                    <label for="noQTY" id="lblWarning2"></label>
                </p>
                <p>NormalUserId : <input class="readInput" type="number" name="ModifyNormalUserId" id="ModifyNormalUserId" value="<?php echo $NormalUserId ?>" readonly></p>
                <p>Name : <input type="text" name="ModifyName" id="ModifyName" value="<?php echo $Name ?>"></p>
                <p>Password : <input type="text" name="ModifyPassword" id="ModifyPassword" value="<?php echo $Password ?>"></p>
                <p>Email : <input type="email" name="ModifyEmail" id="ModifyEmail" value="<?php echo $Email ?>"></p>
                <p><input type="submit" value="Confirm" name="submit_btn2">
                    <input type="button" value="Cancel" onclick="window.location.href='AccountManagement.php';" />
                </p>
            </form>
        </div>
        <div id="deleteAccount">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return deleteAccount();" method="post" enctype="multipart/form-data">
                <h2>Original Details</h2>
                <p>
                    <label for="noQTY" id="lblWarning3"></label>
                </p>
                <p>NormalUserId : <input class="readInput" type="number" name="DeleteNormalUserId" id="DeleteNormalUserId" value="<?php echo $NormalUserId ?>" readonly></p>
                <p>Name : <input class="readInput" type="text" name="DeleteName" id="DeleteName" value="<?php echo $Name ?>" readonly></p>
                <p>Password : <input class="readInput" type="text" name="DeletePassword" id="DeletePassword" value="<?php echo $Password ?>" readonly></p>
                <p>Email : <input class="readInput" type="text" name="DeleteEmail" id="DeleteEmail" value="<?php echo $Email ?>" readonly></p>
            </form>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
}else{
//    no session file, means have not logged in, back to login page
    header("Location: index.php");
}
?>
</body>

</html>
