
<?php
session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');

$recupUser = $bdd->prepare('SELECT * FROM site WHERE id = ?');
$recupUser->execute(array($_POST['userid']));
$site = $recupUser->fetch();
if ($_SESSION["pseudo"]!="invite"){
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
    <div class="modal-header"><a class="hype" href="<?php echo $site['url']?>">
        <h4 class="modal-title"><?php echo $site['nom'];?></h4></a>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <input src="<?php echo "./images/".$site['image'];?>"  type="image" data-id='<?php echo $site['id'];?>'  class="card-img-top presentacion"></input>

    <div class="py-1">
            
            <?php echo $site['presentation'];?>
        
    </div>
        <div class="auteurs d-flex justify-content-end">
            <ul class="list-group  list-group-horizontal">
            <?php
                for($i=0;$i<$rem+1;$i++){
                    $truk = substr($var,$i*3,2);
                   
                    $recupUser->execute(array($truk));
                    $user = $recupUser->fetch();
            ?>
                <li class="list-group-item ">
                <?php if($_SESSION["pseudo"]!="invite"){
                                ?>
                                <a class="perso mdl" href="#" data-id="<?php echo $user['id'];?>">
                                <?php echo $user['pseudo'];?>
                                </a>
                                <?php
                            }else{
                                ?>
                                
                                <?php echo $user['pseudo'];?>

                                <?php
                            }
                          ?>
                </li>
            <?php
                }   
            ?>
            </ul>
         
        </div>
        <div class="message mt-3 ">
        <ul class="list-group">

                <?php 
                    $recupComm->execute(array($_POST['userid']));
                    while($comm = $recupComm->fetch()){
                        $recupUser->execute(array($comm['auteur']));
                        $aut = $recupUser->fetch();
                ?>
                        <li class="list-group-item text-end bg-light border-1">
                        <p class="text-start">
                            <?php echo $comm['message'];?>
                            </p>
                            <?php if($_SESSION["pseudo"]!="invite"){
                                ?>
                                <a class="perso mdl" href="#" data-id="<?php echo $aut['id'];?>">
                                
                                    <?php echo $aut['pseudo'];?>
                                
                                </a>
                                <?php
                            }else{
                                ?>
                                <?php echo $aut['pseudo'];?>
                                <?php
                            }
                          ?>
                        </li>               
                <?php                
                    } 
                ?>
            </ul>
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
