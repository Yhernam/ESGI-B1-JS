<?php
session_start();
$db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_facture = $_POST["id_facture"];
    echo $id_facture;
    // Vérifier quel bouton a été cliqué
    if (isset($_POST["bouton"])) {
        $valeur_bouton = $_POST['bouton'];
        if($valeur_bouton == 'Valider'){
        $etat = "Validé";
        // Si le bouton "Valider" a été cliqué, mettre à jour l'état à 1 dans la table Factures
        $stmt = $db->prepare("UPDATE factures SET etat = :etat WHERE id_facture = :id");
        $stmt->execute(['etat' => $etat, 'id' => $id_facture]);
        echo $etat;
        header("Location: comptable.php");
    } elseif ($valeur_bouton == "Refuser"){
        $etat = "Refusé";
        // Si le bouton "Refuser" a été cliqué, mettre à jour l'état à 0 dans la table Factures
        $stmt = $db->prepare("UPDATE factures SET etat = :etat WHERE id_facture = :id");
        $stmt->execute(['etat' => $etat, 'id' => $id_facture]);
        echo $etat;
        header("Location: comptable.php");
        }
    }
}


?>
