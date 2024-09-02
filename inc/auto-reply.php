
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