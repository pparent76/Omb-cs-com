<?php

    $link =  mysql_connect('localhost', 'dbuser', 'passphrase');
    if (!$link) {die("conection à la base de donnée impossible");}
   
   $db_selected = mysql_select_db("own-mailbox",$link);
	 
echo "ID:".$_COOKIE['ID']."<\br>\n";
echo $_COOKIE['passphrase'];

   	$query=sprintf(" SELECT COUNT(ID) AS DB FROM Customers WHERE ID=".mysql_real_escape_string (strip_tags($_COOKIE['ID']))." AND passphrase='".mysql_real_escape_string (strip_tags($_COOKIE['passphrase']))."'");
	$reponse= mysql_query($query,$link);   
	
		  if (!$reponse) {
	      $message  = 'Invalid query: ' . mysql_error() . "\n";
	      $message .= 'Whole query: ' . $query;
	      die($message);
	    }
	    
	    
	    	    	     // On affiche chaque entrée une à une
	 if ($donnees = mysql_fetch_assoc($reponse))
	  {
	    if ($donnees['DB']!=1)
	      {
	      echo "<p>Invalid identifiaction.</p>";
	      die();
	      }
	  }
?>