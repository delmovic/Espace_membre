<?php 
include_once("include/connexion.php");
include_once('include/fonction.php');

if(isset($_POST['inscription']))
{
    
    $usernamesignup=securisation($_POST['usernamesignup']);
    $email= securisation($_POST['email']) ;
    $password= securisation($_POST['passwordsignup']);
    $passwordsignup_confirm= securisation($_POST['passwordsignup_confirm']);
    
    if(!empty($password) && !empty($passwordsignup_confirm) && !empty($usernamesignup) && !empty($email))
    {       
            $len=strlen($usernamesignup);
            if($len <=20 && preg_match('/^[a-zA-Z0-9_\.]+$/',$usernamesignup))
        {
            // Verifier si le username existe et retourner une erreur
            $req= $connexion->prepare('SELECT id from users where username=?');
            $req->execute([$usernamesignup]);
            $user=$req->fetch();

                if($user){
                    $erreu='Ce pseudo est deja pris';
                    }

                     // Validiter de l'email
                     if(filter_var($email,FILTER_VALIDATE_EMAIL))
                        {

                            $req= $connexion->prepare('SELECT id from users where email=?');
                            $req->execute([$email]);
                            $user=$req->fetch();
                            if($user){
                            $erreu='Cet email est deja utilisé dans un autre compte';

                            }                       
                                if($password==$passwordsignup_confirm)
                                    {
                              // haché le mot de passe
                              $passworde=sha1($password);
                              $avatar="default.png";
                              // Insertion de l'utilisateur dans la Base de donnée users
                                $q= $connexion->prepare("INSERT INTO users SET username=?,password=?,email=?,avatar=?");
                                
                                $q->execute([$usernamesignup,$passworde,$email,$avatar]); 
                    header("location: login.php");
                        $_SESSION['flash']['success dis ']="Félicitation votre compte a été bien crée Vous pouvez vous connecter !";
                                    }else{
                                        $erreur="Vos mots de passes ne correspondent pas";
                                    }
                            
                        }else{
                            $erreu="Veuillez saisir un email valide !";
                        }
                    
        }
        else{
            $erreu="Votre pseudo doit être au minimum 15 caractères et ne doit contenir des symboles et des espaces";
        }
    }
                            /*erreur champ vide*/
        else{
             $erreu="Veuillez renseigner tous les champs s'il vous plait!";
        }
}

 ?>