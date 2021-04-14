<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Management</title>
    <link rel="stylesheet" href="mystyle.css">
    <script type="text/javascript" src="myscript.js"></script>
    <script type="text/javascript">
        function checkApprove() {
            return confirm("Are you sure to approve this order?");

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
            <h1>Check/Approve Order</h1>
            <?php
                if (isset($_GET['OrderId'])) {
                    extract($_GET);
                    if (isset($_SESSION["OrderId"])) {
                        unset ($_SESSION["OrderId"]);
                    }
                    include '../component/dbOpen.php'; 
                    $sql="UPDATE `Orders` SET `Approved`=1 WHERE OrderId='$OrderId';";
                    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    $num = mysqli_affected_rows($conn);
                    mysqli_close($conn);
                    if ($num != 1) {
                        echo "<h1>Cannot Approve this Order !</h1>";
                    }else{
                        echo "<h1>Order is approved successfully !</h1>";
                    }
                }
            ?>
            <div class="search">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="">Search By Order ID:</label>
                    <input type="number" name="searchOID">
                    <input type="submit" value="Search">
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <label for="">Search By OrderItem ID:</label>
                    <input type="text" name="searchOIID">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
        <?php
                include '../component/dbOpen.php'; 
                if(!isset($_POST['searchOID'])&&!isset($_POST['searchOIID'])) {
                    $SQL = "SELECT o.OrderId AS OrderId, o.TotalPrice AS TotalPrice, oi.OrdersItemId AS OrdersItemId, o.NormalUserId AS NormalUserId, o.Approved AS Approved,o.PurchaseDate AS PurchaseDate, i.ItemId AS ItemId, i.Name AS ItemName, oi.Quantity AS OrderQuantity
    FROM Orders AS o
    INNER JOIN OrdersItem AS oi ON oi.OrderId = o.OrderId
    INNER JOIN Item AS i ON i.ItemId = oi.ItemId
    ORDER BY OrderId ASC;";
                }else if(isset($_POST['searchOID'])){
                    $SQL = "SELECT o.OrderId AS OrderId,o.TotalPrice AS TotalPrice, oi.OrdersItemId AS OrdersItemId, o.NormalUserId AS NormalUserId, o.Approved AS Approved,o.PurchaseDate AS PurchaseDate, i.ItemId AS ItemId, i.Name AS ItemName, oi.Quantity AS OrderQuantity
    FROM Orders AS o
    INNER JOIN OrdersItem AS oi ON oi.OrderId = o.OrderId
    INNER JOIN Item AS i ON i.ItemId = oi.ItemId
    WHERE o.OrderId like '%{$_POST['searchOID']}%'
    ORDER BY OrderId ASC;";
                }else{
                    $SQL = "SELECT o.OrderId AS OrderId, o.TotalPrice AS TotalPrice,oi.OrdersItemId AS OrdersItemId, o.NormalUserId AS NormalUserId, o.Approved AS Approved,o.PurchaseDate AS PurchaseDate, i.ItemId AS ItemId, i.Name AS ItemName, oi.Quantity AS OrderQuantity
    FROM Orders AS o
    INNER JOIN OrdersItem AS oi ON oi.OrderId = o.OrderId
    INNER JOIN Item AS i ON i.ItemId = oi.ItemId
    WHERE OrdersItemId like '%{$_POST['searchOIID']}%'
    ORDER BY OrderId ASC;";
                }
                $rs = mysqli_query($conn, $SQL);
            ?>
        <table border="1">
            <tr>
                <th>OrderId</th>
                <th>OrdersItemId</th>
                <th>NormalUserId</th>
                <th>PurchaseDate</th>
                <th>ItemId</th>
                <th>ItemName</th>
                <th>OrderQuantity</th>
                <th>TotalPrice</th>
                <th>Approved</th>
                <th>Approve order</th>
            </tr>
            <?php
                    while ($rc = mysqli_fetch_assoc($rs)) {
                        $string= "OrderManagement.php?OrderId={$rc['OrderId']}";
                        echo "<tr>
                            <td align='left'><input type='text' value='{$rc['OrderId']}' name='OrderId' readonly></td>
                            <td align='left'><input type='text' value='{$rc['OrdersItemId']}' name='OrdersItemId' readonly></td>
                            <td align='left'><input type='text' value='{$rc['NormalUserId']}' name='NormalUserId' readonly></td>
                            <td align='left'><input type='text' value='{$rc['PurchaseDate']}' name='PurchaseDate' readonly></td>
                            <td align='left'><input type='text' value='{$rc['ItemId']}' name='ItemId' readonly></td>
                            <td align='left'><input type='text' value='{$rc['ItemName']}' name='ItemName' readonly></td>
                            <td align='left'><input type='text' value='{$rc['OrderQuantity']}' name='OrderQuantity' readonly></td>
                            <td align='left'><input type='text' value='{$rc['TotalPrice']}' name='TotalPrice' readonly></td>
                            <td align='left'><input type='text' value='{$rc['Approved']}' name='Approved' readonly></td>
                            ";
                        if($rc['Approved']=="1"){
                            echo "<td></td>
                        </tr>";
                        }else{
                            echo "<td><a href='$string' onclick='return checkApprove();'>Approve</a></td>";
                        }
                        
                    }
                    mysqli_free_result($rs);
                    mysqli_close($conn);
                    ?>
        </table>
    </div>


    <?php
}else{
//    no session file, means have not logged in, back to login page
    header("Location: index.php");
}
?>
</body>

</html>
