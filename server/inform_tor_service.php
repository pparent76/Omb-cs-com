<?php

$torhidenservice= $_GET["domain"];

include 'check_identity.php';
echo $domain."\n";

include 'global_variables.php';

//*************************************************
//Check that the customer has no hiden service yet.
//*************************************************

$link =  mysql_connect('localhost', $db_user, $db_passphrase);
  if (!$link) {die("conection à la base de donnée impossible");}
  
  $db_selected = mysql_select_db($db_name,$link);
  

  $query=sprintf(" SELECT LENGTH(tor_hidden) FROM Customers WHERE ID=".mysql_real_escape_string (strip_tags($_COOKIE['ID'])));
  $reponse= mysql_query($query,$link);   
      
  if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	  }
	  
 // On affiche chaque entrée une à une
	
 if ($donnees = mysql_fetch_assoc($reponse))
	{
	  if ($donnees['LENGTH(tor_hidden)']>0)
	    {
	    echo "This account allready has a domain.\n".$donnees['LENGTH(tor_hidden)'];
	    die();
	    }
	}	    
	
	    
	
//*********************************************
//Get corresponding tor hidden service
//*********************************************

$tdomain="";

  $query=sprintf(" SELECT domain_omb as NB FROM Customers WHERE ID=".mysql_real_escape_string (strip_tags($_COOKIE['ID'])));
  $reponse= mysql_query($query,$link);   
      
  if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	  }
	  
 // On affiche chaque entrée une à une
	
 if ($donnees = mysql_fetch_assoc($reponse))
	{
	$domain=$donnees['domain_omb'];
	}	
	
//*********************************************
//Update entry for TLS proxy
//*********************************************
include 'tls_proxy_database.php';
update_domain($domain,$torhidenservice);

//*********************************************
//Update entry for SMTP proxy
//*********************************************

//*********************************************
//Add tor service in 
//*********************************************

?>