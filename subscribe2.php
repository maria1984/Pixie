<?php
	header('Access-Control-Allow-Origin: *'); 
	header('Access-Control-Allow-Methods: POST');

	// Put your MailChimp API and List ID hehe
	$api_key = 'c9f4a1e9817e45bf2eaa1421c266ed1d-us14';
	$list_id = '943f6633a1';

	// Let's start by including the MailChimp API wrapper
	include('https://raw.githubusercontent.com/maria1984/Pixie/master/inc/MailChimp.php');
	// Then call/use the class
	use \DrewM\MailChimp\MailChimp;
	$MailChimp = new MailChimp($api_key);

	// Submit subscriber data to MailChimp
	// For parameters doc, refer to: http://developer.mailchimp.com/documentation/mailchimp/reference/lists/members/
	// For wrapper's doc, visit: https://github.com/drewm/mailchimp-api
	$result = $MailChimp->post("lists/$list_id/members", [
							'email_address' => $_POST["email"],
							'merge_fields'  => ['FNAME'=>$_POST["fname"], 'LNAME'=>$_POST["lname"]],
							'status'        => 'subscribed',
						]);

	if ($MailChimp->success()) {
		// Success message
		echo "<h4>Congratulations! An email will be sent to you shortly with your 25% off coupon. Thank you for subscribing to our mailing list.</h4>";
	} else {
		// Display error
		echo $MailChimp->getLastError();
		// Alternatively you can use a generic error message like:
		/*echo "<h4>Please try again.</h4>";*/
	}
?>
