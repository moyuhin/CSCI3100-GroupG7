<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $Id = $response[0];
    include '../../component/dbOpen.php';

    $sql = "SELECT o.OrderId AS OrderId,o.TotalPrice AS TotalPrice, oi.OrdersItemId AS OrdersItemId, o.NormalUserId AS NormalUserId, o.Approved AS Approved,o.PurchaseDate AS PurchaseDate, i.ItemId AS ItemId, i.Name AS ItemName, oi.Quantity AS OrderQuantity
    FROM Orders AS o
    INNER JOIN OrdersItem AS oi ON oi.OrderId = o.OrderId
    INNER JOIN Item AS i ON i.ItemId = oi.ItemId
    WHERE o.OrderId = $Id
    ORDER BY ItemId ASC;";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_num_rows($rs) <= 0) {
        echo json_encode(array(
        'success' => 'false',
        ));
    }
    else {
        $theArray = array();
        while($row = mysqli_fetch_assoc($rs)) {
            $theArray[] = $row;
        }
        echo json_encode($theArray);
    }
    mysqli_free_result($rs);
   mysqli_close($conn);
?>