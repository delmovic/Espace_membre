<?php
if(isset($_SESSION['id']) && isset($_COOKIE['username']) && isset($_COOKIE['password']) && !empty($_COOKIE['username']) && !empty($_COOKIE['password']))
{

$sql= $connexion->prepare("SELECT * from users where username=? && password=?");
        $sql->execute(array($_COOKIE['username'],$_COOKIE['password']));
        $exit=$sql->rowcount();
        if($exit==1)
        {
             
                $userinfo=$sql->fetch();
                $_SESSION['id']= $userinfo['id'];
                $_SESSION['username']=$userinfo['username'];
                $_SESSION['email']=$userinfo['email'];
                $_SESSION['contact']=$userinfo['contact'];
                $_SESSION['photo']=$userinfo['photo'];
                
            }




}




?>