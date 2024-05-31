<?php

$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "forum_discussion";

// Créer une connexion
$log = new mysqli($servername, $username, $password, $dbname);

if ($log->connect_error){
    die("Connection failed" .$log->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $content=$_POST["message"];

    $stmt= $log->prepare("INSERT INTO messages(message) VALUE (?)" );
    $stmt->bind_param("s",$content);

    if ($stmt->execute()){
        exit();
    } else {
        echo'Message failed'.$stmt->error;
    }

    $log->close();

}