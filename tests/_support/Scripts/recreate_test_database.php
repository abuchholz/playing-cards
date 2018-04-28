<?php

require __DIR__.'/../../../bootstrap/autoload.php';

use Ifsnop\Mysqldump as IMysqldump;
use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__ . '/../../..', '.env');
$dotenv->overload();

$dotenv = new Dotenv(__DIR__ . '/../../..', '.env.testing');
$dotenv->overload();

$host = getenv('DB_HOST');
$database = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$rootpassword = getenv('DB_ROOT_PASSWORD');

// Create connection
if (function_exists('mysqli_connect')) {

    $conn = new mysqli($host, 'root', $rootpassword);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . ". Check your .env or .env.testing DB configuration variables.\n");
    }

    // Create database
    $sql = "DROP DATABASE IF EXISTS $database";
    if ($conn->query($sql) === true) {
        echo "$database: Testing database dropped successfully \n";
    } else {
        echo "Warning: " . $conn->error . "\n";
    }

    // Create database
    $sql = "CREATE DATABASE $database";
    if ($conn->query($sql) === true) {
        echo "$database: Testing database created successfully \n";
    } else {
        echo "Warning: " . $conn->error . "\n";
    }
    // Create database
    $sql = "GRANT ALL PRIVILEGES ON $database.* TO '$user'@'%' WITH GRANT OPTION";
    if ($conn->query($sql) === true) {
        echo "$database: Granted privileges to $user successfully \n";
    } else {
        echo "Warning: " . $conn->error . "\n";
    }
} else {
    echo 'Warning: mysqli not available';
}
