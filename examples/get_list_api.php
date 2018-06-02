<?php

require '../required/wng.class.php';

// Initialize a new instance
$wng = new wng("your_consumer_key");

// Get list of api
$result = $wng->get('/');

echo '<pre>';
print_r($result);

?>
