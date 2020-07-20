<?php

$error_code = 401;
$error_name = 'Unauthorized';
$error_client = true;



$error_host = null;
$error_document = 'Restricted';



$error_message = <<<EOT
The request has not been applied because it lacks valid authentication credentials for the target resource.
EOT;



include(__DIR__ . '/base.php');

?>
