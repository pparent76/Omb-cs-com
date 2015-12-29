#include "request.h"
#include <string.h>

int omb_remaing_credit(char cookie[10000])
{

}

void omb_request_domain_name(char domain[256], char cookie[10000])
{

   CURLcode res;
   char URL[1024]="";
   strcat(URL,OMB_SERVER_ADRR);
   strcat(URL,"/");    
   strcat(URL,OMB_PAGE_REQUEST_DOMAIN);
   strcat(URL,"?domain="); 
   strcat(URL,domain);      
   
   printf("%s\n",URL);
   
    curl_easy_setopt(curl, CURLOPT_URL, URL);
    curl_easy_setopt(curl, CURLOPT_COOKIE, cookie); 
   curl_easy_setopt(curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    curl_easy_setopt(curl, CURLOPT_PROXY, "localhost:9050"); 
  /* Perform the request, res will get the return code */ 
    res = curl_easy_perform(curl);
    /* Check for errors */ 
    if(res != CURLE_OK)
      fprintf(stderr, "curl_easy_perform() failed: %s\n",
              curl_easy_strerror(res));
 
    /* always cleanup */ 
    curl_easy_cleanup(curl);
    
}

void omb_request_init()
{
  
   
  curl_global_init(CURL_GLOBAL_DEFAULT);
  curl = curl_easy_init();

}
