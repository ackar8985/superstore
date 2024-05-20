<?php
    $username = "root";
    $password = "Ackar8985";
    $servername = "127.0.0.1:3307";
    $dbname = "C354_f3dnguyen";

    function connect() {
        global $servername, $username, $password, $dbname, $conn;
        $conn = new mysqli($servername, $username, $password, $dbname);

        if (mysqli_connect_errno()) {
            die("". mysqli_connect_error());
        }
    }

    function closeConnection() {
        global $conn;
        mysqli_close($conn);
        exit();
    }

    
?>