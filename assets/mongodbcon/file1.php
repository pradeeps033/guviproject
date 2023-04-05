<?php
require 'vendor/autoload.php';
// Creating Connection
$serverApi = new \MongoDB\Driver\ServerApi(\MongoDB\Driver\ServerApi::V1);
$client = new \MongoDB\Client('mongodb://localhost', [], ['serverApi' => $serverApi]);
$db = $client->test;
// Creating Document 
$collection = $db->employee;
// Insering Record
$collection->insertOne([ 'name' => 'Peter','email' =>'peter@abc.com' ]);
// Fetching Record
$record = $collection->find(['name' => 'Peter'] ); foreach ($record as $employe) {
echo $employe['name'], ':',
$employe['email']."<br>";
}
?>
