<?php
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "forum_discussion";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    
    // Préparer et lier
    $stmt = $conn->prepare("INSERT INTO utilisateurs (username, pass) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $pass);
    
    // Sécurisation de la mot de passe
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO utilisateurs (username, pass) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);


    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers une nouvelle page après le succès
        header("Location: message.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
}

$conn->close();
?>

