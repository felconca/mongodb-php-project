<?php

require 'vendor/autoload.php';


$uri = "mongodb://localhost:27017/lcl-srv";
// echo $uri;
if ($uri === false || $uri === '') {
    throw new RuntimeException('Set the MONGODB_URI environment variable to your Atlas URI');
}
$client = new MongoDB\Client($uri);
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
