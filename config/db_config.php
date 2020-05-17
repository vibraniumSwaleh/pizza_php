<?php
//connect to db
$config_connection = mysqli_connect(
    'localhost',
    'swaleh',
    'test123',
    'ninja');

//check connection
if (!$config_connection) {
    echo 'connection error: ' . mysqli_connect_error();
}
?>
