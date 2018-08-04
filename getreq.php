<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2018
 * Time: 11:45 AM
 */
include 'connect.php';
?>

<?php

if (isset($_GET['first_name']) && $_GET['last_name'] && $_GET['phone']) {
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $email = $_GET['email'];
    if (empty($email)){
        $email = 'not given';
    }
    $phone = $_GET['phone'];
    $address = $_GET['address'];
    if (empty($address)){
        $address = 'not given';
    }
    $city = $_GET['city'];
    if (empty($city)){
        $city = 'not given';
    }
    $work =  $_GET['work'];
    if (empty($work)){
        $work = 'not given';
    }
    $education =  $_GET['education'];
    if (empty($education)){
        $education = 'not given';
    }
    $data_type =  $_GET['data_type'];
    if (empty($data_type)){
        $data_type = 'not given';
    }
    $age =  $_GET['age'] ;
    if (empty($age)){
        $age = 0;
    }

    $getting_the_last_id = "select user_id,phone from client_info ORDER by id DESC LIMIT 1";
    $data = $connect->query($getting_the_last_id);

//    user last id

    if ($data->num_rows > 0){

        $data = $data->fetch_assoc();

        $sql_user_count = "select id from user";

        if($count = $connect->query($sql_user_count)->num_rows){

            $number_of_user = $count;

        }


        if ($data['user_id'] >= $number_of_user){
           $user_id = 1;
        }else{
            $user_id = $data['user_id'];
            $user_id = $user_id+1;
        }
    }
    else{
        $user_id = 1;
    }




    $query = "INSERT into client_info(first_name,last_name,email,phone,address,city,work,education,age,data_type,user_id)VALUES ('$first_name','$last_name','$email','$phone','$address','$city','$work','$education','$age','$data_type','$user_id')";

    if ($connect->query($query)) {
        echo '<div class="alert alert-success">Thank You! I will be in touch</div>';
    } else {
        echo '<div class="alert alert-danger">Data Already exist</div>';

    }
}
else{
    echo "data insert wrongly";
}





?>
<?php


?>
