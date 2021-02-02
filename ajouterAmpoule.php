<?php
//1 - connexione pdo base de données
// 2 - ecrire la requète SQL
// 3 -a requète préparée
// 3-b lier les paramètre (bind)
//4 executer la requète (array)
ob_start();
$title = "ACCUEIL CRUD AMPOULES";

//Connexion a PDO mySQL
$user = "root";
$pass = "";
//Connexion à la base de données via l'instance de la classe native PDO de php
try {
    //host + nom de la base de données + encodage + nom utilisateur phpmyadmin et mot de passe
    $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "COnnexion a pdo mysql";
} catch (PDOException $exception) {
    echo "Erreur de connexion a PDO MySQL " . $exception->getMessage();
}
//Recupération des element du dormulaire

if(isset($_POST['date_changement']) && !empty($_POST['date_changement'])){
    $date_changement = htmlspecialchars(strip_tags($_POST['date_changement']));
}else{
    echo "Erreur: merci de remplir le champ date";
}

if(isset($_POST['etage']) && !empty($_POST['etage'])){
    $etage = htmlspecialchars(strip_tags($_POST['etage']));
}else{
    echo "Erreur: merci de remplir le champ etage";
}

if(isset($_POST['position_ampoule']) && !empty($_POST['position_ampoule'])){
    $position_ampoule = htmlspecialchars(strip_tags($_POST['position_ampoule']));
}else{
    echo "Erreur: merci de remplir le champ position";
}

if(isset($_POST['prix_ampoule']) && !empty($_POST['prix_ampoule'])){
    $prix_ampoule = htmlspecialchars(strip_tags($_POST['prix_ampoule']));
}else{
    echo "Erreur: merci de remplir le champ date";
}





//2
$sql = "INSERT INTO ampoules (date_changement, etage, position_ampoule, prix_ampoule) VALUES (?,?,?,?)";
//3-a
$request = $db->prepare($sql);
//3-b
$request->bindParam(1,$date_changement);
$request->bindParam(2,$etage);
$request->bindParam(3,$position_ampoule);
$request->bindParam(4,$prix_ampoule);

$resultat = $request->execute(array($date_changement, $etage,$position_ampoule, $prix_ampoule));


if($resultat){
    echo "Le produit est bien ajouté";
    header("Location:http://localhost/Ampoules/listeAmpoule.php");
}
echo "Erreur le formulaire est mal rempli";


$content = ob_get_clean();
require "template.php";

