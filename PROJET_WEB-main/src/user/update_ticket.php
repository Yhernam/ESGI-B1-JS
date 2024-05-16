<?php
session_start();
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4", "root", "");
// Vérification de la connexion
if ($db === false) {
    die("Erreur dans la connexion à la db !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_facture']) && isset($_POST['type']) && isset($_POST['date']) && isset($_POST['somme'])){
        // Récupérez les données du formulaire
        $id_facture = $_POST['id_facture'];
        $nouveauType = $_POST['type'];
        $nouvelleDate = $_POST['date'];
        $nouveauPrix = $_POST['somme'];

        // Mettre à jour le ticket dans la base de données
        $req = $db->prepare("UPDATE factures SET type = :nouveauType, date = :nouvelleDate, somme = :nouveauPrix WHERE id_facture = :id_facture");
        $req->bindParam(':nouveauType', $nouveauType);
        $req->bindParam(':nouvelleDate', $nouvelleDate);
        $req->bindParam(':nouveauPrix', $nouveauPrix);
        $req->bindParam(':id_facture', $id_facture);
        if ($req->execute()) {
            echo "Ticket mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du ticket.";
        }
    }
}
?>
