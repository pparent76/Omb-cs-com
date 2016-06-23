<?php 



include '../global_variables.php'; 

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if ($_GET["user"]==$db_user and $_GET["password"]==$db_passphrase )
  {
  echo "Identifiaction réussie!</br>";
  
  $link =  mysql_connect('localhost', $db_user, $db_passphrase);
  if (!$link) {die("conection à la base de donnée impossible");}
  
  $db_selected = mysql_select_db($db_name,$link);
  

  $passphrase=generateRandomString(40);
  
   $query=sprintf(" INSERT  INTO Customers(passphrase) VALUES('".mysql_real_escape_string (strip_tags($passphrase))."')");
   $reponse= mysql_query($query,$link);   
      
    if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query. "\n";
	    echo $message;
	    return;
	  }
	  
   $query=sprintf(" SELECT ID FROM Customers WHERE passphrase='".mysql_real_escape_string (strip_tags($passphrase)))."'";
   $reponse= mysql_query($query,$link);   
      
   if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	  }
	  
 // On affiche chaque entrée une à une
	
 if ($donnees = mysql_fetch_assoc($reponse))
	{
	  $ID=$donnees['ID'];
	}	
	
	$dir="/var/www/html/request-omb/Create_Acounts/";
  	    $cookie_path=generateRandomString(40);
	 file_put_contents ($dir.$cookie_path.".cookie","ID=".$ID."; passphrase=".$passphrase.";");
	 echo "<a href=\"https://proxy.omb.one:6565/request-omb/Create_Acounts/".$cookie_path.".cookie"."\"/>https://proxy.omb.one:6565/request-omb/Create_Acounts/".$cookie_path.".cookie"."</a>"; 
	 echo "</br>Send mail ".$_GET["email"];
	 
    /*************************************************************
    *			Add user to Dovecot
    **************************************************************/
   echo  exec("sudo /usr/lib/cgi-bin/add-dovecot-user.sh ".$ID." ".$passphrase);
    
     $to      = $_GET["email"];
     $subject = 'Own-Mailbox: your identification cookie for the proxy service.';
     $message = "Hi !\n you have requested an Identifiaction cookie for the Own-Mailbox tor proxy service.\n You can download it here: https://proxy.omb.one:6565/request-omb/Create_Acounts/".$cookie_path.".cookie".
     "\n In order to see how to use it please see this page:https://www.own-mailbox.com/public-wiki-axsde/index.php/Identification_cookie \n Thanks! \n Pierre";
     $headers = 'From: pierre.parent@pparent.fr' . "\r\n" .
     'Reply-To: pierre.parent@pparent.fr' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     mail($to, $subject, $message, $headers);
  }
else
  {	
  echo "Identification rattée pour ".$_GET["user"];
  }