<?php

require 'vendor/autoload.php';

use MongoDB\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];
// echo $uri;
if ($uri === false || $uri === '') {
    throw new RuntimeException('Set the MONGODB_URI environment variable to your Atlas URI');
}
$client = new Client($uri);
$collection = $client->sample_mflix->movies;

$filter = ['title' => 'The Shawshank Redemption'];
// $result = $collection->findOne($filter);
$result = $collection->find();

if ($result) {
    foreach ($result as $row) {
        $rows[] = $row;
    }
    echo json_encode($rows, JSON_PRETTY_PRINT);
} else {
    echo 'Document not found';
}
