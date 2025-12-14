<?php

function connectaBD() {

    $host = "127.0.0.1";
    $port = "5432";
    $database = "tdiw-i7";
    $user = "tdiw-i7";
    $password = "Ynnhboqs";

    $connexio = pg_connect("host = $host port = $port dbname=$database user=$user password=$password");
    return $connexio;
}

?>