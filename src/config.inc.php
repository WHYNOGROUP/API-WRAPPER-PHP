<?php

  $as = "my_application_secret";
  $ak = "my_application_key";
  $ck = "my_consumer_key";
  $en = "https://api-eu.las2pizz.fr"

  $wng = new wng($ak, $as, $en, $ck);

  $res = $wng->get('/');

  print_r($res);

?>
