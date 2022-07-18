<?php

    $username = "GGATORART";
    $password = "SYSTEM";
    $host = "localhost:1521/xe";

    $conn = oci_connect($username,$password,$host);

    if(!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'],ENT_QUOTES),
        E_USER_ERROR);

    } 
?>