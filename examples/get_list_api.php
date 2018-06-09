<?php

require '../required/init.php';

// Get list of api
$result = $wng->get('/');

echo '<pre>';
print_r($result);

?>
