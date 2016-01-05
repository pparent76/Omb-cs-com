#include "request.h"

main()
{
  omb_request_init();
//  omb_request_domain_name("test","ID=03; passphrase=pierre;");
  omb_inform_tor_hidden_service("test.onion","ID=03; passphrase=pierre;");
  omb_request_end();
}