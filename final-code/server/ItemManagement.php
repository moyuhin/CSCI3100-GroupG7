<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Item Management</title>
    <link rel="stylesheet" href="mystyle.css">
    <script>
        function checkNewItem() {
            var createQTY = document.getElementById("quantity").value;
            var itemName = document.getElementById("itemName").value;
            if (itemName == "") {
                document.getElementById("lblWarning").innerText = "Please input the Name!";
                return false;
            }
            if (createQTY != "") {
                if (createQTY <= 0) {
                    document.getElementById("lblWarning").innerText = "The order quantity should not be\n less than or equal to zero!!";
                    return false;
                } else {
                    return confirm('Are you sure to create this order?');
                }
            } else {
                document.getElementById("lblWarning").innerText = "Please input the quantity!";
                return false;
            }
        }

        function checkModifyItem() {
            var Price = document.getElementById("ModifyPrice").value;
            var Quantity = document.getElementById("ModifyQuantity").value;
            var Recommend = document.getElementById("ModifyRecommend").value;
            if (Price == "" || Price <= 0) {
                document.getElementById("lblWarning2").innerText = "Please check the price, it should not be null or smaller than 0!";
                return false;
            }
            if (Quantity == "" || Quantity < 0) {
                document.getElementById("lblWarning2").innerText = "Please check the quantity, it should not be null or smaller than 1!";
                return false;
            }
            if (Recommend == "" || (Recommend != 0 && Recommend != 1)) {
                document.getElementById("lblWarning2").innerText = "Please check the recommend, it should not be null or it should be 1/0!";
                return false;
            }
            return confirm('Are you sure to modify this Item?');
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


        <div class="selection">
            <h1>ItemManagement</h1>
            <div id="create" class="">
                <?php
                    if(isset($_POST['ModifyName'])){
                        extract($_POST);
                        include '../component/dbOpen.php';
                        $sql="UPDATE `Item` SET `Price`='$ModifyPrice',`Quantity` = '$ModifyQuantity' ,`Recommend` = '$ModifyRecommend' WHERE ItemId='$ModifyItemId';";
                        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        $num = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        if ($num != 1) {
                            echo "<h1>Cannot modify this Item !</h1>";
                        }else{
                            echo "<h1>Item is modified successfully !</h1>";
                        }
                    }
                ?>
                <?php
                    if(isset($_POST['itemName'])){
                        extract($_POST);
                        include '../component/dbOpen.php';
                        if($Recommend=="1"){
                            $sql="INSERT INTO `item`( `Name`, `Type`, `Recommend`, `Quantity`, `Price`) VALUES ('$itemName',$type,1,$quantity,$Price);";
                        }else{
                            $sql="INSERT INTO `item`( `Name`, `Type`, `Recommend`, `Quantity`, `Price`) VALUES ('$itemName',$type,0,$quantity,$Price);";
                        }
                        
                        mysqli_query($conn, $sql) or die(mysqli_connect_error());
                        $num = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        if ($num != 1) {
                            echo "<h1>Cannot add this Item !</h1>";
                        }else{
                            echo "<h1>Item is created successfully !</h1>";
                        }
                    }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return checkNewItem();" method="post" enctype="multipart/form-data">
                    <h2>Create a new Item</h2>
                    <p>
                        <label for="noQTY" id="lblWarning"></label>
                    </p>
                    <p>Item Name : <input type="text" name="itemName" id="itemName" value=""></p>
                    <p>Price : <input type="number" name="Price" id="Price" value="1"></p>
                    <p>Type:
                        <select name="type" id="type">
                            <option value="1">Meat</option>
                            <option value="2">Vegetable</option>
                            <option value="3">Fruit</option>
                            <option value="4">Snacks</option>
                            <option value="5">Alochol</option>
                        </select>
                    </p>

                    <p>Recommend:<input type="radio" id="RYes" name="Recommend" value="1" checked>
                        <label for="Yes">Yes</label>
                        <input type="radio" id="RNo" name="Recommend" value="0">
                        <label for="No">No</label>
                    </p>
                    <p>Item Quantity : <input type="number" name="quantity" id="quantity" value="10"></p>

                    <p><input type="submit" value="Create" name="submit_btn"><input type="button" value="Cancel" onclick="window.location.href='ItemManagement.php';" />
                    </p>
                </form>
            </div>
            <h2>Check/Modify Item information</h2>
            <div class="search">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="">Search By Item ID:</label>
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
                    $SQL = "SELECT ItemId, Name, Type, Recommend, Quantity, Price, Path FROM `Item`ORDER BY ItemId ASC;";
                }else if(isset($_POST['searchID'])){
                    $SQL = "SELECT ItemId, Name, Type, Recommend, Quantity, Price, Path FROM `Item` WHERE ItemId like '%{$_POST['searchID']}%' ORDER BY ItemId ASC;";
                }else{
                    $SQL = "SELECT ItemId, Name, Type, Recommend, Quantity, Price, Path FROM `Item` WHERE Name like '%{$_POST['searchName']}%' ORDER BY ItemId ASC;";
                }
                $rs = mysqli_query($conn, $SQL);
            ?>
            <table border="1">
                <tr>
                    <th>ItemId</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Recommend</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Path</th>
                    <th>Click to Modify</th>
                </tr>
                <?php
                    while ($rc = mysqli_fetch_assoc($rs)) {
                        $string= "ItemManagement.php?ItemId={$rc['ItemId']}";
                        echo "<tr>
                            <td align='left'><input type='text' value='{$rc['ItemId']}' name='ItemId' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Name']}' name='ItemName' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Type']}' name='Type' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Recommend']}' name='Recommend' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Quantity']}' name='Quantity' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Price']}' name='Price' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Path']}' name='Path' readonly></td>
                            
                            <td><a href='$string'>Choose</a></td>
                        </tr>";
                    }
                    mysqli_free_result($rs);
                    mysqli_close($conn);
                    ?>
            </table>
        </div>
        <?php
                if (isset($_GET['ItemId'])) {
                extract($_GET);
                if (isset($_SESSION["ItemId"])) {
                    unset ($_SESSION["ItemId"]);
                }
                include '../component/dbOpen.php'; 
                $SQL = "SELECT ItemId, Name, Type, Recommend, Quantity, Price, Path FROM `Item` WHERE ItemId ='$ItemId';";
                $rs = mysqli_query($conn, $SQL);
                $rc = mysqli_fetch_assoc($rs);
                extract($rc);
                mysqli_free_result($rs);
                mysqli_close($conn);
            ?>
        <div id="create" class="">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return checkModifyItem();" method="post" enctype="multipart/form-data">
                <h2>Modify Item</h2>
                <p>
                    <label for="noQTY" id="lblWarning2"></label>
                </p>
                <p>ItemId : <input class="readInput" type="number" name="ModifyItemId" id="ModifyItemId" value="<?php echo $ItemId ?>" readonly></p>
                <p>Name : <input class="readInput" type="text" name="ModifyName" id="ModifyName" value="<?php echo $Name ?>" readonly></p>
                <p>Type : <input type="text" class="readInput" name="ModifyType" id="ModifyType" value="<?php echo $Type ?>" readonly></p>
                <p>Recommend : <input type="number" name="ModifyRecommend" id="ModifyRecommend" value="<?php echo $Recommend ?>"></p>

                <p>Quantity : <input type="number" name="ModifyQuantity" id="ModifyQuantity" value="<?php echo $Quantity ?>"></p>

                <p>Price : <input type="number" name="ModifyPrice" id="ModifyPrice" value="<?php echo $Price ?>"></p>

                <p>Path : <input type="text" class="readInput" name="ModifyPath" id="ModifyPath" value="<?php echo $Path ?>" readonly></p>

                <p><input type="submit" value="Confirm" name="submit_btn2">
                    <input type="button" value="Cancel" onclick="window.location.href='ItemManagement.php';" />
                </p>
            </form>
        </div>
        <div id="showItem">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h2>Original Item Details</h2>
                <p>
                    <label for="noQTY" id="lblWarning3"></label>
                </p>
                <p>Price : <input class="readInput" type="number" name="ShowPrice" id="ShowPrice" value="<?php echo $Price ?>" readonly></p>
                <p>Quantity : <input class="readInput" type="text" name="ShowQuantity" id="ShowQuantity" value="<?php echo $Quantity ?>" readonly></p>
                <p>Recommend : <input class="readInput" type="text" name="ShowRecommend" id="ShowRecommend" value="<?php echo $Recommend ?>" readonly></p>

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
