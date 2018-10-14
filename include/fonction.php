<?php   if(session_status()==PHP_SESSION_NONE)
{
	session_start();
}

?>
 
<?php

function securisation($var){

$var=trim($var);
$var=stripcslashes($var);
$var=strip_tags(htmlspecialchars($var));
return $var;
}
?>
	  
    <?php  if(isset($_SESSION['flash']))
{
    foreach ($_SESSION['flash'] as $type => $sms) {?>
    
        <div style="padding-top:1%;font-size:25px;" class="text-center glyphicon glyphicon-user alert alert-<?=$type  ?>">
            <?=$sms?>
         </div>

     <?php
    }
   unset($_SESSION['flash']); 
}  
?>