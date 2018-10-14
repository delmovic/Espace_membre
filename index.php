<?php session_start(); 
include_once("include/connexion.php");
include_once('include/fonction.php');
include_once("include/cookie.php");
 // traitement du formulaire de connexion

 if(isset($_POST['login']))
    {
    $username=securisation($_POST['username']);
    // Mettre la saisie en miniscule et haché le mot de passe 
    $passe = strtolower( securisation(sha1($_POST['password'])));
         // on verifie si les champs ne sont pas vide
         if(!empty($username) && !empty($passe))
            {
      
            // on verifie que utilisateur existe afin d'effectuer la connexion 
            $sql= $connexion->prepare("SELECT * from users where (username=:username  or email=:username) and password=:password");
            $sql->execute(['username'=>$username,'password'=> $passe]);
            $exit=$sql->rowcount();
            if($exit==1){
                    if(isset($_POST['loginkeeping'])){
                     setcookie("username","$username",time()+24*3600*365,"/",null,false,true);
                    setcookie("password","$passe",time()+24*3600*365,"/",null,false,true);
                    }
                    // Recuperer les info dans la base de donnée et les inserer dans une session
                    $userinfo=$sql->fetch();
                    $_SESSION['id']= $userinfo['id'];
                    $_SESSION['username']=$userinfo['username'];
                    $_SESSION['email']=$userinfo['email'];
                    $_SESSION['avatar']=$userinfo['avatar'];
                    $_SESSION['contacts']=$userinfo['contacts'];
                  header("location:profil.php");
                  
                }
            else{

                $erreur="Identifiant ou mot de passe incorrect";
                }

    

    }else{

        $erreur="Veuillez renseigner tous les champs s'il vous plait!";
    }

    }
 
?>
<!DOCTYPE html>

<html lang="en" class="no-js"> 
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
        <div class="container">
          
            <header>
                <h1>Espace Membres <span>avec HTML5,CSS3 et PHP</span></h1>
			
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <a class="hiddenanchor" id="toforget"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <!-- Afficher les erreurs de validations -->
                            <form  action="" method="POST" autocomplete="on"> 
                                <h1>Connexion</h1> 
                                <?php  if(isset($erreur)) {echo '<div class="alert alert-danger  col-md-12">'. $erreur.'</div>'; }?>

                                <p> 
                                    <label for="username" class="uname" data-icon="u" >  Email ou Nom utilisateur </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com" value="<?php if(isset($username)){ echo $username;}?>"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Mot de passe </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Se souvenir de moi</label>
								</p>
                                <p class="login button"> 
                                    <input type="submit" value="Connexion" name="login" /> 
								</p>
                                <p class=""><a href="forget.php" class="to_register">Mot de passe oublié</a></p>
                                <p class="change_link">
									Pas encore membre ?
                                    <a href="#toregister" class="to_register">Rejoignez nous</a>
								</p>
                            </form>
                        </div>

                        

                        <div id="register" class="animate form">
                            <form  action="register.php" method="POST" autocomplete="on"> 
                                <h1>Inscription </h1> 
                                <?php if(isset($erreu)) {echo '<div align="center" class="alert alert-danger ">'. $erreu.'</div>';  }?> 

                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Nom utilisateur</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" value="<?php if(isset($usernamesignup)){ echo $usernamesignup;}?>" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Email</label>
                                    <input id="email" name="email" required="required" type="email" placeholder="mysupermail@mail.com" value="<?php if(isset($email)){ echo $email;}?>"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p"> Mot de passe </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirmation du mot de passe </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" name="inscription" value="Inscription"/> 
								</p>
                                <p class="change_link">  
									Déja membre ?
									<a href="#tologin" class="to_register">Se connecter </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    
    </body>
</html>

