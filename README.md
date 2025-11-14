# mongodb-php-project

simple mongodb projects

## Requirements

Mongodb extension for php. Please refer to the link for installation guide.
`https://www.mongodb.com/docs/php-library/current/get-started/`

---

**Install library using composer**

```bash
composer require mongodb/mongodb
```

---

**Example usage**

`find` collection:

```php
require 'vendor/autoload.php';

use MongoD\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];

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
```

---

`insert` collection:

```php
require 'vendor/autoload.php';

use MongoDB\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];

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
```

---

`update` collection:

```php
require "vendor/autoload.php";

use MongoDB\BSON\ObjectID;
use MongoDB\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];

if ($uri === false || $uri === '') {
    throw new RuntimeException('Set the MONGODB_URI environment variable to your Atlas URI');
}
$client = new Client($uri);
$collection = $client->sample_mflix->movies;

$documentId = "6916bf6d07510000db0023e2"; //you can call directly if you use custom id format like string or int
$objectId = new ObjectID($documentId); // use only if you use default id format ObjectId

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
```

---

`replace` collection:

```php
require "vendor/autoload.php";

use MongoDB\BSON\ObjectID;
use MongoDB\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];

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
```

---

`delete` collection:

```php
require "vendor/autoload.php";

use MongoDB\BSON\ObjectID;
use MongoDB\Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];

if ($uri === false || $uri === '') {
    throw new RuntimeException('Set the MONGODB_URI environment variable to your Atlas URI');
}
$client = new Client($uri);
$collection = $client->sample_mflix->movies;
$id = new ObjectID("6916bf6d07510000db0023e2"); // use if _id is object id

$id = "6916bf6d07510000db0023e2"; // else if string
$id = 2; // or int

$collection->deleteOne(['_id' => $id]);
```

---

To learn more about mongodb `CRUD` operations visit this link:
`https://www.mongodb.com/docs/php-library/current/crud/`.
