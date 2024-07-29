<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    require_once 'dbconnect.php'; # Connects to the db

    $username = $_POST['username']; #Grabs username from form
    $firstName = $_POST['firstName']; #Grabs first name from form
    $locations = $_POST['locations']; #Grabs location from form

    $query = 'INSERT INTO users (username, firstName, locations) VALUES ($1, $2, $3)';


    $p = array($username, $firstName, $locations);
    
    $queryinsert = pg_query_params($conn, $query, $p);

    echo "  User added successfully.  Please go back to the previous page to keep playing the game!";

        

} 