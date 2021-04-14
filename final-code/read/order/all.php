<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $Id = $response[0];
    include '../../component/dbOpen.php';

    $sql = "SELECT * FROM `orders` where NormalUserId=$Id";
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
