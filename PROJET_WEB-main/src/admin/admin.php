<?php
session_start();
if(isset($_SESSION['logAdmin']) != true || $_SESSION['logAdmin'] != true) {
  echo "Acces Refusé";
  header("Location: ../../deconnexion.php");
  exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="admin.css">
    <script  src="admin_js.js"></script>
</head>

<body>

  <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
           <a class="navbar-brand">TORILLEC</a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../deconnexion.php"><img src="../../Images/user.png" class="user"> Log out</a></li>
                </ul>
            </div>
        </nav>
      

        <div class="col-md-12 text-center">
            <h1>Administrateur </h1>
        </div>


    <!--  On ajoute un utilisateur ici -->
  <center>
    <div class="cadre2">
      <h1 class="ajout"> Ajouter un utilisateur</h1><br>

      <form class="marge"action="admin.php" method="post">

        <h2 class="texte">Nom</h2>
        <input type="text"
                id="nom"
                name="nom"
                class="form-control"
        ><br>

        <h2 class="texte">Prénom</h2>
        <input type="text"
                id="prenom"
                name="prenom"
                class="form-control"
        ><br>

        <h2 class="texte">Mail</h2>
        <input  type="text"
                id="mail"
                name="mail" 
                class="form-control"
        ><br>

        <h2 class="texte">Mot de passe</h2>
        <input type="password"
                id="mot_de_passe"
                name="mot_de_passe"
                class="form-control"
        ><br>
        <h2 class="texte">Choisir un rôle</h2>

        <select class="form-control texte"name="role" id="role">
          <option value="1">Admin</option>
          <option value="2">Comptable</option>
          <option value="3">Commerciale</option>
        </select>


          <?php
                  // Connexion à la base de données
                  $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");

                if ($_SERVER["REQUEST_METHOD"] === "POST"){
                  if (isset($_POST['nom']) 
                    && isset($_POST['prenom']) 
                    && isset($_POST['mail']) 
                    && isset($_POST['mot_de_passe']) 
                    && isset($_POST['role'])) {

                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $mail = $_POST['mail']; 
                        $mot_de_passe = $_POST['mot_de_passe'];
                        $role = $_POST['role']; 
              
                        $stmt=$db->prepare("INSERT INTO utilisateur (prenom,nom,role,mot_de_passe,mail) VALUES(:prenom,:nom,:role,:mot_de_passe,:mail)");
                        $stmt->bindParam(":prenom",$prenom);
                        $stmt->bindParam(":nom",$nom);
                        $stmt->bindParam(":role",$role);
                        $stmt->bindParam(":mot_de_passe",$mot_de_passe);
                        $stmt->bindParam(":mail",$mail);
                        $stmt->execute();
                        header("Location: admin.php");
                        exit();
                    }
                  }    
            ?>


    <br>
    <input class="bouton_ajt"
            type="submit"
            value="Ajouter l'utilisateur"
    >
    <input class="bouton_initialiser"
            type="reset"
            value="Effacer"
    >
    <br>
  </div>
</form>

<!---afficher les données de tout les users, supprimer les users--->
<div class="cadre2">
  <table id="myTable" class="table cadre" > <!-- Affichage dans un tableau -->
    <thead>
      <tr>
        <th scope="col">Id utilisateur</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Rôle</th>
        <th scope="col">Mail</th>
        <th scope="col">Mot de Passe</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>

    


          <?php
          if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=='delete'){
            $id=$_GET['id'];
            $suppr = "Utilisateur supprimé";
            $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
            $stmt=$db->prepare("DELETE FROM utilisateur WHERE id_user=:id");
            $stmt->bindParam (":id",$id);
            $req = $db->prepare("UPDATE factures SET nom_utilisateur = CONCAT(nom_utilisateur, :suppr) WHERE id_user = :id");
            $req->execute(['suppr' => $suppr, 'id' => $id]);
     
            $stmt->execute();
            header("Location: admin.php");
            exit();

          }     
          $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
          $data = $db->query("SELECT * FROM utilisateur")->fetchAll();

          foreach ($data as $row){
            echo "<tr>";
            echo "<td>".$row["id_user"]."</td>";
            echo "<td>".$row["nom"]."</td>";
            echo "<td>".$row["prenom"]."</td>";
            echo "<td>".$row["role"]."</td>";
            echo "<td>".$row["mail"]."</td>"; 
            echo "<td>".$row["mot_de_passe"]."</td>";
            echo '<td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                                >Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                              <a class="dropdown-item bouton_modifier"
                                  href="edit_user.php?id='.$row['id_user'].'"
                                  >Modifier
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item bouton_supprimer" 
                                  href="#" 
                                  onclick="confirmDelete('.$row['id_user'].')"
                                  >Supprimer
                              </a>
                            </li>
                        </ul>
                      </div>
                  </td>';
            echo "</tr>";

      }
 
 ?>
</table>
        </div>
      
      </div>
    </tbody>
  </body>

<!-- Bouton de suppression avec appel à la fonction de confirmation -->
<!--
<button onclick="afficherModal()">Supprimer</button>

<!-- Fenêtre modale pour la confirmation de suppression -->
<div id="modalConfirmation" class="modal">
  <div class="modal-content">
    <p>Êtes-vous sûr de vouloir supprimer cet utilisateur?</p>
    <button onclick="supprimerUtilisateur(<?php echo $row['id_user']; ?>)">Oui</button>
    <button onclick="fermerModal()">Annuler</button>
  </div>
</div>

<!-- Fenêtre modale pour la confirmation de suppression réussie -->
<div id="modalConfirmationReussie" class="modal">
  <div class="modal-content">
    <p>L'utilisateur a été supprimé avec succès!</p>
    <button onclick="redirectToDeletePage()">Fermer</button>
  </div>
</div>

    </div>
</div>

    <!-- Footer -->
    <footer>
    <section class="footer_section">
        <div class="container">
            <center><p>
                © 2024 - Tous droits révervés par Torillec Company
            </center></p>
        </div>
    </section>
    <!-- Fin footer -->

</body>
</html>
