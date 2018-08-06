<?php  session_start(); ?>
<?php include "connect.php"; ?>


<?php



    $id = $_SESSION['id'];
    $query = $_POST['query'];

    $sql = "select id,first_name,last_name,phone from client_info WHERE phone like '%$query%' AND user_id ='$id'";

    $output = '';

    if ($connect->query($sql)){

       if ($connect->query($sql)->num_rows > 0){

           $result = $connect->query($sql);

           $output .= '
              <div class="table-responsive">
               <table class="table table bordered">
                <tr>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Link</th>
          
                </tr>';

           while ($row = $result->fetch_assoc()){


               $output .= '
                           <tr>
                            <td>'.$row["first_name"].'</td>
                            <td>'.$row["phone"].'</td>
                            <td><a href="search_result.php?client='.$row["id"].'">'.'change</a></td>
                            
                           
                           </tr>
                          ';


           }
           echo $output;



       }



    }
    else{
        echo "hello";
    }









?>



