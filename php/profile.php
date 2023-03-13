<?php
require_once 'C:\xampp\htdocs\guvi\assets\mongodbcon\vendor\autoload.php';
// Creating Connection
$client = new \MongoDB\Client('mongodb+srv://pradeepdeeps033:Simple%40033@cluster0.thtfona.mongodb.net/test');
$db = $client->user_profiles;

// Creating Document 
$collection = $db->profiles;

// Inserting Record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];

    $insertOneResult = $collection->insertOne([
        'name' => $name,
        'dob' => $dob,
        'age' => $age,
        'email' => $email,
        'phone' => $phone,
        'bio' => $bio
    ]);

    if ($insertOneResult->getInsertedCount() > 0) {
        echo "Record inserted successfully!";
    } else {
        echo "Failed to insert record!";
    }
}
?>
