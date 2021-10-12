<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');
$recupComm = $bdd->prepare('SELECT * FROM message WHERE id_destination = ?');  
$recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id= ?');
$recupUser->execute(array($_POST['userid'])); 
?>
<div class="modal-header">
    <h4 class="modal-title"><?php echo $recupUser->fetch()['pseudo'];?></h4>
    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
</div>
<div class="message">
<ul class="list-group list-group-flush">
                          
    <?php 
        $recupComm->execute(array($_POST['userid']));
        while($comm = $recupComm->fetch()){
        ?>
            <div>
                <?php if($comm['id_source']==$_SESSION['id']){

                    ?>
                     <li class="list-group-item text-end bg-light border-0">
                        
                            <?php echo $comm['message'];?>
                
                     </li>
                    
                
                    <?php

                }else{
                    ?>
                    <li class="list-group-item bg-primary border-0">
                         <?php echo $comm['message'];?>
                     </li>
                    <?php
                }
                ?>
            </div>              
        <?php                
        } 
    ?>
    </ul>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('.envmessp').click(function(){
    var userid = $(this).data('id');
    var corps = $("#commp").val();
    if(corps!=''){
        $.ajax({
        url:"./pages/ajaxMessPersEnv.php",
        method:"POST",
        data:{userid:userid,corps:corps},
        success:function(data){
            if(data == 1 ){
                alert('envoyé');
                $('#messageriz').modal('hide');
            }else{
                alert('erreur?');
            }
        
        }
    });
    }else{
        alert('vide')
    }
    
});
});
</script>