<?php 
session_start();
$_SESSION['logUser'] = false;
$_SESSION['logAdmin'] = false;
$_SESSION['logComptable'] = false;

//Paramètres de la connexion
$host = '127.0.0.1';
$db = 'torillec';
$user ='root';
$pass='';
$charset='utf8mb4';

$databaseDsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    // Active le mode d'erreur. Par défaut, il est désactivé.
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // Définit le mode de récupération par défaut pour les requêtes. Ici, il renvoie les résultats sous forme de tableau associatif.
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Désactive l'émulation des requêtes préparées. Utilise la préparation réelle du SGBD quand c'est possible.
    PDO::ATTR_EMULATE_PREPARES => false,
   ];
   try {
    $connection = new PDO($databaseDsn, $user, $pass, $options);
   } catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
   }

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['mail']) && isset($_POST['pwd'])){
    $mail = $_POST['mail'];
    $mot_de_passe = $_POST['pwd'];
    $_SESSION['mail'] = $mail;
    $_SESSION['pwd'] = $mot_de_passe;
    }
    if($mail != "" && $mot_de_passe != ""){
        //Connexion a la base
        $req = $connection->query("SELECT * FROM utilisateur WHERE mail = '$mail' AND mot_de_passe  = '$mot_de_passe'");
        $rep = $req->fetch();
        if($rep !== false){
            // c'est ok !   
            $_SESSION['id'] = $rep['id_user'];
            $_SESSION['nom_utilisateur'] = $rep['nom'];
            if ($rep ['role'] == '1') {
                $_SESSION['logAdmin'] = true;
                header("Location: ../admin/admin.php");
                echo 'Connexion réussie'; 
                exit();
            } 
            if ($rep ['role'] == "2") {
                $_SESSION["logComptable"] = true;
                header("Location: ../comptable/comptable.php");
                echo 'Connexion réussie';
                exit();
            } 
            if ($rep ['role'] == '3') {
                $_SESSION["logUser"] = true;
                header("Location: ../user/user.php");
                echo 'Connexion réussie';
                exit();
            } 
        }
        else{
             //C'est pas ok !
            header("Location: connexion.html?error=1");
             exit();
        }
    }
}

if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<script>afficherErreurModal();</script>";
}
