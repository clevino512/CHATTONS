<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>message</title>
   <link rel="stylesheet" href="contenu.css">
</head>
<body>
    <div class="corps">
        <div class="utilisateur">
            <h1> Fils des discussions</h1>
            <div class="contacts">
                <a href="#">Contacts 1</a>
                <a href="#">Contacts 1</a>
                <a href="#">Contacts 1</a>
                <a href="#">Contacts 1</a>
                <a href="#">Contacts 1</a>
                <a href="#">Contacts 1</a>
                <!-- <a href="#">Contacts 1</a> -->
            </div>
        </div>
        <div class="contenu">
            <h1>Contacts 1</h1>
            <div class="message">
                <form action="envoyer_message.php" method="post">
                    <input type="hidden" name="sender" value="Contacts 1" >
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
                        ?>
                     <input type="hidden" name="receiver" value="Expéditeur">
                    <input type="text" name="message" placeholder="Tapez votre texte ici" class="text" required>
                    <input type="submit" value="Envoyer" class="Envoyer">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
