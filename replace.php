<?php
require "vendor/autoload.php";

use MongoDB\BSON\ObjectID;
use MongoDB\Client;


$uri = "mongodb://localhost:27017/lcl-srv";
// echo $uri;
if ($uri === false || $uri === '') {
    throw new RuntimeException('Set the MONGODB_URI environment variable to your Atlas URI');
}
$client = new Client($uri);
$collection = $client->sample_mflix->movies;
$id = new ObjectID("6916bef3e21b000038001ea3"); // use if _id is object id 
$data = [
    "name" => "movie name",
    "published" => "2024"
];
$result = $collection->replaceOne(['_id' => $id], $data);
echo 'Modified documents: ', $result->getModifiedCount();
