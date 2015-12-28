#include "request.h"

main()
{
  omb_request_init();
  omb_request_domain_name("test","ID=03; passphrase=pierre;");
  
}