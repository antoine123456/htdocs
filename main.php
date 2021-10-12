<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','root','root');

?> 
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Bootstrap  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script type="text/JavaScript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

        <!-- Carousel -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

        <!-- Styles  -->
        <link rel="stylesheet" href="./style.css">

        <title>Anneau</title>
    </head>
    <body>
        <?php
            if ($_SESSION['pseudo']){ 
            ?> 
            <nav class="navbar navbar-expand-sm navbar-light  container-fluid bg-light">
                <a href="#"
                class="navbar-brand nb-0 h1">
                    <img 
                    class="d-inline-block align-top"
                    src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30"/>
                    MKTSS 
                </a>
                <button 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarNav"
                class="navbar-toggler" 
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-md-auto gap-2">
                        <li class="nav-item dropdown rounded">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill me-2"></i><?php echo $_SESSION['pseudo'];?></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item messagerie" href="#">Messagerie</a></li>
                                <?php
                                if ($_SESSION['pseudo']=='admin'){
                                ?>
                                    <li><a href="./pages/newsite.php" class="dropdown-item" >Nouveau</a></li>
                                <?php
                                    }
                                ?>                               
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./pages/deconnexion.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav> 
        <?php
            }else{
        ?>  
            <nav class="navbar navbar-light  container-fluid bg-light">
                <a href="#"
                    class="navbar-brand nb-0 h1">
                    <img 
                    class="d-inline-block align-top"
                    src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30"/>
                    MKTSS 
                </a>
                
                        <button type="button" name="login" id="login" class="loginModal  btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Connection</button>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php
             }
        ?> 
  
<!-- carousels-->
    <div class="bg-light">
        <h1>
            Catégorie
            </h1>
      <div class="wrapper">
        <div class="carousel p-2 owl-carousel">

<!-- Presentation -->
        <?php
   
            $recupSite = $bdd->query('SELECT * FROM site');
            while($site = $recupSite->fetch()){
                $var =  $site['auteurs'];
                $len = strlen($var);
                $rem = intdiv($len,3);
                $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
                
                ?>
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
                <?php
                }
            ?>          
        </div>
        </div>
    </div>
       <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">

    
  <!-- Section: Links  -->
<div class="container p-4 pb-0">
      <!-- Section: CTA -->
      <section class="">
        <p class="d-flex justify-content-center align-items-center">
          <span class="me-3"><button type="button" class="btn btn-outline-dark btn-rounded nvcom" data-bs-toggle="modal" data-bs-target="#info" >
            A propos
          </button></span>
          <button type="button" class="btn btn-outline-dark btn-rounded nvcom" data-bs-toggle="modal" data-bs-target="#nvcom" >
            S'enregistrer!
          </button>
        </p>
      </section>
      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->
  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="#">X°AU</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
    <div class="rr" href="replacement.html"></div>
    <!-- Connexion -->
    <div class="modal fade" id="loginModal" role="dialog">
            <div class="modal-dialog">
                
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <h4 class="modal-title">Connection</h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                <div class="modal-body"></div>
                <label>USername</label>
                <input type="text" name="username" id="username" class="form-control"/><br/>
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control"/><br/>
                <div class="text-end">
                Besoin d'un compte ?<a href="#" class="nvcom" data-bs-toggle="modal" data-bs-target="#nvcom"> S'inscrire maintenant</a>

                </div>

                <div class="modal-footer">
                <button type="button" name="login_button" id="login_button" class="login_button btn btn-success">Connection</button>          
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
   
            </div>                
            </div>
        </div>
    </div>
   
    <!-- Conection nouveau -->
    <div class="modal fade" id="loginModal1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content  p-2">
                    <div class="modal-header">
                        <h4 class="modal-title">Connection</h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                <div class="modal-body py-2"></div>
                <label>USername</label>
                <input type="text" name="usr" id="usr" class="form-control"/><br/>
                <label>Password</label>
                <input type="pass" name="pass" id="pass" class="form-control"/>
                <br/>
                <div class="modal-footer">
                <button type="button" name="login_button1" id="login_button1" class="login_button1 btn btn-success">Connection</button>              
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>

            </div>
            </div>
        </div>
    </div>
    <!-- Nouveau -->
    <div class="modal fade" id="nvcom" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <h4 class="modal-title">Nouveau compte</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                <div class="modal-body"></div>
                <label>USername</label>
                <input type="text" name="nom" id="nom" class="form-control"/><br/>
                <label>Password</label>
                <input type="mdp" name="mdp" id="mdp" class="form-control"/>
                <br/>
                <div class="modal-footer">
                <button type="button" name="nvcomp" id="nvcomp" class="nvcomp btn btn-success">Insertion</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>

            </div>
            </div>
        </div>
    </div>
    <!-- Presentation -->
    <div class="modal fade" id="presentation" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="aff"></div>
                <div class="modal-footer"> 
                <?php
                    if ($_SESSION['pseudo']){ 
                        ?>
                            <div class="align-items-left">Commentaire</div> 
                            <input type="text" name="comm" id="comm" class="form-control"/>
                            <button  data-id='<?php echo $_POST['userid'];?>'  type="button" name="envmess" id="envmess" class="envmess btn btn-success">Envoyer</button>
                    <?php
                    }
                ?>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
      <!-- Messagerie générale -->
      <div class="modal fade" id="messagerie" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                        <h4 class="modal-title">Messagerie</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                <div class="affiche"></div>
                <div class="modal-footer"> 
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Messagerie perso -->
    <div class="modal fade" id="messageriz" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="affichage"></div>
                <div class="modal-footer">
                <div class="align-items-left">Commentaire</div>
                <input type="text" name="commp" id="commp" class="form-control"/> 
                    <div class="booton"></div>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Info -->
    <div class="modal fade" id="info" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title"> A propos</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                Ce site permet de poster des message de manière
                    <ul>
                        <li>Ethique et responsable</li>
                        <li>Sans VSS</li>
                    </ul>
                    <div class="text-end">
                        La dirección
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
                    
                </div>
            </div>
        </div>
    </div>
 
<!-- React -->
<script type="text/JavaScript" src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
<script type="text/JavaScript" src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" crossorigin></script>
<script type="text/JavaScript" src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

<!-- Carousel -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Modals  -->
<script type="text/JavaScript" src="./Scripts.js"></script>
</body>

</html>