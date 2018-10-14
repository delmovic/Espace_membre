<?php
include_once("include/connexion.php");
include_once('include/fonction.php');
include_once("include/cookie.php");

if(isset($_SESSION['id']))

  {
    if (isset($_POST['upload'])) {
      
   
    $req= $connexion->prepare('SELECT * from users where id=?');
    $req->execute(array($_SESSION['id']));
    $users=$req->fetch(); 
    if(isset($_POST['username']) && !empty($_POST['username']) && $_POST['username']!= $users['username'])     
    {
           $username=securisation($_POST['username']);
        $len=strlen($username);
        if($len >=20 && preg_match('/^[a-zA-Z0-9_\.]+$/',$username))      
     {
     
        $ql=$connexion->prepare('UPDATE users set username=? where id=?');
        $ql->execute(array($username,$_SESSION['id']));
        header('location:profil.php?id='.$_SESSION['id']);
    }
    else{
        $erreur="Votre nom utilisateur doit être au minimum 20 caractères et ne doit contenir des symboles";
    }
    }
    if(isset($_POST['email']) &&!empty($_POST['email']) && $_POST['email']!=$users['email'])     
    {
            $email=securisation($_POST['email']);

    if(filter_var($email,FILTER_VALIDATE_Eemail))
   {
    $ql=$connexion->prepare('UPDATE users set email=? where id=?');
    $ql->execute(array($email,$_SESSION['id']));
    header("location:profil.php?id=".$_SESSION['id']);
    }
    else{
        $erreur= "Veuillez entrez un email valide!";

    }
    }
    if(isset($_POST['contacts']) && !empty($_POST['contacts']) && $_POST['contacts']!= $users['contacts'])     
    {
           $contacts=securisation($_POST['contacts']);
        $len=strlen($contacts);
        if($len >=4 && preg_match('/^[0-9\.]+$/',$contacts))      
     {
     
        $ql=$connexion->prepare('UPDATE users set contacts=? where id=?');
        $ql->execute(array($contacts,$_SESSION['id']));
        header('location:profil.php?id='.$_SESSION['id']);
    }
    else{
        $erreur="Veuillez saisir un numero valide !";
    }
    }


    if(isset($_POST['pass']) && !empty($_POST['pass']) && isset($_POST['confirm']) && !empty($_POST['confirm']))     
    {
        $mdp=sha1($_POST['pass']);
        $mdp2=sha1($_POST['confirm']);
        if($mdp==$mdp2)
        {
             $ql=$connexion->prepare('UPDATE users set password=? where id=?');
    $ql->execute(array($mdp,$_SESSION['id']));
    header("location:profil.php?id=".$_SESSION['id']);
        }
        else{
         $erreur= "Vos mots de passe sont differents";
        }
    }  
     if(isset($_FILES['image']) && !empty($_FILES['image']['name']))     
    {
        $taille=2097152;
        $extension=array('jpg','jpeg','gif','png');
        if($_FILES['image']['size']<= $taille)
        {
            $extenveri=strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
            if(in_array($extenveri, $extension))
            {
                $chemin="images/".$_SESSION['id'].'.'.$extenveri;
                $resultat=move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                if($resultat)
                {
                    $ajour=$connexion->prepare('UPDATE users SET avatar=:image where id=:id ');
                    $ajour->execute(array(
                        'image'=>$_SESSION['id'].".".$extenveri,
                        'id'=>$_SESSION['id']
                        ));

                    header("location:profil.php?id=".$_SESSION['id']);
                }
            }
            else{
                $erreur="votre photo de profil doit être au format jpg,gif ou png";
            }
        }
        else{
            $erreur="votre photo de profil ne doit pas depasser 2Mo donc veuillez la changer";
        }

    }
}
 }
?>