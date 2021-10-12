<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
if (!$_SESSION['pseudo']){ 
    header('Location: ./connexion.php');
}
if(isset($_GET['id'])  AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount()>0){
        if(isset($_POST['envoyer'])){
            $message= htmlspecialchars($_POST['message']);        
            $insererMessage = $bdd->prepare('INSERT INTO message(message, id_destination, id_source)VALUES(?,?,?)');
            $insererMessage->execute(array($message,$getid,$_SESSION['id']));
        }
    }else{
        echo "something went wrong 1";
    }
}else{
    echo "something went wrong 2";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Messagerie</title>
        <meta charset="utf-8">
    </head>
    <body>
    <?php
            if ($_SESSION['pseudo']){ 
                $user = $bdd->prepare('SELECT * FROM message WHERE pseudo = ? AND id_destination = ? OR id_source = ? AND id_destination=?' );
                $user->execute(array($_SESSION['pseudo']));
                ?>  
                   <p> <a href="../main.php"><?php echo $_SESSION['pseudo'];?></a></p>
                   <a href="./deconnexion.php">
                   <button> deconnexion</button>
                </a>
               
                </p>
                
                <?php
                 $getid = $_GET['id'];
                 $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
                 $recupUser->execute(array($getid));
                
                 $user = $recupUser->fetch(); 
        
                ?>
                <h4> Message à <?php echo $user['pseudo'];?> </h4>
               <form method="POST" action="">
                   <textarea name ="message"></textarea>
                   <br/><br/>
                   <input type="submit" name="envoyer">
                </form>
                <section id="messages">
                    <?php
                        $recupMessages = $bdd->prepare('SELECT * FROM message WHERE id_source = ? AND id_destination = ? OR id_source = ? AND id_destination=?' );
                        $recupMessages->execute(array($_SESSION['id'],$getid,$getid,$_SESSION['id']));
                        while($message = $recupMessages->fetch()){
                            if($message['id_destination'] == $_SESSION['id']){
                            ?>
                            <p style="color:red"><?= $message['message']; ?></p>
                            <?php
                            }elseif($message['id_destination'] == $getid){
                                ?>
                                <p style="color:green"><?= $message['message']; ?></p>
                                <?php
                            }
                        }
                    ?>
                </section>
                <?php
            }else{
                ?>  
                something went wrong               
             <?php
             //TODO : commentaires, rate, lien avec auteur des commentaires, rate des commentaires, date, reponse a un commentaire/ citation d'une personne...
            }
        ?>
    </body>
</html>