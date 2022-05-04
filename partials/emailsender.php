<?php 
try{
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;  
		$mail->SMTPSecure ='ssl' ;                                //Enable SMTP authentication
		$mail->Username   = $usernamemail;                     //SMTP username
		$mail->Password   = $passwordmail;                               
		$mail->Port       = 465;
		$mail->isHTML();
		$mail->setFrom($usernamemail);
		$mail->Subject='Note de module';
		$mail->Body=$msg;
		$mail->addAddress($email);
		$mail->Send();
		}
		catch (Exception $e){
			header('location: fiche.php?id='.$id);
		}
?>