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
$id = new ObjectID("6916bf6d07510000db0023e2"); // use if _id is object id 

$id = "6916bf6d07510000db0023e2"; // else if string
$id = 2; // or int

$collection->deleteOne(['_id' => $id]);
