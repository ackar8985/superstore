<?php
    $username = "f3dnguyen";
    $password = "f3dnguyen136";
    $servername = "localhost";
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