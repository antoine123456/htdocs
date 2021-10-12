<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
$recupComm = $bdd->prepare('SELECT * FROM message WHERE id_destination = ? AND id_source = ?');  
$recupUser = $bdd->query('SELECT * FROM utilisateur'); 
?>
<div class="message">
<ul class="list-group">

    <?php 
         while($user = $recupUser->fetch()){
            $recupComm->execute(array($_SESSION['id'],$user['id']));
            ?>
            
             <div class="align-item-center">
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <a class="perso" href="#" data-id="<?php echo $user['id'];?>">
                    <?php echo $user['pseudo'];?>
                </a>
                <span class="badge bg-primary rounded-pill"> <?php echo $recupComm->rowCount();?></span>
            

                
               
            </div>  

        <?php                
        } 
    ?>
    </ul>
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