<?php

require '../required/init.php';

// Get your ticket
$result = $wng->get('/support/ticket');

echo '<pre>';
print_r($result);

?>
