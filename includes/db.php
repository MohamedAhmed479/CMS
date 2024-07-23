<?php


// $host = "localhost";
// $username = "root";
// $password = "";
// $DB_name = "cms";
// $port = "3307";

// $conn = mysqli_connect($host, $username, $password, $DB_name, $port);

// ================================================================

// But there is anothor way to make the connection with database

// ================================================================

$DB = [];
$DB['DB_HOST'] = "localhost";
$DB['DB_USERNAME'] = "root";
$DB['DB_PASSWORD'] = "";
$DB['DB_NAME'] = "cms";
$DB['DB_PORT'] = "3307";

foreach ($DB as $key => $value) {
    define($key, $value);
}

$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

