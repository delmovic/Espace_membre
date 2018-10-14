<?php session_start(); 
include_once("include/connexion.php");
  include_once('include/fonction.php');

?>

    <nav class="amd-menu navbar navbar-default navbar-fixed-top theme_background_color fadeInDown">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span><span>Menu</span> <i class="fa fa-bars"></i>
              </button>
                <a class="navbar-brand " href="index.php"><img src="images/code.png" width="110" /><br>Code <cite>Source</cite></a>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="index.php" class="page-scroll"><i class="fa fa-home"></i> Acceuil</a></li>
                <li><a href="about.php" class="page-scroll"><i class="fa fa-comment"></i> Forum</a></li>
                <li><a href="post.php" class="page-scroll"><i class="fa fa-code"></i> Formation</a></li>
                <li><a href="service.php" class="page-scroll"><i class="fa fa-users"></i> Services</a></li>
                <li><a href="tuto.php" class="page-scroll"><i class="fa fa-film"></i> Tutoriels</a></li>
                <li><a href="contacter.php" class="page-scroll"><i class="fa fa-phone"></i> Contact</a></li>
               
              </ul>

              <span class="navbar-right" style="background-color:#000;">
               <?php
                      if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
                ?>
                <ul>   
                    <li class="dropdown">
                        <a href="#" style="color:#0f0;background-color: rgba(10,10,10,0.7);" class="dropdown-toggle" data-toggle="dropdown"> 
                            <?php if(!empty($_SESSION['photo'])) {  ?>
                                    <img  width="50" height="50" src="user/photo/<?php echo $_SESSION['photo'];?>" alt="photo de profil" class=" img-circle">
                                      <?php }else{ ?>
                                    <img width="50" src="images/12.jpg" alt="photo de profil" class=" img-circle">
                            <?php }?><?php if(isset($_SESSION['pseudo'])){echo $_SESSION['pseudo'];} ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" style="background:#fff;">
                              <li>
                                  <a href="#"><i class="fa fa-fw fa-envelope"></i> Message</a>
                              </li>
                              <li>
                                  <a href="edit.php" ><i class="fa fa-fw fa-edit"></i> Editer mon profil</a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                    <a href="deconnexion.php"><i class="fa fa-fw fa-power-off"></i>Deconnexion</a>
                              </li>
                        </ul>
                    </li>
                  </ul> 
                  <?php
                        }else{
                          ?>
                       
                <a class="btn btn-info btn-connect" href="login.php">Connexion</a>
                <a class="btn btn-info btn-inscris" href="#inscription" data-toggle="modal">Inscription</a>
              <?php  } ?>
              </span>
            
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>


