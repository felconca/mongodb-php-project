<?php
require "vendor/autoload.php";

use MongoDB\BSON\ObjectID;
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
$id = new ObjectID("6916bef3e21b000038001ea3"); // use only if you use default id format ObjectId
$data = [
    "name" => "movie name",
    "published" => "2024"
];
$result = $collection->replaceOne(['_id' => $id], $data);
echo 'Modified documents: ', $result->getModifiedCount();
