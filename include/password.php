<?php
// Verifie la soummission du formulaire
if(isset($_POST['recu'],$_POST['email']))
{
// Recuperation de l'email soumis et securisation du champ
$recupmail=securisation($_POST['email']);
 if(!empty($recupmail))
        {
            if(filter_var($recupmail,FILTER_VALIDATE_EMAIL))
  {
        $sql= $connexion->prepare("SELECT id,username from users where email=?");
        $sql->execute(array($recupmail));
        $exit=$sql->rowcount();
        if($exit==1)
        {   $pseudo= $sql->fetch();
            $pseudo=$pseudo['username'];
            $_SESSION['recupmail']= $pseudo;
            $_SESSION['flash']['success text-center']="Veuillez renseigner votre nouveau mot de passe";                         
                        header("location:http://localhost/Espace_Membres/forget.php?section=newmdp"); 
        }

        else{
            $erreur="Cet email n'est pas enregistrer, Veuillez crée un compte s'il vou plait";
            }

        }
        else{$erreur="Veuillez saisie un E-mail valide!";}
}

else{

    $erreur="Veuillez renseigner votre adresse E-mail s'il vous plait!";
    }


 }
 ?>