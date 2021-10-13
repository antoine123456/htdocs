<?php
session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');

?>
<?php
    if (isset($_POST['corps'])){  
        $message= htmlspecialchars($_POST['corps']);    
        $getid=$_POST["userid"];   
        $insererMessage = $bdd->prepare('INSERT INTO message(message, id_destination, id_source)VALUES(?,?,?)');
        $insererMessage->execute(array($message,$getid,$_SESSION['id']));
        echo 1;
    }else{
        echo 0;
    }
?>