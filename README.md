# Welcome to WHYNOGROUP API!
PHP wrapper for WNG APIs. That's the easiest way to use WNG APIs in your PHP applications.

```php
<?php
/**
 * If you don't have a consumer key, please 
 * go on https://cas.whyno.group/request_credential
 * else, please insert your consumer key in init.php file
 */

require 'required/init.php';

// Get your name
echo "Welcome " . $wng->get('/manager/me')['return']['firstname'];
?>
```

Are you ready?
----------
It's really simple, I explain to you, [ask for a consumer key](https://cas.whyno.group/request_credential), then authenticate you to the [C.A.S](https://cas.whyno.group/) (secure authentication center),
entering your nicHandle and your password, press 'login' and then your consumer key is now ready to be used!

What to do next?
----------
Then download this API client, and insert in your project folder. Once the client is ready, [explore the list of our API!](https://api.whyno.group/console/)

Pratical Link
----------
 * Documentation: https://api.whyno.group/docs/
 * Console: https://api.whyno.group/console/
 * Create application credentials: https://cas.whyno.group/request_credential
 * Active your consumer key: https://cas.whyno.group/
 * Check if your consumer key work perfectly: https://cas.whyno.group/check_credential
