<?php
    $user = 'root';
    $pass = '';
    $db = 'scandiweb';
    $db = new mysqli('127.0.0.1:3308', $user, $pass, $db) or die("Error, database not connected");
?>