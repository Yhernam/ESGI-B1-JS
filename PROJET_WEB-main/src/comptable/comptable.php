<?php
session_start();
if(isset($_SESSION['logComptable']) != true || $_SESSION['logComptable'] != true) {
  echo "Acces Refusé";
  header("Location: ../../deconnexion.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TORILLEC - Comptable</title>
    <link rel="stylesheet" type="text/css" href="../../index.css">
    <link rel="stylesheet" type="text/css" href="comptable.css">
    <link rel="icon" href="../../Images/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            <h1>COMPTABLE </h1>
        </div>
        
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2">
                        <h4>FILTRE :</h4>
                    </div>

                    <div class="col-md-10">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="date" name="date" required value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>" class="form-control">
                                </div>
                            <div class="col-md-4">
                                <select name="status" required class="form-select">
                                    <option value="">Selectionner le Status</option>
                                    <option value="En attente de traitement" <?= isset($_GET['status']) && $_GET['status'] == 'En attente de traitement' ? 'selected' : '' ?>>En attente</option>
                                    <option value="Validé" <?= isset($_GET['status']) && $_GET['status'] == 'Validé' ? 'selected' : '' ?>>Validé</option>
                                    <option value="Refusé" <?= isset($_GET['status']) && $_GET['status'] == 'Refusé' ? 'selected' : '' ?>>Refusé</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filtre</button>
                                <a href="comptable.php" class="btn btn-danger">Reset</a>
                            </div>
                    
                        </form>
                    </div>
                </div>
            </div>
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ETAT</th>
                        <th scope="col">DATE</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">SOMME</th>
                        <th scope="col">UTILISATEUR</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db = new PDO("mysql:host=localhost;dbname=torillec;charset=utf8mb4","root","");
                        $data = $db->query("SELECT * FROM factures");

                    if(isset($_GET['date']) && $_GET['date'] !='' && isset($_GET['status']) && $_GET['status'] !='' ){
                        $date = ($_GET['date']);
                        $status=($_GET['status']);
                        $data = $db->query("SELECT * FROM factures WHERE date = '$date' AND etat='$status'");
                    }
                    else{
                    $data = $db->query("SELECT * FROM factures");
                    } 
                 
           
                    foreach ($data as $data_facture){
                        echo "<tr>";
                        echo "<td>".$data_facture["id_facture"]."</td>";
                        echo "<td>".$data_facture["etat"]."</td>";
                        echo "<td>".$data_facture["date"]."</td>";
                        echo "<td>".$data_facture["type"]."</td>";
                        echo "<td>".$data_facture["somme"]."</td>";
                        echo "<td>".$data_facture["nom_utilisateur"]."</td>";
                        echo '<td>
                        <form action="traitement.php" method="post">
                            <input type="hidden" name="id_facture" value="'.$data_facture['id_facture'].'">
                            <input type="submit" name="bouton" class="bouton_valider" value="Valider">
                            <input type="submit" name="bouton" class="bouton_refuser" value="Refuser">
                        </form>
                        </td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
    </script>
</body>
</html>
