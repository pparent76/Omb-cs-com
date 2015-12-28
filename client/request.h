#include <curl/curl.h>

#define OMB_SERVER_ADRR "https://www.own-mailbox.com/proxy/"
#define OMB_PAGE_REQUEST_DOMAIN "request_domain.php"

CURL *curl;
  
void omb_request_init();
void omb_request_domain_name(char domain[256], char cookie[10000]);
int omb_remaing_credit(char cookie[10000]);