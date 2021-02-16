<?php
require_once "../includes/db.php";
require_once '../vendor/autoload.php';

$faker = Faker\Factory::create();
echo "Fake data is added to the database";

for ($i = 0; $i < 20; $i++) {
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES(
        '$faker->firstName',
        '$faker->lastName',
        'admin',
        '$faker->userName',
        '$faker->safeEmail',
        '$faker->password'
    )";
    
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Faker werkt noiceee...";
        
    } else {
        echo "Dit kan toch niet!";
    }
}



// generate data by accessing properties
echo $faker->name;
?>