<?php

require 'required/wng.class.php';

// Initialize a new instance
$wng = new wng("your_consumer_key");

// Get your personnal informations
$result = $wng->get('/manager/me');

echo '<pre>';
print_r($result);

?>
