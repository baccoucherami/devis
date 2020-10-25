
<?php
$host = 'localhost';
$dbname = 'test1';
$username = 'root';
$password = '';

    echo "<h1>rami</h1>";

    try {
        // se connecter à mysql
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$username", "$password");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }

    // récupérer les valeurs

    $nom = $_POST["nom"];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $gsm = $_POST['gsm'];
    $adresse = $_POST['adresse'];
    // Requête mysql pour insérer des données
    $sql= "INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `gsm`, `adresse`) "
    ."VALUES (NULL, '".$nom."', '".$prenom."', '".$email."', '".$gsm."', '".$adresse."')";
    $res = $pdo->prepare($sql);
    $exec = $res->execute();


    // vérifier si la requête d'insertion a réussi
    if ($exec) {
        echo 'Données insérées';
    } else {
        echo "Échec de l'opération d'insertion";
    }
?>
<?php
  header('Location: /devis/index.php');
  exit();
?>
