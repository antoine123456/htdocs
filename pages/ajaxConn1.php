<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
?>

    <?php
    if (isset($_POST['username'])){  
        $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
        $recupUser->execute(array($_POST['username']));
        $user = $recupUser->fetch();
        if(password_verify($_POST['password'],$user['mdp'])){
            $_SESSION['pseudo'] = $_POST['username'];
            $_SESSION['id'] = $user['id'];
            echo 1;
        }else{
            echo 0;
        }
    }
?>
