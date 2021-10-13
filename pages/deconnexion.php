<?php
    session_start();
        $bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');

    $_SESSION['pseudo'] = "invite";
    $_SESSION['id'] = null;   
    header('Location: ../main.php') 
?>
<title>MAMP PRO</title>
<head>
        <title>Notation de sites</title>
        <meta charset="utf-8">
    </head>
    <body>
        toast
    </body>
</html>