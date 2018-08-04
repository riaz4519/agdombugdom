<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/26/2018
 * Time: 3:17 PM
 */

 function findDay($nextDate){

     $date = new DateTime($nextDate);
     return (strtotime($date->format('Y-m-d'))-strtotime(date('Y-m-d')))/86400;



 }

 function format_date($time_stamp){

     $date = new DateTime($time_stamp);
     return $date->format(' d M Y');

 }

 function sendMessage($phone,$date,$sendType,$name,$counselor_name,$counselor_phone,$time){


     if (strlen(strpos($phone,'+88'))){

         $phone = substr($phone,3);
     }
     if (strlen(strpos($counselor_phone,'+88'))){
         $counselor_phone = substr($counselor_phone,3);
     }


     if ($sendType=="today"){
         $sendType = "you have Appointment Today";
     }
     if ($sendType == "upcoming"){
         $sendType = "You have an Upcoming appointment";

     }
     if ($sendType == "deadline"){
         $sendType = "Your appointment deadline is over ";
     }

     $username = 'admin';
     $password = 'Generic!1234';
     $message ="Dear $name,\n$sendType with immigration specialist.Name:$counselor_name\nNumber:$counselor_phone\nDate:$date time:$time\n@GIC.Address:Address: 1st Floor, Plot 56/b, Road No 132, Gulshan 1, Dhaka 1212";

     $message = urlencode($message);

     $url = "http://gicl.powersms.net.bd/httpapi/sendsms?userId=form_sms&password=gicsms123&smsText=$message&commaSeperatedReceiverNumbers=$phone";

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
     curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
     $response = curl_exec($ch);
     curl_close($ch);
//     echo $phone . ': ';
//     $response = str_replace('Success Count : 1 and Fail Count : 0', 'Sent Successfully!', $response);
//     $response = str_replace('Success Count : 0 and Fail Count : 1', 'Failed!', $response);
//     echo $response . '<br>';
     return "successful";

 }


?>