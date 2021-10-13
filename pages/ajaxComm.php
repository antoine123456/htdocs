<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');

?>
<?php
    if (isset($_POST['commentaire'])){  
        $attache = $_POST['attache'];
        $message = htmlspecialchars($_POST['commentaire']);
        $auteur=$_SESSION['id'];
        $insererUtilisateur = $bdd->prepare('INSERT INTO comm(auteur,attache,message) VALUES(?,?,?)');
        $insererUtilisateur->execute(array($auteur,$attache,$message));
        echo 1;
    }else{
        echo 0;
    }
?>