<?php
include(__DIR__ . '/cf_datacenters.php');

$system_administrator = 'sysadmin@tassia.net';
$use_cloudflare = isset($_SERVER['HTTP_CF_RAY']);
?>

<!DOCTYPE html>
<html>

	<head>
		<title><?= $error_code; ?> - <?= $error_name; ?></title>

		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">

		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>



		<script type="text/javascript">
			window.addEventListener('load', function() {
				var heightA = document.getElementById('header').scrollHeight;
				var heightB = document.getElementById('content').scrollHeight;
				var heightC = document.getElementById('information').scrollHeight;
				document.getElementById('footer').style.minHeight = "calc(100vh - " + (heightA + heightB + heightC) + "px)";
			});
		</script>



		<style type="text/css">
			@import url('https://fonts.googleapis.com/css?family=Nunito');

			:root {
				--background1: #e8e8e8;
				--background2: #f8f8f8;

				--shadow-light: rgba(63, 63, 63, 63);
				--shadow: rgb(63, 63, 63);
				--shadow-strong: black;

				--theme: #007bff;
			}

			body.error_page {
				background: var(--background1);
				font-family: 'Nunito';
			}

			#header {
				position: relative;
				background: var(--background2);
				box-shadow: 0 0 4px var(--shadow);
			}

			#header .code, #header .name {
				margin: 0;
				padding: 0;
			}

			#header .code {
				color: #000;
				font-size: 72px;
			}

			#header .name {
				color: #777;
				font-size: 32px;
				margin-top: -16px;
			}

			#content {
				text-align: center;
				padding: 4em 10%;
				color: #444;
				display: grid;
				grid-template-columns: repeat(<?= $error_document == null ? '5' : '7'; ?>, auto);
			}

			#content i {
				font-size: 96px;
			}

			#content i.fa-check-circle, #content i.fa-times-circle, #content i.fa-minus-circle {
				font-size: 48px;
				margin-top: -32px;
				background: radial-gradient(circle, var(--background1) 50%, rgba(0,0,0,0) 51%, rgba(0,0,0,0) 100%);;
			}

			#content i.fa-check-circle {
				color: #88cc2e;
			}

			#content i.fa-times-circle {
				color: #e74c3c;
			}

			#content i.fa-minus-circle {
				color: #7dbde8;
			}

			#content i.fa-arrows-alt-h {
				color: #777;
			}

			#content div .name {
				margin-top: 16px;
				font-size: 16px;
			}

			#content div .type {
				font-size: 21px;
				color: #888;
				margin: 0;
			}

			#content div .state {
				font-size: 19px;
				margin: 0;
				margin-top: -4px;
			}

			#content div .state.working {
				color: #88cc2e;
			}

			#content div .state.error {
				color: #e74c3c;
			}

			#content div .state.misc {
				color: #7dbde8;
			}

			#footer {
				background: var(--background2);
				box-shadow: 0 0 4px var(--shadow);
				color: #777;
				font-size: 18px;
			}

			#footer div {
				border: 1px solid var(--background1);
				padding: 1em;
				border-radius: 8px;
			}

			#information {
				background: var(--background2);
				text-align: center;
				color: #777;
				font-size: 18px;
				font-family: monospace;
			}

			#header, #footer, #information {
				padding: 2em 20%;
			}
		</style>
	</head>

	<body class="error_page">

		<div id="header">
			<p class="code">Error <?= $error_code; ?></p>
			<p class="name"><?= $error_name; ?></p>
		</div>

		<div id="content">
			<div>
				<i class="fas fa-desktop"></i><br>
				<i class="fas fa-check-circle"></i>
				<p class="name">You</p>
				<p class="type">Browser</p>
				<p class="state working">Working</p>
			</div>
			<i class="fas fa-arrows-alt-h"></i>
			<?php if ($use_cloudflare) { ?>
				<div>
					<i class="fas fa-cloud"></i><br>
					<i class="fas fa-check-circle"></i>
					<p class="name"><?php
						$dc_id = preg_replace('([a-zA-Z0-9]+\-)', '', $_SERVER['HTTP_CF_RAY']);
						if (isset(DATA_CENTERS[$dc_id])) {
							echo DATA_CENTERS[$dc_id];
						} else {
							echo $dc_id;
						}
					?></p>
					<p class="type">CloudFlare</p>
					<p class="state working">Working</p>
				</div>
			<?php } else { ?>
				<div>
					<i class="fas fa-cloud"></i><br>
					<i class="fas fa-minus-circle"></i>
					<p class="name">&ensp;</p>
					<p class="type">CloudFlare</p>
					<p class="state misc">Bypassed</p>
				</div>
			<?php } ?>
			<i class="fas fa-arrows-alt-h"></i>
			<?php if ($error_host != null) { ?>
				<div>
					<i class="far fa-hdd"></i><br>
					<i class="fas fa-times-circle"></i>
					<p class="name"><?= $_SERVER['SERVER_NAME']; ?></p>
					<p class="type">Host</p>
					<p class="state error"><?= $error_host; ?></p>
				</div>
			<?php } else { ?>
				<div>
					<i class="far fa-hdd"></i><br>
					<i class="fas fa-check-circle"></i>
					<p class="name"><?= $_SERVER['SERVER_NAME']; ?></p>
					<p class="type">Host</p>
					<p class="state working">Working</p>
				</div>
			<?php } ?>
			<?php if ($error_document != null) { ?>
				<i class="fas fa-arrows-alt-h"></i>
				<div>
					<i class="fas fa-file"></i><br>
					<i class="fas fa-times-circle"></i>
					<p class="name"><?= substr($_SERVER['REQUEST_URI'], 1); ?></p>
					<p class="type">Resource</p>
					<p class="state error"><?= $error_document; ?></p>
				</div>
			<?php } ?>
		</div>

		<div id="footer">
			<div>
				<?= $error_message; ?>
				<br><br>
				<?php if ($error_client) { ?>
					If you believe this is an error, please contact the <a href="mailto:<?= $system_administrator; ?>">System Administrator.</a>
				<?php } else { ?>
					If this error persists, please contact the <a href="mailto:<?= $system_administrator; ?>">System Administrator.</a>
				<?php } ?>
			</div>
		</div>

		<div id="information">
			<?= $_SERVER['SERVER_SOFTWARE'] . ' @ :' . $_SERVER['SERVER_PORT']; ?>
			<?php if ($use_cloudflare) { ?>
				&ensp;&vert;&ensp;
				<?= 'Ray ID: ' . $_SERVER['HTTP_CF_RAY']; ?>
			<?php } ?>
			&ensp;&vert;&ensp;
			<?= date('c'); ?>
		</div>

	</body>
</html>
