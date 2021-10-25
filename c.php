<?php 

require ',,/PHPMailer/src/mailconfig.php';
                        
                        $mail->AddAddress("brown.cnk@gmail.com");
                        $mail->Subject = "SITE MESSAGE";
                        $mail->Body = "lol";
                        
                        $result= $mail->send();
                        if(!$result){
                            echo 'no';
                            echo $mail->Error;
                        }
                        
                        ?>