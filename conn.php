<?php

function connect()
{
    $conn = new mysqli("localhost", "root", "", "transport");
    if (!$conn) die("Error Connecting to DB!");
    return $conn;
}
$conn = connect();
if (!$conn) die("Under Construction!");

