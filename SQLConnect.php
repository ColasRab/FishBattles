<?php

$dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "fish_battle";

    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()){
        echo "Connection Made";
        mysqli_connect_error();
        exit();
    }

?>