

<?php  session_start(); ?>

<?php

if (!isset($_SESSION['admin_id'])){
    header('Location: login.php');
}

?>

<?php

include "../connect.php";

?>

<?php


if (isset($_POST['type'])){

    if ($_POST['name'] && $_POST['phone'] && $_POST['email'] && $_POST['password']){


        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $query ="INSERT into user(name,email,phone,password)VALUES ('$name','$email','$phone','$password')";

        if ($connect->query($query)){

            echo json_encode(array("status"=>true));
        }


    }
}


if ($_GET['type'] == 'get'){

    $query_data = "SELECT * FROM user";

    if ($data = $connect->query($query_data)){


        if ($data->num_rows > 0){

            $i= 0;
            $output = '';
            while ($row = $data->fetch_assoc()){

                $output .= '
                           <tr>
                           <th scope="row">' . ++$i . '</th>
                            <td>' . $row["name"]. '</td>
                            <td>' . $row["email"] . '</td>
   
                           </tr>
                          ';


            }

            echo $output;




        }
    }

}