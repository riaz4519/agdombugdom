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

<form class="form-horizontal" role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <h2>Please Login</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group has-danger">
                <label class="sr-only" for="email">E-Mail Address</label>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                    <input type="email" name="email" class="form-control" id="email"
                           placeholder="you@example.com" required autofocus>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="sr-only" for="password">Password</label>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                    <input type="password" name="password" class="form-control" id="password"
                           placeholder="Password" required>
                </div>
            </div>
        </div>

    </div>

    <div class="row" style="padding-top: 1rem">
        <div class="col-md-4"></div>
        <div class="col-md-4 ml-3">
            <input type="submit" class="btn btn-success btn-block" name="login" value="login">

        </div>
    </div>
</form>


<?php include "middle_footer.php"; ?>

<?php  include 'footer.php';?>
