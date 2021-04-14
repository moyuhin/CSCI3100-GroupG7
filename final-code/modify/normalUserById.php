<?php
    $str_json = file_get_contents('php://input'); 
    $response = json_decode($str_json, true);
    $id = $response[0];
    $pw = $response[1];
    $opw = $response[2];
    include '../component/dbOpen.php';

    $sql="UPDATE `normalUser` SET `Password`='$pw' WHERE NormalUserId='$id' and Password='$opw';";

    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($num != 1) {
        echo json_encode(array(
            'success' => 'false'
        ));
    }else{
        echo json_encode(array(
            'success' => 'true'
        ));
    }
?>