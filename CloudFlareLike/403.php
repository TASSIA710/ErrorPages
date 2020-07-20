<?php

$error_code = 403;
$error_name = 'Forbidden';
$error_client = true;



$error_host = null;
$error_document = 'Restricted';



$error_message = <<<EOT
The server understood your request but refuses to authorize it.
<br><br>
Maybe you aren't logged in, or you are logged in but don't have enough access?
Or you are logged in and try to access a feature only available to guests (e.g. login).
EOT;



include(__DIR__ . '/base.php');

?>
