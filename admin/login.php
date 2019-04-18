<?php  session_start(); ?>

<?php

    if (isset($_SESSION['admin_id'])){
        header('Location: index.php');
    }

?>
<?php include '../connect.php'; ?>
<?php

if (isset($_POST['login'])){


    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)){

        $sql_login = "select * from admin WHERE email='$email' AND password='$password'";

        if ($connect->query($sql_login)->num_rows > 0){

            $info_admin  = $connect->query($sql_login)->fetch_assoc();

            $_SESSION['admin_id'] = $info_admin['id'];
            $_SESSION['admin_name'] = $info_admin['name'];

            header('Location: index.php');


        }
    }


}


?>

<?php include "header.php"; ?>


<?php include "middle_header.php"; ?>

<div class="container">
    <form class="row d-flex justify-content-center" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="card border-info text-danger  col-6 mt-5 ">
            <div class=" card-body " >

                <div class="card-header text-center">
                    <h4>SIP CALLER GIC CTG(ADMIN)</h4>
                </div>
                <div class="form-group">

                    <label for="email">Email:</label>

                    <input id="email"  name="email" type="email" placeholder="Insert your email" class="form-control p-3"  type="text"  required>

                </div>
                <div class="form-group">

                    <label for="password">Password:</label>
                    <input  id="password" name="password" type="password" placeholder="insert Your Pasword" class="form-control p-3"  type="text"  required>


                </div>


            </div>

            <div class="card-footer">
                <input type="submit" class="btn btn-info  float-right"  name="login" value="Login">

            </div>

        </div>
    </form>

</div>


<?php include "middle_footer.php"; ?>

<?php  include 'footer.php';?>
