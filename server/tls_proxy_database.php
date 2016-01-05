<?php

function update_domain($domain,$torhidenservice)
{
    //check if the torhidenservice or the domain is empty
    if ($torhidenservice=="" or $domain=="")
    {
      echo "domain or tor hidden service is empty\n";
      return;
    }
    
    $allready_exists=0;
    //check if domain allready exists in the table.
    
    //On réalise une opération différente en fonction
    //de si le domaine existe 
    if($allready_exists)
    {
    
    echo "Error: update not yet supported!";
    
    }
    else
    {
    include 'global_variables.php';
    
    $link =  mysql_connect('localhost', $db_user, $db_passphrase);
    if (!$link) {echo "tls_proxy: conection à la base de donnée impossible\n"; return;}
  
    $db_selected = mysql_select_db($db_name,$link);

    $query=sprintf(" INSERT  INTO ".mysql_real_escape_string (strip_tags($table_tls_proxy))."(hostname,torservice) VALUES('".mysql_real_escape_string (strip_tags($domain.$domain_post_fix))."','".mysql_real_escape_string (strip_tags($torhidenservice))."')");
    $reponse= mysql_query($query,$link);   
      
    if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query. "\n";
	    echo $message;
	    return;
	  }
    
    }
    
}




?>