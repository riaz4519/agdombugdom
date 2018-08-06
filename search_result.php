<?php
session_start();

if (!isset($_SESSION['id'])){

    header('Location: login.php');
}
include "connect.php";
include "function.php";






?>


<?php

    if (isset($_POST['change'])){

        $client_id = $_GET['client'];

        $date = $_POST['date'];
        $time = $_POST['time'];
        $type = $_POST['change'];

        if ($type == "Appoint"){

            $sql1 = "select serial from client_info ORDER BY serial DESC LIMIT 1";
            $data = $connect->query($sql1)->fetch_assoc();
            $serial = $data['serial'] + 1;

            $sqql = "update client_info set appointed_date=CURRENT_DATE,date='$date',appointed=TRUE,time='$time',last_contact=CURRENT_DATE,status=0 WHERE id='$client_id'";

            if ($connect->query($sqql)){
                echo '<h5 class="alert alert-success text-center"> Updated</h5>';
            }

        }
        if ($type == "Re appoint") {

            $sql1 = "select serial from client_info ORDER BY serial DESC LIMIT 1";
            $data = $connect->query($sql1)->fetch_assoc();
            $serial = $data['serial'] + 1;

            $sqql = "update client_info set date='$date',time='$time',last_contact=CURRENT_DATE,status=0 WHERE id='$client_id'";

            if ($connect->query($sqql)) {
                echo '<h5 class="alert alert-success text-center"> Updated</h5>';
            }
        }
        if ($type == "not interested" ){

            $sql1 = "select serial from client_info ORDER BY serial DESC LIMIT 1";
            $data = $connect->query($sql1)->fetch_assoc();
            $serial = $data['serial'] + 1;

            $sqql = "update client_info set last_contact=CURRENT_DATE,status=3 WHERE id='$client_id'";

            if ($connect->query($sqql)) {
                echo '<h5 class="alert alert-success text-center"> Updated</h5>';
            }
        }



    }


?>


<?php

    include 'header.php'

?>

<!--getting all the data for showing in card-->


<div class="row d-flex justify-content-center mt-3">
    <div class="col-md-5">

        <div class="card border-success">
            <?php

            $id = $_GET['client'];
            $sql = "select * from client_info WHERE id = '$id'";

            if ($connect->query($sql)->num_rows > 0){

                $data = $connect->query($sql)->fetch_assoc();


            ?>
            <div class="card-header bg-transparent border-success">
                <h6 class="text-center"><b>Info Of <?php echo $data['first_name']." ".$data['last_name'];?></b></h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: <?php echo $data['first_name']." ".$data['last_name'];?></li>
                    <li class="list-group-item">age: <?php echo $data['age'];?></li>
                    <li class="list-group-item">Data Type: <?php echo $data['data_type'];?></li>
                    <li class="list-group-item">Work Experience: <?php echo $data['work'];?> Years</li>
                    <li class="list-group-item">Phone: <?php echo $data['phone'];?></li>
                </ul>


            </div>
            <div class="card-footer bg-transparent border-success">

                <ul class="list-group list-group-flush">

                    <form action="<?php echo "search_result.php?client=".$_GET['client']?>" method="POST">

                    <li class="list-group-item text-center"><input type="date" name="date"> <input type="time" name="time">  </li>
                        <?php
                        $sql = "select * from client_info WHERE id = '$id' AND appointed=TRUE ";

                        if ($connect->query($sql)->num_rows >0){

                            ?>
                            <li class="list-group-item text-center"><input type="submit" class="btn btn-success btn-sm" name="change" value="Re appoint">
                                <?php
                        }else{
                            ?>
                        <li class="list-group-item text-center"><input type="submit" class="btn btn-success btn-sm" name="change" value="Appoint">
                                    <?php


                                }
                        ?>
                            <?php
                            $sql = "select * from client_info WHERE id = '$id' AND status!=3 ";

                            if ($connect->query($sql)->num_rows >0) {

                                ?>
                                <input type="submit" class="btn btn-danger btn-sm" name="change" value="not interested">
                                <?php

                            }
                        ?></li>
                    </form>
                </ul>

            </div>



        </div>
        <?php } ?>


    </div>

</div>

<?php include 'jquery.php';?>
<?php




include "footer.php";


?>


