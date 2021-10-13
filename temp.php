 <!-- Card -->
 <div class="card item-card card-block une-slide cart-1">
    <div class=" apre-img  product">
        <input src="./images/pngegg.png"  type="image" data-id='<?php echo $site['id'];?>'  class="card-img-top presentacion"></input>
                    <div class="overlay">
                    <?php echo $site['nom'];?>
                    </div>          
        </div>
        <td><?php echo substr($site['presentation'],0,200);?></td>
        <div class="auteurs">
            <ul class="list-group list-group-horizontal justify-content-end">
            <?php
                for($i=0;$i<$rem+1;$i++){
                    $truk = substr($var,$i*3,2);
                    $recupUser->execute(array($truk));
                    $user = $recupUser->fetch();
            ?>
                <li class="list-group-item bg-transparent border-0">
                <?php if($_SESSION["pseudo"]){
                                ?>
                                <a class="perso" href="#" data-id="<?php echo $user['id'];?>">
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
</div>
 
<!--  Recent -->
card-overlay
card-img-overlay

<?php

   $recupSite = $bdd->query('SELECT * FROM site');
   while($site = $recupSite->fetch()){
       $var =  $site['auteurs'];
       $len = strlen($var);
       $rem = intdiv($len,3);
       $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
       
       ?>
       
       <!-- Card -->
       <div class="card ovf-hidden">

       <!-- Card image -->
       <div class="view overlay ">
       <img class="card-img-top  " src="https://mdbootstrap.com/img/Photos/Others/photo11.jpg" alt="Card image cap">
       <a>
           <div class="mask waves-effect waves-light rgba-white-slight"></div>
       </a>
       <div class="">
           <h5 class="card-title">Card title</h5>
       </div>

       
       </div>

       <!-- Card content -->
       <div class="card-body ">

       <!-- Social shares button -->
       <a class="activator mr-4"><i class="fas fa-share-alt"></i></a>
       <!-- Title -->
       <h4 class="card-title">Card title</h4>
       <hr>
       <!-- Text -->
       

       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
           content.
           <div class="collapse " id="<?php echo "collapse".$site['id'];?>">
               
           <div class="aff"></div>                   
       </div></p>
       <a id="<?php echo $site['id'];?>" class="btn btn-primary presentacion" data-id='<?php echo $site['id'];?>' data-bs-toggle="collapse" href="<?php echo "#collapse".$site['id'];?>" role="button" aria-expanded="false" aria-controls="collapseExample">
       <span class="collapsed">
              Voir plus
           </span>
           <span class="expanded">
              Voir moins
           </span>
       </a>

          <!--  <button type="button" class="btn btn-outline-dark btn-rounded nvcom" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
           Voir plus
       </button> -->

       </div>


       </div>
       <!-- Card -->
       <?php
       }
   ?>          
</div>
</div>
</div>