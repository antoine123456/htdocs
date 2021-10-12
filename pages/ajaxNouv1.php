<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
?>
    <?php
    if (isset($_POST['username'])){  
        $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
        $recupUser->execute(array($_POST['username']));
        if($recupUser->rowCount()>0){
            echo 0;
        }else{
            $Mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $pseudo = htmlspecialchars($_POST['username']);
            $insererUtilisateur = $bdd->prepare('INSERT INTO utilisateur(pseudo,mdp) VALUES(?,?)');
            $insererUtilisateur->execute(array($pseudo,$Mdp));
            echo 1; 
        }
    }else{
        echo 0;
    }
?>
