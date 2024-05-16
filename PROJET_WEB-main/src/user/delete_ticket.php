<?php
session_start();
// Connexion à la base de données
$db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4", "root", "");
// Vérification de la connexion
if ($db === false) {
    die("Erreur dans la connexion à la db !");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_facture'])) {
        // Récupère l'ID du ticket depuis les données POST
        $id_facture = $_POST['id_facture'];
        // Prépare la requête SQL pour supprimer le ticket
        $req = $db->prepare("DELETE FROM factures WHERE id_facture = :id_facture");
        $req->bindParam(':id_facture', $id_facture);

        if ($req->execute()) {
            echo "Le ticket a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du ticket.";
        }
    } else {
        echo "ID du ticket non fourni.";
    }
}
?>
