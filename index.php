<?php
session_start();
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2018
 * Time: 12:54 PM
 */
include 'connect.php';
include 'function.php';

if (!isset($_SESSION['id'])){
    header('location: login.php');
}



?>

<?php

$user_id_session = $_SESSION['id'];
$current_date = date("Y-m-d");



$check_date = "select * from sent_message WHERE user_id ='$user_id_session' AND date = CURRENT_DATE ";

$user_info = "select * from user where id = '$user_id_session'";

if ($data_user = $connect->query($user_info)->fetch_assoc()){

    $user_name =  $data_user['name'];
    $user_phone = $data_user['phone'];

}

if ($connect->query($check_date)->num_rows ==0){


    $query = "select * from client_info WHERE user_id ='$user_id_session'";

    if ($data_client = $connect->query($query)){


        foreach($data_client as $client){
            if (!empty($client['date'])){

                if (findDay($client['date'])==0){

                    $client_phone = $client['phone'];
                    $client_name = $client['first_name'];
                    $appoint_date = $client['date'];
                    $appoint_time = $client['time'];
                    $sendType = "today";

                    sendMessage($client_phone,$appoint_date,$sendType,$client_name,$user_name,$user_phone,$appoint_time);


                }
                if (findDay($client['date'])==2 || findDay($client['date'])==3){

                    $client_phone = $client['phone'];
                    $client_name = $client['first_name'];
                    $appoint_date = $client['date'];
                    $appoint_time = $client['time'];
                    $sendType = "upcoming";

                    sendMessage($client_phone,$appoint_date,$sendType,$client_name,$user_name,$user_phone,$appoint_time);


                }

            }



        }
        $sql_confirm = "insert into sent_message(date,sent,user_id)VALUES (CURRENT_DATE ,TRUE ,$user_id_session)";
        if ($connect->query($sql_confirm)){
            echo "uploaded";
        }




    }



}




?>




<?php


if (isset($_POST['answer'])){


        $id = $_POST['id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $user_id = $_SESSION['id'];


    $answer = $_POST['answer'];
   if ($answer=='Appointed'){
       $sql1 = "select serial from client_info ORDER BY serial DESC LIMIT 1";
       $data = $connect->query($sql1)->fetch_assoc();
       $serial = $data['serial'] + 1;

   $sqql = "update client_info set contacted=TRUE ,appointed=TRUE,date='$date',time='$time',user_id='$user_id',appointed_date=CURRENT_DATE,last_contact=CURRENT_DATE WHERE id='$id'";
   if ($connect->query($sqql)){
       echo '<h5 class="alert alert-success text-center"> Updated</h5>';
   }

   }
   if ($answer == "not interested"){
       $sql1 = "select serial from client_info ORDER BY serial DESC LIMIT 1";
       $data = $connect->query($sql1)->fetch_assoc();
       $serial = $data['serial'] + 1;

       $sqql = "update client_info set contacted=TRUE,last_contact=CURRENT_DATE,status=3,serial='$serial' WHERE id='$id'";
       if ($connect->query($sqql)){
           echo '<h5 class="alert alert-success text-center"> Updated</h5>';
       }
   }
    if ($answer == "ignore"){
        $sql1 = "select serial from client_info ORDER BY serial DESC LIMIT 1";
        $data = $connect->query($sql1)->fetch_assoc();
        $serial = $data['serial'] + 1;

        $sqql = "update client_info set notreceive=TRUE , serial='$serial' WHERE id='$id'";
        if ($connect->query($sqql)){
            echo '<h5 class="alert alert-success text-center"> Updated</h5>';
        }
    }


}


?>

<?php  include 'header.php'?>
    <div class="row d-flex justify-content-center">
        <div class="card card-header car border-danger">
    <?php
        $month = date('Y-m');
        $today = date('Y-m-d');
        $slq_target_month = "select * from target where month like '%$month%'";

        $target = $connect->query($slq_target_month)->fetch_assoc();

        $user_id = $_SESSION['id'];

        $fullfiled_sql = "select date from client_info where appointed_date like '%$month%' and user_id = '$user_id'";

        $number_of_appointment  = $connect->query($fullfiled_sql)->num_rows;

        $sql_today = "select * from client_info where appointed_date like '%$today%' AND appointed = TRUE";

        $number_of_appointment_today = $connect->query($sql_today)->num_rows;
        $number_of_appointment_today;

    ?>
           <p class="font-weight-bold">This month Target: <?php echo $target['target']; ?>  | Full filled: <?php echo $number_of_appointment;?> |Today : <?php echo $number_of_appointment_today?></p>


        </div>


    </div>
    <div class="row d-flex justify-content-center mt-3">

     <div class="col-md-5 ">

         <div class="form-group">
             <div class="input-group">

                 <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
             </div>
         </div>
         <div id="result"></div>

         <div class="card m-b-30">
             <div class="card-header">
                 <h4 class="mt-0 header-title d-flex justify-content-center text-info">New CLIENT LIST</h4>
             </div>
             <div class="card-body">

                 <table class="table">
                     <thead class="thead-default">
                     <tr>

                         <th>Name</th>
                         <th>Call</th>

                     </tr>

                     </thead>

                     <tbody>

                     <?php
                     $user_id_main = $_SESSION['id'];
                     $query = "select * from client_info WHERE appointed=0 AND contacted=0 AND user_id = '$user_id_main'ORDER BY serial ASC ";
                     if ($data = $connect->query($query)){

                         foreach ($data as $key=>$row) {

                             ?>

                             <tr>

                                 <td><?php echo $row['first_name']?></td>
                                 <td><a class="btn btn-outline-dark text-info" data-toggle="modal" onclick='call("<?php echo $row['phone'] ?>")' data-target="#exampleModal<?php echo $key ?>">Call</a></td>

                             </tr>
                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal<?php echo $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                         </div>
                                         <div class="modal-footer">

                                             <form class="row" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                                                 <div class="col-md-6">

                                                     <div class="row">
                                                         <input type="date" placeholder="Insert Date" name="date" class="form-control">
                                                         <input type="time" name="time" placeholder="Insert time" class="form-control">
                                                     </div>

                                                 </div>

                                            <div class="col-md-6">

                                                <input type="number" name="id" value="<?php echo $row['id'];?>" hidden>

                                                <div class="row">
                                                    <input type="submit" name="answer" mt-3 id="appoint" class="btn btn-primary btn-sm" value="Appointed" >
                                                </div>

                                                <div class="row">
                                                    <input type="submit" id="receive" name="answer" class="btn btn-secondary btn-sm" value="not interested" >
                                                </div>

                                                <div class="row">
                                                    <input type="submit" id="notre" name="answer" class="btn btn-secondary btn-sm" value="ignore" >
                                                </div>

                                            </div>

                                             </form>

                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <?php
                         }
                     }

                     ?>



                     </tbody>
                 </table>

             </div>




         </div>
     </div>



    </div>


<?php include 'jquery.php';?>

<script src="call.js"></script>

<script>
    $(document).ready(function () {

        $('#search_text').keyup(function () {

            var txt = $(this).val();

            if (txt !== ''){

                $.ajax({
                    url:"search.php",
                    method:"POST",
                    data:{query:txt},
                    success:function(data)
                    {
                        $('#result').html(data);
                    }
                });

            }



        });

    });


</script>

<?php include 'footer.php'?>
