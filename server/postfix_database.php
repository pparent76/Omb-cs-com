<?php

function postfix_update_domain($domain,$torhidenservice)
{
    //check if the torhidenservice or the domain is empty
    if ($torhidenservice=="" or $domain=="")
    {
      echo "domain or tor hidden service is empty\n";
      return;
    }
    
    $allready_exists=0;
    //check if domain allready exists in the table.
    include 'global_variables.php';
    
    $link2 =  mysql_connect('localhost', $db_user, $db_passphrase);
    if (!$link2) {echo "tls_proxy: conection à la base de donnée impossible\n"; return;}
  
    $db_selected = mysql_select_db($data_base_postfix,$link2);

        $query=sprintf(" SELECT COUNT(ID) AS NB FROM ".mysql_real_escape_string (strip_tags($data_base_postfix))."."mysql_real_escape_string (strip_tags($table_postfix))." WHERE address= '".mysql_real_escape_string (strip_tags($domain.$domain_post_fix))."'");
    $reponse= mysql_query($query,$link2);   
      
      if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    echo $message;
	    return ;
	  }
	  
      // On affiche chaque entrée une à une
	
    if ($donnees = mysql_fetch_assoc($reponse))
	{
	if($donnees['NB']>0)
	  $allready_exists=1;
	}
    
    //On réalise une opération différente en fonction
    //de si le domaine existe 
    if($allready_exists)
    {
    
    echo "Error: postfix_database update not yet supported!\n";
    
    }
    else
    {
  
    $query=sprintf(" INSERT  INTO ".mysql_real_escape_string (strip_tags($table_postfix))."(address,transportation) VALUES('".mysql_real_escape_string (strip_tags($domain.$domain_post_fix))."','".mysql_real_escape_string (strip_tags($postfix_tor_transportation_prefix.":[".$torhidenservice."]"))."')");
    $reponse= mysql_query($query,$link2);   
      
    if (!$reponse) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query. "\n";
	    echo $message;
	    return;
	  }
    
    }
    
}




?>