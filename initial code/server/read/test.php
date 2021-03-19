<?php

    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $aID = $response[0];
    $pw = $response[1];
    include '../component/dbOpen.php';

    $sql = "SELECT adminid AS userID,name FROM `admin` WHERE adminid='$aID' and Password='$pw'";
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_num_rows($rs) <= 0) {
        echo json_encode(array(
        'success' => 'false',
        'adminId' => '',
        'name' => ''
        ));
    }
    else {
        $rc = mysqli_fetch_assoc($rs);
        extract($rc);
        echo json_encode(array(
            'success' => 'true',
            'adminId' => $userID,
            'name' => $name
        ));
    }
            mysqli_free_result($rs);
        mysqli_close($conn);
?>
