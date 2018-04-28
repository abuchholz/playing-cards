<?php

require __DIR__.'/../../../bootstrap/autoload.php';

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Ifsnop\Mysqldump as IMysqldump;
use Dotenv\Dotenv;

$dump_location = 'tests/_data/dump.sql';

$dotenv = new Dotenv(__DIR__ . '/../../..', '.env');
$dotenv->overload();

$dotenv = new Dotenv(__DIR__ . '/../../..', '.env.testing');
$dotenv->overload();

$host = getenv('DB_HOST');
$database = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

$process = new Process('mkdir -p tests/_data');
$process->run();
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

$process = new Process('php artisan migrate:refresh --seed --force');
$process->run();
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}
echo "$database: Seeded testing database\n";

try {
    $dump = new IMysqldump\Mysqldump("mysql:host=$host;dbname=$database", $user, $password);
    $dump->start($dump_location);
    echo "$database: Testing database dump created successfully to $dump_location \n";
} catch (\Exception $e) {
    echo 'mysqldump-php error: ' . $e->getMessage() . "\n";
}

