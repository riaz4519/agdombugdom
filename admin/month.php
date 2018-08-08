
<?php  session_start(); ?>

<?php

if (!isset($_SESSION['admin_id'])){
    header('Location: login.php');
}

?>

<?php include "../connect.php";
include "../function.php";
?>
<?php

    if (isset($_POST['query'])) {

        $year_month = array();


    $year_month = $_POST['query'];
    if ($year_month[0] == "month"){

       $month  = format_month($year_month[1]);

        $sql = "SELECT user.name AS name,user.email as email ,COUNT(client_info.appointed_date)AS client_count FROM client_info JOIN user ON client_info.user_id =user.id WHERE client_info.appointed_date like '%$month%' GROUP BY user.id ORDER BY client_count DESC";

    }
    if ($year_month[0] == "today"){
        $today = date("Y-m-d");

        $sql = "SELECT user.name AS name,user.email as email ,COUNT(client_info.appointed_date)AS client_count FROM client_info JOIN user ON client_info.user_id =user.id WHERE client_info.appointed_date like '%$today%' GROUP BY user.id ORDER BY client_count DESC";
    }

        if ($year_month[0] == "week"){
            $day = date('w');
            $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
            $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));

            $sql = "SELECT user.name AS name,user.email as email ,COUNT(client_info.appointed_date)AS client_count FROM client_info JOIN user ON client_info.user_id =user.id WHERE client_info.appointed_date BETWEEN '$week_start' AND '$week_end' GROUP BY user.id ORDER BY client_count DESC";
        }
        if ($year_month[0] == "today_call"){
            $today = date("Y-m-d");

            $sql = "SELECT user.name AS name,user.email as email ,COUNT(client_info.appointed_date)AS client_count FROM client_info JOIN user ON client_info.user_id =user.id WHERE client_info.last_contact like '%$today%' GROUP BY user.id ORDER BY client_count DESC";
        }







          if ($connect->query($sql)->num_rows > 0) {

                $result = $connect->query($sql);
                $output = "";
                $i = 0;

                while ($row = $result->fetch_assoc()) {


                    $output .= '
                           <tr>
                           <th scope="row">' . ++$i . '</th>
                            <td>' . $row["name"]. '</td>
                            <td>' . $row["email"] . '</td>
                            <td>' . $row['client_count'] . '</td>


                           </tr>
                          ';


                }
                echo $output;


            }




    }

?>