
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
    $nom = $_POST['Nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $adresse = $_POST['adresse'];
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass_confirm'];

    if ($pass === $pass_confirm) {
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Préparer et lier
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, username, adresse, pass) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nom, $prenom, $username, $adresse, $hashed_password);

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
    } else {
        echo "Passwords do not match";
    }
}

$conn->close();
?>
