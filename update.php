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

$documentId = "6916bf6d07510000db0023e2";
$objectId = new ObjectID($documentId);

$data = [
    '$set' => [
        'name' => 'felcon albaladejo',
        'email' => 'felcon.albaladejo@gmail.com',
    ]
];
$update = $collection->updateOne(['_id' => $objectId], $data, ["upsert" => true]);
if ($update->getUpsertedId()) {
    printf("Upserted a new document with _id: %s\n", $update->getUpsertedId());
} else {
    printf("Update document _id: %s\n", $objectId);
}
