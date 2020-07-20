<?php

$error_code = 400;
$error_name = 'Bad Request';
$error_client = true;



$error_host = null;
$error_document = 'Error';



$error_message = <<<EOT
The server cannot or will not process your request due to something that is perceived to be a client error
(e.g., malformed request syntax, invalid request message framing, or deceptive request routing).
EOT;



include(__DIR__ . '/base.php');

?>
