<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "formcontact"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_prenoms = $_POST['nom_prenoms'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $domaine_activite = $_POST['domaine_activite'];

    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom_prenoms, email, contact, domaine_activite) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom_prenoms, $email, $contact, $domaine_activite);


    if ($stmt->execute()) {
        echo "Données enregistrées avec succès.";
 
        header("Location: index.html");
        exit(); 
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
