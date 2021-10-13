<?php
        session_start();
        
    $_SESSION['pseudo'] = "invite"; 
    header('Location: ./main.php');
?>
