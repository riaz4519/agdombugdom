
<?php  session_start(); ?>

<?php

if (!isset($_SESSION['admin_id'])){
    header('Location: login.php');
}

?>

<?php include "../connect.php"; ?>
<?php  include "../function.php"; ?>



<?php

if (isset($_POST['query'])){


        $year_month = $_POST['query'];

    if ($year_month[0] == "target"){
       $year = $year_month[1];
        $sql = "select month ,target from target WHERE month like '%$year%'";

        if($connect->query($sql)->num_rows > 0) {

            $result = $connect->query($sql);
            $output = "";
            $i = 0;

            while ($row = $result->fetch_assoc()) {


                $output .= '
                           <tr>
                           <th scope="row">' . ++$i . '</th>
                            <td>' . format_month_year($row["month"]). '</td>
                            <td>' . $row["target"] . '</td>
                            <td>' . format_date($row['month']) . '</td>
                           </tr>
                          ';


            }
            echo $output;


    }





    }

//    for inserting target

    if ($year_month[0] == "insert"){

        $month = $year_month[1];
        $target = $year_month[2];
        $convert_month = format_month($month);

        if (!empty($month)){

            if (!empty($target)){

                $sql_check = "select * from target WHERE month like '%$convert_month%'";

                if ($connect->query($sql_check)->num_rows > 0){

                    echo "Already inserted .You can edit if you want";
                }else{
                    $sql = "insert into target(month,target)VALUES ('$month','$target')";
                    if ($connect->query($sql)){
                        echo "successfully inserted";
                    }

                }

            }else{
                echo "insert target";
            }

        }else{
            echo "insert Month";
        }



    }

/*search the target field to edit*/
    if ($year_month[0] == "edit_search"){

        $month_to_edit = format_month($year_month[1]);

        if (!empty($month_to_edit)){

              $sql_edit_month = "select * from target WHERE month like '%$month_to_edit%' ";
              if ($connect->query($sql_edit_month)->num_rows > 0){

                  $found_result = $connect->query($sql_edit_month)->fetch_assoc();
                  echo "<div class='input-group mb-3'>
                                                     
                                 <input type='text' class='form-control' id='edit_target_change_value' value='" . $found_result['target'] . "'  >
                                 <div class='input-group-append'>
                                        <button class='btn btn-outline-secondary'  onclick='target_change(".$found_result['id'].")' type='button'>Change</button>
                                </div>
                        </div>";




              }

        }else{
            echo "insert Month";
        }




    }

/*end */

/*change the target field*/
    if ($year_month[0] == "target_change"){

        $target_number = $year_month[1];
        $target_id = $year_month[2];

        if (!empty($target_number)){

            $sql_update_target = "update target set target = '$target_number' WHERE id='$target_id'";
            if ($connect->query($sql_update_target)){
                echo "<span class='alert alert-success mt-1'>SuccessFully edited</span>";
            }

        }else{
            echo "<span class='alert alert-danger'>Target Empty</span>";
        }

    }



}
/*end change target field*/



?>