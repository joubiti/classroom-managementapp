<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$idetudiants=$_POST['idetudiants'];
foreach($_POST['notes'] as $key=>$note_module){
    if($note_module!==''){
        $id=$idetudiants[$key];
        $testemail="SELECT * from notif where id=$id";
        $testquery=pg_query($testemail);
        $testassoc=pg_fetch_assoc($testquery);
        $email=$testassoc['email'];
        $msg= "Un module est affiché sur le site: " . $module ."";
        $mail = new PHPMailer(true);
        $count=pg_num_rows($testquery);
        $test="SELECT * from note_module where id_module=$id_module and id=$id";
        $testquery=pg_query($test);
        $testnumbers=pg_num_rows($testquery);
        if ($testnumbers!=0){
    $depot2="UPDATE note_module SET note_module=$note_module where id_module=$id_module and id=$id";
    $qm2=pg_query($depot2);
    if($count!=0){
        try{
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;  
        $mail->SMTPSecure ='ssl' ;                                //Enable SMTP authentication
        $mail->Username   = 'studentapplicationtest@gmail.com';                     //SMTP username
        $mail->Password   = ')$d\`?3?U,f-YHe2';                               
        $mail->Port       = 465;
        $mail->isHTML();
        $mail->setFrom('studentapplicationtest@gmail.com');
        $mail->Subject='Note de module';
        $mail->Body=$msg;
        $mail->addAddress($email);
        $mail->Send();
        }
        catch (Exception $e){
            header('location: panelprof.php');
        }
    }
    }
        else{
        $sqlnote="INSERT into note_module(id_module,id,note_module) VALUES($id_module,$id,$note_module)";
        $sqlr=pg_query($sqlnote);
        if($count!=0){
        try{
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;  
        $mail->SMTPSecure ='ssl' ;                                //Enable SMTP authentication
        $mail->Username   = 'studentapplicationtest@gmail.com';                     //SMTP username
        $mail->Password   = ')$d\`?3?U,f-YHe2';                               
        $mail->Port       = 465;
        $mail->isHTML();
        $mail->setFrom('studentapplicationtest@gmail.com');
        $mail->Subject='Note de module';
        $mail->Body=$msg;
        $mail->addAddress($email);
        $mail->Send();
        }
        catch (Exception $e){
            header('location: panelprof.php');
        }
    }
        }
    }
}
}
?>