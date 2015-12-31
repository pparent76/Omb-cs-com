<?php
include 'global_variables.php';

function update_domain($domain,$torhidenservice)
{
    //check if the torhidenservice or the domain is empty
    if ($torhidenservice=="" or $domain=="")
    {
      echo "domain or tor hidden service is empty\n";
      return;
    }
    
    $allready_exists=1;
    //check if domain allready exists in the table.
    
    //On réalise une opération différente en fonction
    //de si le domaine existe 
    if($allready_exists)
    {
    
    echo "Warning: update not yet supported!";
    
    }
    else
    {
    
    
    $link =  mysql_connect('localhost', $db_user, $db_passphrase);
    if (!$link) {die("conection à la base de donnée impossible");}
  
    $db_selected = mysql_select_db($db_name,$link);
  

    $query=sprintf(" INSERT  INTO ".mysql_real_escape_string (strip_tags($table_tls_proxy))."(hostname,torservice) VALUES('".mysql_real_escape_string (strip_tags($domain))."','".mysql_real_escape_string (strip_tags($torhidenservice))."')");
    $reponse= mysql_query($query,$link);   
      
    if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	  }
    
    }
    
}




?>