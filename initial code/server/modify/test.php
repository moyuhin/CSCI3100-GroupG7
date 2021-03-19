<?php

    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $aID = $response[0];
    $cName = $response[1];
    include '../component/dbOpen.php';

    $sql="UPDATE `admin` SET `name`='$cName' WHERE AdminId='$aID';";

    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($num != 1) {
        echo json_encode(array(
            'success' => 'false',
            'aID' => '',
            'cName' => ''
        ));
    }else{
        echo json_encode(array(
            'success' => 'true',
            'aID' => $aID,
            'cName' => $cName
        ));
    }
?>
