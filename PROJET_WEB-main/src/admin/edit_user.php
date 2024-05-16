<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <script src="admin_js.js"></script>
</head>


    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4", "root", "");
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE id_user = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            ?>
            <!-- Formulaire pour modifier l'utilisateur -->
            <form class="cadre1" id="modificationForm" action="edit_user.php?id=<?php echo $id; ?>" method="post">
            <h1 class="title">Modifier Utilisateur</h1>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $user['nom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo $user['prenom']; ?>">
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail :</label>
                    <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $user['mail']; ?>">
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" value="<?php echo $user['mot_de_passe']; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle :</label>
                    <select id="role" name="role" class="form-control texte">
                        <option value="1" <?php if ($user['role'] == 1) echo 'selected'; ?>>Admin</option>
                        <option value="2" <?php if ($user['role'] == 2) echo 'selected'; ?>>Comptable</option>
                        <option value="3" <?php if ($user['role'] == 3) echo 'selected'; ?>>Commerciale</option>
                    </select>
                </div>
                <button type="submit" class="bouton" onclick="afficherModificationReussieModal()">Modifier</button>
                <button type="button" class="bouton"><a style="text-decoration:none; color:black" href="admin.php">Retour</a></button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $mail = $_POST['mail'];
                $mot_de_passe = $_POST['mot_de_passe'];
                $role = $_POST['role'];

                $stmt = $db->prepare("UPDATE utilisateur SET prenom = :prenom, nom = :nom, mail = :mail, mot_de_passe = :mot_de_passe, role = :role WHERE id_user = :id");
                $stmt->bindParam(":nom", $nom);
                $stmt->bindParam(":prenom", $prenom);
                $stmt->bindParam(":mail", $mail);
                $stmt->bindParam(":mot_de_passe", $mot_de_passe);
                $stmt->bindParam(":role", $role);
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    // Modification réussie, afficher le pop-up
                    echo "<script>afficherModificationReussieModal();</script>";
                } else {
                    echo "Une erreur s'est produite lors de la mise à jour des informations de l'utilisateur.";
                }
            }
        }
    }
    ?>

<!-- Pop-up de modification réussie -->
<div id="modificationReussieModal" class="modal">
    <div class="modal-content">
        <p>Modifié avec succès.</p>
        <button onclick="fermerModificationReussieModal()">Fermer</button>
    </div>
</div>


</body>
</html>
