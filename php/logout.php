<?php
    $dataReceived = file_get_contents('php://input'); // logOut
    if ($dataReceived == 'logOut'){
        session_start();
        session_unset();
        session_destroy();
        echo 'userLoggedOut';
    } else {
        echo 'logOutFailed';
    }
?>