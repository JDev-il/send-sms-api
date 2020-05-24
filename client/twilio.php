<?php 
    
    $customer_number;
    $country;
    $message;
    $tonum;
    $msg;
    $error;

    $GLOBALS['msg'] = '';
    $GLOBALS['error'] = '';
    $GLOBALS['status'] = '';
    $GLOBALS['twilio_number'] = '';


    require './vendor/autoload.php';
    use Twilio\Rest\Client;

    function runTwilio($tonum, $message){
        try {
            $account_sid = 'AC2a2a94e415b300b98e8fdb1ded2e5333';
            $auth_token = '7e246a656941c285d32f472ccc57c3be';
            
            $twilio_number = "+12067373827";
            $GLOBALS['twilio_number'] = $twilio_number;
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $tonum,
                array(
                    "from" => $twilio_number,
                    "body" => "Thank you for using the 'SMS System' Created by Jonathan Daniel!" . "\n" . "Here is your message:" . "\n $message",
                )
            );        

            // MySQL - Success //
            include '../server/db/connection.php';

            $GLOBALS['status'] = "success";
                    
            $success_sql = "INSERT INTO `sms_success` (`fromnum`, `tonum`, `message`, `status`)
            VALUES ('" . $GLOBALS['twilio_number'] . "', '$tonum', '$message', '" . $GLOBALS['status'] . "')";
            if ($conn->query($success_sql) === TRUE) {
                $msg = "The message has been sent successfully!";
                $GLOBALS['msg'] = $msg;
                }
            // MySQL - Success //

        } catch (Exception $e) {
            include '../server/db/connection.php';

            // MySQL - Fail //
            $GLOBALS['status'] = "fail";
                        
            $fail_sql = "INSERT INTO `sms_fails` (`fromnum`, `tonum`, `message`, `status`)
            VALUES ('" . $GLOBALS['twilio_number'] . "', '$tonum', '$message', '" . $GLOBALS['status'] . "')";
            if ($conn->query($fail_sql) === TRUE) {
                $error = "The number you provided ($tonum) is invalid, please try again!";
                $GLOBALS['error'] = $error;            
            } 
            // MySQL - Fail //
        }
    }


    if(isset($_POST['submit'])) {
            $customer_number = $_POST['tonum']; 
            $country = $_POST['countrycode'];
            $message = $_POST['message'];
            $tonum = $country . $customer_number;

            $newmsgarr = Array();
            $newStrMsg = '';

            $array = str_split($_POST['message']);        
            foreach($array as $char){
                if (!preg_match('/[\']/', $char))
                {
                    $newmsgarr[] = $char;
                }
            }        
            $message = (implode("", $newmsgarr));
            runTwilio($tonum, $message);  
                  
    };

?>