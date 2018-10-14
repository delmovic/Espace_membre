<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <title>Espace Membres- Ivoire Code </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, username-class" />
        <meta name="author" content="Ivoire code" />
        <link rel="shortcut icon" href="../images/default.png">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
         
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
    </head>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenue <?= $_SESSION['username']?> sur votre profil</h1>
            <?php  if(isset($erreur)) {echo '<div class="alert alert-danger  col-md-12">'. $erreur.'</div>'; }?>

        </header>
        <!--profile start here-->
<div class="profile">
    <div class="wrap">
        <div class="profile-main">
            <div class="profile-pic wthree">
                <img src="images/<?= $_SESSION['avatar']?>" alt="photo">
                <h2><?= $_SESSION['username']?></h2>
                <p><?= $_SESSION['email']?></p>
                <p><?= $_SESSION['contacts']?></p>
            </div>
            <div class="w3-message">
                <h5>A propos d'Ivoire code</h5>
                <p>Ivoire Code est une plateforme vidéo en ligne pour les développeurs, les concepteurs et amoureux du Web qui privilégie la formation des Etudiants.</p>
                <a href="#profile" data-toggle="modal" class="btn btn-primary">Editer son profil</a>
                <a href="deconnexion.php" class="btn btn-danger ">Deconnexion</a>

                <div class="w3ls-touch">
                
                <div class="social">
                    <ul>
                        <li><a href="https://web.facebook.com/ivoirecode/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> </a></li>
                        <li><a href="https://twitter.com/CodeSourceprog" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> </a></li>
                        <li><a href="https://www.youtube.com/channel/UCy-Ec_VI-hXhetu5se5kctw" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i> </a></li>
                        <li><a href="https://github.com/delmovic" target="_blank"><i class="fa fa-github" aria-hidden="true"></i> </a></li>
                    </ul>
                </div>
            </div>
            </div>
            
        </div>
        <div class="wthree_footer_copy">
            <p>© 2018 Ivoire code. Tous droits reservés | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
        </div>
    </div>
</div>
<!--profile end here-->
<div class="portfolio-modal modal fade" id="profile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                    <h2 class="modal-title"><i class="fa fa-pencil"></i> Modifier votre profil</h2>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="modal-body">
                                <div  class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <i class="fa fa-smile-o"></i> Votre avatar sera mise a jour a votre prochaine connexion
                                </div>
                                <?php  if(isset($erreur)) {echo '<div class="alert alert-danger  col-md-12">'. $erreur.'</div>'; }?>
                                <form action="update.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="username">Nom utilisateur</label>
                                            <input type="text" id="username" class="form-control" name="username" value="<?= $_SESSION['username']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control" name="email" value="<?= $_SESSION['email']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="passwordsignup" class="youpasswd" data-icon="p">Mot de passe</label>
                                            <input id="passwordsignup" name="pass" class="form-control"  type="password" placeholder="Laisser vide pour garder le meme mot de passe" />
                                            <label for="passwordsignup_confirm"  class="youpasswd" data-icon="p">Confirmation du mot de passe </label>
                                            <input id="passwordsignup_confirm" class="form-control" name="passconfirm"  type="password" placeholder="eg. X8df!90EO" />
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Contacts</label>
                                            <input type="text" class="form-control" name="contacts" value="<?php if(isset($_SESSION['contacts'])){ echo $_SESSION['contacts'];}?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="images/<?=$_SESSION['avatar']?>" alt="photo">
                                        <input type="file" name="image">
                                    </div>
                                    </div>
                                     <div class="form-group">
                                        <button class="btn btn-success btn-block" name="upload"><i class="fa fa-edit"></i> Mettre a jour</button>
                                    </div>
                                </form>
                               
                            </div>
                            <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger"><i class="fa fa-remove"></i> Fermer</button>
                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    
    <script>
          
$('.btn-primary').click (function(){

$('.modal').modal('show');

});
    </script>
</body>
</html>