<?php

$error_code = 402;
$error_name = 'Payment Required';
$error_client = true;



$error_host = null;
$error_document = 'Restricted';



$error_message = <<<EOT
Officially, this error code is reserved for future use.
<br><br>
Otherwise, this might indicate that you haven't yet received access for the given resource.
Access may be received against payment.
EOT;



include(__DIR__ . '/base.php');

?>
