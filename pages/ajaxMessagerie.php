<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
$recupComm = $bdd->prepare('SELECT * FROM message WHERE id_destination = ?');  
$recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?'); 
?>
<div class="message">
    <?php 
        $recupComm->execute(array($_SESSION['id']));
        while($comm = $recupComm->fetch()){
            $recupUser->execute(array($comm['id_source']));
            $aut = $recupUser->fetch();
            ?>
            <div>
                <?php echo $comm['message'];?>
                <a class="perso" href="#" data-id="<?php echo $aut['id'];?>">
                    <?php echo $aut['pseudo'];?>
                </a>
            </div>              
        <?php                
        } 
    ?>
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