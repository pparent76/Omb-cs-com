<?php

function dns_update_domain($domain,$torhidenservice)
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
    touch($domain);
    file_put_contents($domain,"prereq nxdomain _tormx.".$domain.$domain_post_fix."\n".
		      "update add _tormx.".$domain.$domain_post_fix." 300 IN TXT \"".$torhidenservice."\"\n\n"); 
     exec("nsupdate ".$domain);
     unlink($domain);
    
}




?>