<?php

require '../required/wng.class.php';

// Initialize a new instance
$wng = new wng("your_consumer_key");

// Get your ticket
$result = $wng->get('/support/ticket');

echo '<pre>';
print_r($result);

?>
