<?php
$to = 'matt@wiredground.com,josh@milesdesign.com,karen@corsarogroup.com,jlong@smarterhq.com,mtyner@smarterhq.com,ctruex@smarterhq.com';

$headers = 'From: Smarter Remarketer <learnmore@smarterremarketer.com>' . "\r\n" .
            'Reply-To: Smarter Remarketer <learnmore@smarterremarketer.com>' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
date_default_timezone_set('America/Indianapolis');
 
?>





<?php

// Define some constants
$RECIPIENT_NAME = "SR";
$EMAIL_SUBJECT = $_POST['subject'];

$PHP_EOL = "\r\n";

// Read the form values
$success = false;
$doc = $_POST['doc'];
$senderFirstName = isset( $_POST['your-first-name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['your-first-name'] ) : "";
$senderLastName = isset( $_POST['your-last-name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['your-last-name'] ) : "";
$senderEmail = isset( $_POST['your-email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['your-email'] ) : "";
$senderOrganization = isset( $_POST['your-organization'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['your-organization'] ) : "";
$senderPhone = isset( $_POST['your-phone'] ) ? preg_replace( "/[^\.\-\' 0-9]/", "", $_POST['your-phone'] ) : "";
$message = isset( $_POST['your-comments'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['your-comments'] ) : "";

// assemble message
$mymessage = 'Name: ' . $senderFirstName . " " . $senderLastName . $PHP_EOL . 'Email: ' . $senderEmail . $PHP_EOL . 'Organization: ' . $senderOrganization . $PHP_EOL . 'Document: ' . $doc . $PHP_EOL . 'Phone: ' . $senderPhone . $message;

// If all values exist, send the email
if ( $senderFirstName && $senderLastName && $senderEmail && $senderOrganization && $senderPhone ) {
  $success = mail( $to, $EMAIL_SUBJECT, $mymessage, $headers );
  
	$to = $_POST['your-email'];
	
	$subject = 'Thank You from Smarter Remarketer';
	
	
	$headers = "From: Smarter Remarketer <learnmore@smarterremarketer.com>" . "\r\n";
	$headers .= "Reply-To: Smarter Remarketer <learnmore@smarterremarketer.com>" . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	
	$message = '<html>';
	$message .= '<style type="text/css">
	body { background-color:#F0F0F0; }
	.wrapper { width:100% background:#f0f0f0; padding:20px; }
	.inner { width:600px; margin:auto; }
	.logo { width:190px; padding-right:30px; }
	.logo img { display:block; padding-bottom:10px; }
	.copy { width:380px; padding:20px; }
	h1 { font-family:arial, sans-serif; color:#333; font-size:18px; font-weight:bold; padding-bottom:10px; padding-top:15px; }
	p { font-family:arial, sans-serif; font-size:12px; color:#666666; line-height:140%; }
	.copy-container { border:1px solid #A5A4A4; background:#fff; }
	</style>';
	$message .= '<body>';
	$message .= '
		<table border="0" cellpadding="0" cellspacing="0" align="center" class="wrapper">
			<tr>
				<td>
				
					<table border="0" cellpadding="0" cellspacing="0" align="center" width="600">
						<tr>
							<td class="logo" valign="top"><img src="http://www.smarterremarketer.com/wp-content/themes/smarterremarketer/images/logo.png" width="190" height="68" alt="Smarter Remarketer Logo" /></td>
						</tr>
					</table>
					
					<table border="0" cellpadding="0" cellspacing="0" align="center" width="600" class="copy-container">
						<tr>
							<td class="copy" valign="top">
								<h1>Thank you for your interest in<br />Smarter Remarketer</h1>
								<p>Someone will be in contact with you shortly.</p>
								<p>Please feel free to contact us at 1-800-913-9559 if you have any questions.</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
	$message .= '</body></html>';
	mail($to, $subject, $message, $headers);
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
 	echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Thank you.</p><p>Your download will begin shortly.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>


