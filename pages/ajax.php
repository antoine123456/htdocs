<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
$recupUser = $bdd->prepare('SELECT * FROM site WHERE id = ?');
$recupUser->execute(array($_POST['userid']));
$site = $recupUser->fetch();

?>
<!-- presentation -->
  <!--connexion-->
    <!-- bcrypt-->
    <div class="container">
       <?php
            if ($_SESSION['id']){
                if(isset($_POST['valider'])  AND !empty($_POST['message'])){
                    $message = htmlspecialchars($_POST['message']);
                    $getid=$site['id'];
                    $auth =(int)$_SESSION['id'];
                    $insererUtilisateur = $bdd->prepare('INSERT INTO comm(auteur,attache,message) VALUES(?,?,?)');
                    $insererUtilisateur->execute(array($auth,$getid,$message));
                }
            }
            $var = $site['auteurs'];
            $len = strlen($var);
            $rem = intdiv($len,3);
            $recupComm= $bdd->prepare('SELECT * FROM comm WHERE attache = ?');
            $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
            ?>
            <div class="presentation">
                <h4 class="modal-title"><?php echo $var?></h4>
                <div>
                    <h1>
                        <?php echo $site['nom'];?>
                    </h1>
                </div>
                <div class="py-4">
                    <p class=" text-justify">
                        <?php echo $site['presentation'];?>
                    </p>
                </div>
                
                <?php
                    for($i=0;$i<$rem+1;$i++){
                        $truk = substr($var,$i*3,2);
                        $recupUser->execute(array($truk));
                        $user = $recupUser->fetch();
                ?>
                        <a href="./pages/message.php?id=<?php echo $user['id'];?>">
                            <?php echo $user['pseudo'];?><br>
                        </a>
                <?php
                    }   
                ?>                                                        
            </div>
            <div class="message">
                <div >
                    <?php 
                        $recupComm->execute(array($getid));
                        while($comm = $recupComm->fetch()){
                            $recupUser->execute(array($comm['auteur']));
                            $aut = $recupUser->fetch();
                    ?>
                            <div>
                            <?php echo $comm['message'];?>
                                <a href="./pages/message.php?id=<?php echo $user['id'];?>">
                                    <?php echo $aut['pseudo'];?>
                                </a>
                            </div>               
                    <?php                
                    } 
                    ?>
                </div>
                <?php
                if ($_SESSION['pseudo']){ 
                ?>
                    <div class="div">
                        <form method="POST" action="">
                            <textarea name ="message"></textarea>
                            <br/><br/>
                            <input type="submit" name="valider">
                        </form>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
