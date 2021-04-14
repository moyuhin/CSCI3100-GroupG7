<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $NormalUserId = $response[0];
    $Price = $response[1];
    $date = date('Y-m-d');
    include '../component/dbOpen.php';

    $sql="INSERT INTO `Orders`(`NormalUserId`, `TotalPrice`, `PurchaseDate`) VALUES ('$NormalUserId','$Price','$date');";
    mysqli_query($conn, $sql) or die(mysqli_connect_error());
    $last_id = $conn->insert_id;
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($num != 1) {
        echo json_encode(array(
            'success' => 'false'
        ));
    }else{
        echo json_encode(array(
            'success' => 'true',
            'OrderId' => $last_id,
        ));
    }
?>
