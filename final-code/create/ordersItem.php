<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $OrderId = $response[0];
    $QuantityArray = $response[1];
    $ItemNameArray = $response[2];
    $PriceArray = $response[3];
    include '../component/dbOpen.php';
    foreach ($QuantityArray as $key => $value) {
        $sql = "SELECT ItemId
                FROM Item
                WHERE Name = '{$ItemNameArray[$key]}';";
        $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($rs) <= 0) {
            echo json_encode(array(
            'success' => 'false',
            ));
        }
        else {
            $rc = mysqli_fetch_assoc($rs);
            extract($rc);
            $sql="INSERT INTO `OrdersItem`(`ItemId`, `OrderId`, `Quantity`) VALUES ('$ItemId','$OrderId','$value');";
            mysqli_query($conn, $sql) or die(mysqli_connect_error());
            $num = mysqli_affected_rows($conn);
            if ($num != 1) {
                echo json_encode(array(
                    'success' => 'false'
                ));
            }
            $sql="UPDATE `Item` SET `Quantity`= Quantity - $value WHERE ItemId='$ItemId';";
            mysqli_query($conn, $sql) or die(mysqli_connect_error());
            $num = mysqli_affected_rows($conn);
            if ($num != 1) {
                echo json_encode(array(
                    'success' => 'false'
                ));
            }
        }
    }
    mysqli_close($conn);
    echo json_encode(array(
        'success' => 'true'
    ));
?>
