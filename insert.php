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

// insert one document
$insertOneResult = $collection->insertOne(['title' => 'My Movie', 'year' => 2025]);

// insert many documents
$insertManyResult = $collection->insertMany([
    ['title' => 'Second Movie', 'year' => 2024],
    ['title' => 'Third Movie', 'year' => 2023],
]);

// insert another document and keep the result
$result = $collection->insertOne(['title' => 'Final Movie', 'year' => 2022]);
