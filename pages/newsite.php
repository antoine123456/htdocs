<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
if(isset($_POST['envoyer'])){
    $message= htmlspecialchars($_POST['message']);        
    $insererMessage = $bdd->prepare('INSERT INTO site(auteurs, presentation, nom)VALUES(?,?,?)');
    $insererMessage->execute(array($_POST['auteur'],$_POST['presentation'],$_POST['nom']));
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Anneau</title>
        <meta charset="utf-8">
    </head>
    <body>
        
        <p> <a href="../main.php"><?php echo $_SESSION['pseudo'];?></a></p>
        <a href="./deconnexion.php">
        <button> deconnexion</button>
        </a>
        </p>
        <form method="POST" action="">
            Presentation :
           <textarea name ="presentation"></textarea>
           <br/> Nom :<br/>
          
           <input type="text" name ="nom"></textarea>
           <br/>Auteur :<br/>
           <input type="text" name ="auteur"></textarea>
           <br/><br/>
           
           <input type="submit" name="envoyer">
        </form>
    <body>
</html>