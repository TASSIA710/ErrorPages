<?php

$error_code = 404;
$error_name = 'Not Found';
$error_client = true;



$error_host = null;
$error_document = 'Not Found';



$error_message = <<<EOT
The resource you tried to access was not found on this server.
It may have either been renamed or deleted, or never existed in the first place.
Sometimes, a 404 error is also thrown if a private resource is trying to be accessed,
to prevent it's existance from being compromised.
EOT;



include(__DIR__ . '/base.php');

?>
