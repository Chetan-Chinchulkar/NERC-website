<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
 require 'PHPMailer-master/src/Exception.php';
 require 'PHPMailer-master/src/PHPMailer.php';
 require 'PHPMailer-master/src/SMTP.php';


    

    








//---------------TEST SERVER CODE START------------- - DONT SEND EMAIL-----------------COMMENT IT BEFORE MAKING LIVE----------//






/*function sendEmailS($name,$email,$pwd){
         echo 'done';
      }
*/







//----------------------TEST SERVER CODE ENDS------------PRODUCTION SERVER START-----------------UNCOMMENT BEFORE LIVE-------------------//





function sendEmailS($conn,$name,$email,$regNum){

        //$user = retrieveUser($conn,$regNum);
        //foreach($user as $key=>$value){

                 $mail = new PHPMailer(true);
                //Tell PHPMailer to use SMTP
                $mail->isSMTP();
                //Enable SMTP debugging
                //SMTP::DEBUG_OFF = off (for production use)
                //SMTP::DEBUG_CLIENT = client messages
                //SMTP::DEBUG_SERVER = client and server messages
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                //Set the hostname of the mail server
                $mail->Host = 'smtp-mail.outlook.com';
                //Set the SMTP port number - likely to be 25, 465 or 587
                $mail->Port = 587;
                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;
                //Username to use for SMTP authentication
                $mail->Username = 'nerc@iitg.ac.in';
                //Password to use for SMTP authentication
                $mail->Password = 'Research@Conclave';
                //Set who the message is to be sent from
                $mail->setFrom('nerc@iitg.ac.in', 'North-East Research Conclave 2022');
                //Set an alternative reply-to address
                $mail->addReplyTo('nerc@iitg.ac.in', 'North-East Research Conclave 2022');
                //Set who the message is to be sent to
                $mail->addAddress($email, $name);
                $mail->addCC('nerc@iitg.ac.in', 'North-East Research Conclave 2022');
                //Set the subject line
                $mail->Subject = 'Acknowledgement for Registering in North-East Research Conclave-2022';
                $content="
                <p style='font-size:12pt;font-family:'Times New Roman',serif;text-align:justify;'>
                Dear ".$name.",<br/><br/>

                Thank you for registering in North-East Research Conclave. Your registration No. is: ".$regNum.".<br/>
                For any future correspondence, please write to NERC Secretariat (nerc@iitg.ac.in) quoting your registration number.<br/><br/>


         

                With Regard,<br/>

                NERC Secretariat<br/>

                IIT Guwahati <br/><br/>
                        </p>
                        ";


                $mail->msgHTML($content); 
                $mail->AltBody = 'This is a plain-text message body';

                //send the message, check for errors
                if (!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message sent!';
                }

       //     }
      }






?>