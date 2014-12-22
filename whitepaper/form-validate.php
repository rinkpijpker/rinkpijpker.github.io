<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Whitepaper formulier</title>
</head>
<body>
<?php 
	$email = $_POST['user-email'];

	include('mailchimp.php'); 

	$MailChimp = new \Drewm\MailChimp('d5598bd613ffadfd0410e503a1b7b633-us8');
	$result = $MailChimp->call('campaigns/create', array(
       'id'					=> '514105',
       'email'				=> $email,
       'double_optin'		=> false
    ));
?>
</body>
</html>
