<?php 
try{
    $conn = pg_connect("host=localhost port=5433 dbname=YatzyGameUsers user=postgres password=password");

    echo "Connected to the database!";
}catch(PDOException $e){
    echo "Connection failed!";
}

?>