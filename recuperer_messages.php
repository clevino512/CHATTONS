<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "forum_discussion";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Requête pour récupérer les messages de la base de données
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

// Affichage des messages dans une structure HTML
if ($result->num_rows > 0) {
  // Boucle à travers les résultats
  while($row = $result->fetch_assoc()) {
    // Affichage des messages avec des classes différentes pour l'expéditeur et le destinataire
    echo '<div class="message ';
    if ($row['sender'] === 'Contacts 1') {
      echo 'expediteur">';
    } else {
      echo 'destinataire">';
    }
    echo '<p>' . $row['message'] . '</p>';
    echo '</div>';
  }
} else {
  echo "Aucun message trouvé";
}

// Fermeture de la connexion
$conn->close();
?>
