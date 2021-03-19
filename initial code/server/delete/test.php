<?php

    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $aID = $response[0];
    $pw = $response[1];
    include '../component/dbOpen.php';

    $sql="DELETE FROM `admin` WHERE `AdminId`='$aID' and `PassWord`='$pw';";
    mysqli_query($conn, $sql) or die(mysqli_connect_error());
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($num != 1) {
        echo json_encode(array(
            'success' => 'false',
            'aID' => '',
            'pw' => ''
        ));
    }else{
        echo json_encode(array(
            'success' => 'true',
            'aID' => $aID,
            'pw' => $pw
        ));
    }
?>
