<?php 
include_once("include/connexion.php");
include_once('include/fonction.php');
include('include/password.php');
if (isset($_GET['section'])) {
    $section= securisation($_GET['section']);
 }else{
    $section="";   
 }
//traitement de reinitialisation du mot de passe 
if(isset($_POST['nouvo']))
  {
        $passe=securisation(sha1($_POST['pass']));
        $passec=securisation(sha1($_POST['passconfirm']));
        // Longueur du mot de passe 
        $long=strlen($passe);
        var_dump($long);
        die();
      // verification du mot de passe
      if($long>=8)
      {
        if($passe==$passec)
          {
                      /*  Mise a jour du mot de passe */  
                       $q= $connexion->prepare("UPDATE users SET password=? where username=?");
                        $q->execute([$passe, $_SESSION['recupmail']]); 
                          // Redirection a la page de connexion 
                          $_SESSION['flash']['success']='Votre mot de passe a été modifié avec succès, vous pouvez vous connecter';
                          header("location:index.php");
        }else{
          $erreur="vos mots de passes sont differents";
        }
      }else{
        $erreur="votre mot de passe doit être au minimum de 8 caractères";
      }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Espace Membres- Ivoire Code </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, username-class" />
        <meta name="author" content="Ivoire code" />
        <link rel="shortcut icon" href="../images/logo.png">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
         
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
        <body>
            <!-- container -->
     
<div class="container">
           
            <header>
                <h1>La securite de vos donnees <span>notre priorite</span></h1>
            </header>
            <div class="col-md-12">               
                <div id="container_demo" >
                
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                
                    <div id="wrapper">
                        <div  class="col-offset-md-3 col-md-9">
                                <?php  if(isset($erreur)) {echo '<div class="alert alert-danger  col-md-12">'. $erreur.'</div>'; }?>
          
                                <h1 class="reduction"> Recuperation de Mot de passe</h1> 
                                  <?php if($section == 'newmdp') { ?>
                                 <p align="center">Nouveau mot de passe pour <?=$_SESSION['recupmail']?></p>
                                <form autocomplete="on" method="POST"> 
                                     <p> 
                                        <label for="passwordsignup" class="youpasswd" data-icon="p">Mot de passe</label>
                                        <input id="passwordsignup" name="pass" required="required" type="password" placeholder="eg. X8df!90EO" />
                                    </p>
                                    <p> 
                                        <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirmation du mot de passe </label>
                                        <input id="passwordsignup_confirm" name="passconfirm" required="required" type="password" placeholder="eg. X8df!90EO" />
                                    </p>
                                    <p class="login button"> 
                                        <input type="submit" value="Reinitialiser" name="nouvo" /> 
                                    </p>
                                </form> 
                             <?php }else{ ?> 
                             <form autocomplete="on" method="POST"> 
                                    <p> 
                                        <label for="emailsignup" class="youmail" data-icon="e"> Email</label>
                                        <input id="emailsignup" name="email" required="required" type="email" placeholder="Veuillez saisir votre email " /> 
                                    </p>
                                    <p class="login button"> 
                                        <input type="submit" value="Envoyer" name="recu" /> 
                                    </p>
                                </form>
                               <?php } ?>  
                        </div>
                    </div>
                </div>  
            </div>
            
        </div>

            <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    
  </body>

</html>
