<?php
function get_db_conn()
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "harry_potter_store";

    return mysqli_connect($hostname, $username, $password, $dbname);
}
?>
