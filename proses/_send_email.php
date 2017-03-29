<?php
	require '../../PHPMailer/PHPMailerAutoload.php';
/*
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'febra.dev@gmail.com';              // SMTP username
	$mail->Password = 'dcs12345';                         // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('blkdemak@gmail.com', 'BLK Demak');
	$mail->addAddress('m.febras@yahoo.com', 'Febra');     				  // Add a recipient
	$mail->addAddress('ellen@example.com');               // Name is optional
	$mail->addReplyTo('info@example.com', 'Information');
	$mail->addCC('cc@example.com');
	$mail->addBCC('bcc@example.com');

	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Konfirmasi Email';
	$mail->Body    = 'Untuk <br> Tes';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}
*/

	function send_email($emailPenerima, $namaPenerima, $subyek, $pesanEmail, $pesanSukses){
		$mail = new PHPMailer;

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'febra.dev@gmail.com';              // SMTP username
		$mail->Password = 'dcs12345';                         // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('blkdemak.dev@gmail.com', 'BLK Demak');
		$mail->addAddress($emailPenerima, $namaPenerima);     // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subyek;
		$mail->Body    = $pesanEmail;
		$mail->AltBody = 'Jika Anda tidak mendapatkan link, silakan hubungi Kantor BLK melalui email atau telepon.';

		if(!$mail->send()) {
			$_SESSION['error'] = "Pesan tidak dapat dikirim<br>
									Mailer Error: " . $mail->ErrorInfo;
		}
		else {
		    $_SESSION['success'] = $pesanSukses;
		}
	}