<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $text = $_POST['text'];

    // Traiter les données ici (par exemple, les enregistrer dans une base de données)
    // Exemple d'enregistrement dans un fichier texte
    $file = fopen("donnees_contact.txt", "a");
    fwrite($file, "Email: $email\n");
    fwrite($file, "Nom: $nom\n");
    fwrite($file, "Prénom: $prenom\n");
    fwrite($file, "Téléphone: $phone\n");
    fwrite($file, "Lieu: $country\n");
    fwrite($file, "Texte: $text\n\n");
    fclose($file);

    // Redirection vers une page de confirmation ou autre
    header("Location: confirmation.html");
    exit();
}
?>
