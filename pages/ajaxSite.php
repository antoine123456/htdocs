
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
$recupUser = $bdd->prepare('SELECT * FROM site WHERE id = ?');
$recupUser->execute(array($_POST['userid']));
$site = $recupUser->fetch();
if ($_SESSION['id']){
    if(isset($_POST['envoyer'])  AND !empty($_POST['message'])){
        $attache = $_POST['userid'];
        $message = htmlspecialchars($_POST['commentaire']);
        $auteur=$_SESSION['id'];
        $insererUtilisateur = $bdd->prepare('INSERT INTO comm(auteur,attache,message) VALUES(?,?,?)');
        $insererUtilisateur->execute(array($auteur,$attache,$message));
    }
}
$var =  $site['auteurs'];
$len = strlen($var);
$rem = intdiv($len,3);
$recupComm= $bdd->prepare('SELECT * FROM comm WHERE attache = ?');
$recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
?>
<!-- presentation -->
  <!--connexion-->
    <!-- bcrypt-->
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $site['nom'];?></h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="py-1">
            
                <?php echo $site['presentation'];?>
         
        </div>
        <div class="auteurs">
            <ul class="list-group list-group-horizontal">
            <?php
                for($i=0;$i<$rem+1;$i++){
                    $truk = substr($var,$i*3,2);
                    $recupUser->execute(array($truk));
                    $user = $recupUser->fetch();
            ?>
                <li class="list-group-item">
                <a class="perso" href="#" data-id="<?php echo $user['id'];?>">
                    <?php echo $user['pseudo'];?>
                </a>
                </li>
            <?php
                }   
            ?>
            </ul>
         
        </div>
        <div class="message">
            <div>
                <?php 
                    $recupComm->execute(array($_POST['userid']));
                    echo $getid;
                    while($comm = $recupComm->fetch()){
                        $recupUser->execute(array($comm['auteur']));
                        $aut = $recupUser->fetch();
                ?>
                        <div>
                            <?php echo $comm['message'];?>
                            <a class="perso" href="#" data-id="<?php echo $user['id'];?>">
                    <?php echo $user['pseudo'];?>
                </a>
                        </div>               
                <?php                
                    } 
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.perso').click(function(){
            var userid = $(this).data("id");
            $.ajax({
                url:"./pages/ajaxMessPers.php",
                method:"POST",
                data:{userid:userid},
                success:function(data){
                    $('#presentation').modal('hide');
                   $('.affichage').html(data);
                   $('#messagerie').modal('hide');
                   $('#messageriz').modal('show');
                   
                }
            });
            $.ajax({
                url:"./pages/ajaxMessPersButton.php",
                method:"POST",
                data:{userid:userid},
                success:function(data){
                   $('.booton').html(data);
                }
            });
        });
    });
    </script>
