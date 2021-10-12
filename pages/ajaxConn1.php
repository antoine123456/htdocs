<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
?>

    <?php
    if (isset($_POST['username'])){  
        $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute(array($_POST['username'],$_POST['password']));
        if($recupUser->rowCount()>0){
            $_SESSION['pseudo'] = $_POST['username'];
            $_SESSION['id'] = $recupUser->fetch()['id'];
            echo 1;
        }else{
            echo 0;
        }
    }
?>
