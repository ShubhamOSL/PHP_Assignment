<?php

   
    $servername = "localhost";
    $username = "root";
    $password = "S18@Shift";

    $conn = new mysqli($servername, $username, $password);

    function is_conn_alive() {
        return !isset($conn);
    }

?>