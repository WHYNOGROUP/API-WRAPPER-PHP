# Welcome to WHYNOGROUP API!
Here is a php wrapper allowing a simplified use of your Rest API server hosted by whynogroup.

```php
<?php
  /**
   * First, include this script to your application.
   */
  require_once 'wrapper-php.wng';
  
   /**
    * Instanciate an WNG Client.
    * You can generate new credentials with full access to your account on
    * the token creation page -> [https://api.whyno.group/?new]
    */
   $wng = new wng(
     'api-eu',    // Endpoint of API WNG (List of available endpoints) 
                  // -> http://api.whyno.group/?documentation&endpointList
     'xxxxxxxxxx' // Consumer Key
   );

  /**
   * This API allows you to update your personal information, you can 
   * also use any API in the same way.
   * @return null
   */
   $result = $wng->POST("/me", array(
     "FIRSTNAME"               => "Patrick",
     "LASTNAME"                => "Slown", 
   ));

   /**
    * Return "null" if the request has been fulfilled
    */
    print_r($result);

  /**
   * Another example. You have created an API "/test/time" in order to
   * obtain the unix time from the server. As you wish to obtain 
   * information the method will necessarily be of GET type, example 
   * of use:
   * @return int
   */
   $result = $wng->GET("/test/time");


  /**
   * Returns "1576536041" if the request has been made correctly
   */
   print_r($result);
?›
```

Are you ready?
----------
It's really simple, I explain to you, [ask for a consumer key](https://api.whyno.group/?new), then authenticate you (api.whyno.group/?cas-auth) 
entering your nichandle and your password, press 'login' and then your consumer key is now ready to be used!

What to do next?
----------
Then download this wrapper, and insert in your project folder. Once the client is ready, [explore the list of our API!](https://api.whyno.group/?console)

Pratical Link
----------
 * Documentation: https://api.whyno.group/?docs
 * Console: https://api.whyno.group/?console
 * Create application credentials: https://cas.whyno.group/?new
 * Active your consumer key: https://api.whyno.group/?auth
 * Check if your consumer key work perfectly: https://cas.whyno.group/?check

