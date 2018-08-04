<?php
session_start();
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2018
 * Time: 9:24 PM
 *
 * if
 *
 */






if (!isset($_SESSION['id'])){
    header('Location: login.php');

}



?>
<?php include "connect.php"; ?>
<?php  include 'function.php';?>

<?php

if (isset($_POST['send'])){

    $user_id_counselor = $_SESSION['id'];

    $counselor_info_sql="select * from user WHERE id='$user_id_counselor'";

    if ($counsellor = $connect->query($counselor_info_sql)){

        $counsellor_data = $counsellor->fetch_assoc();
        $counsellor_name = $counsellor_data['name'];
        $counsellor_phone = $counsellor_data['phone'];

    }

    $phone = $_POST['phone'];
    $appoint_date = $_POST['date'];
    $send_type="upcoming";
    $name = $_POST['first_name'];
    $time = $_POST['time'];

    $response = sendMessage($phone,$appoint_date,$send_type,$name,$counsellor_name,$counsellor_phone,$time);



}


?>

<?php include 'header.php';?>



    <div class="container ">


    <!--area for appointed todays client-->
    <div class="row d-flex justify-content-center">
        <div class="col-md-5 col-12">

            <div class="card">
                <div class="card-header text-center">
                   Upcoming  Appointment
                </div>
                <div class="card-body">

                    <table class=" table table-hover">

                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Details</th>
                            <th scope="col">Message</th>

                        </tr>

                        </thead>
                        <tbody>
                        <?php
                        $todays_date = date('Y-m-d');
                        $user_id = $_SESSION['id'];
                        $sql= "select * from client_info WHERE  user_id='$user_id'";


                        if ( $data = $connect->query($sql))
                        {

                            foreach ($data as $key1=>$row)
                            {

                                $day_left= findDay($row['date']);

                                if ($day_left >=1){


                                ?>

                                <tr >
                                    <td><?php echo $row['first_name']; ?> </td>
                                    <td><a  style="color: white;" class="btn btn-success btn-sm"  data-toggle="modal"  data-target="#exampleModal<?php echo $key1 ?>">Details</a></td>
                                    <td>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <input type="text" hidden name="phone" value="<?php echo $row['phone'];?>">
                                            <input type="text" hidden name="date" value="<?php echo $row['date'];?>">
                                            <input type="text" hidden name="time" value="<?php echo $row['time'];?>">
                                            <input type="text" hidden name="first_name" value="<?php echo $row['first_name'];?>">

                                           <input type="submit" class="btn btn-success btn-sm" name="send" value="Message">

                                        </form>

                                    </td>
                                    <div class="modal fade" id="exampleModal<?php echo $key1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel" > Info of <?php echo $row['first_name']?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">

                                                    <p><b>Name:</b> <?php echo $row['first_name']." ".$row['last_name'];?> <b>Phone:</b> <?php echo $row['phone']?></p>

                                                    <p><b>Age:</b> <?php echo $row['age']?> <b>Education:</b> <?php echo $row['education']?></p>
                                                    <p><b>Data Type :</b> <?php echo $row['data_type']?> years</p>

                                                    <p><b>Work Experience :</b> <?php echo $row['work']?> years</p>

                                                    <p><b>Register Date:</b> <?php echo format_date($row['data_input'])?> </p>
                                                    <p><b>Last Contact:</b> <?php echo format_date($row['last_contact'])?></p>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </tr>

                                <?php
                                }
                            }

                        }

                        ?>
                        </tbody>

                    </table>

                </div>


            </div>

        </div>

    </div>
    <!--end area for appointed todays   client-->








    <?php include 'jquery.php';?>


    <script>



    </script>
    <script src="call.js"></script>

<?php include 'footer.php';?>