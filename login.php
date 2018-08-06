<?php
session_start();

if (isset($_SESSION['id'])){
    header('Location: index.php');
}
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/25/2018
 * Time: 7:04 PM
 */
include 'connect.php';


if (isset($_POST['submit'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "select * from user WHERE  email = '$email'AND password='$pass'";
    if ($data = $connect->query($sql)->num_rows > 0){

        $data =$connect->query($sql)->fetch_assoc();

        $_SESSION['id'] = $data['id'];
       $_SESSION['name'] = $data['name'];
       header('Location: index.php');


    }

}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <title>Document</title>
    </head>
<body>
<div class="container">
<form class="form-horizontal row d-flex justify-content-center" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">




        <div class="col-md-5 mt-5 col-11 card card-body border-dark" >

            <div class="form-group">


                    <div class="input-group">

                        <input  name="email" type="email" placeholder="Insert your email" class="form-control"  type="text"  required>
                    </div>

            </div>
            <div class="form-group">

                    <div class="input-group">

                        <input  name="password" type="password" placeholder="insert Your Pasword" class="form-control"  type="text"  required>
                    </div>

            </div>
            <input type="submit" class="form-control btn btn-success"  name="submit" value="Login">





        </div>
</form>

    </div>

<?php include 'jquery.php';?>

<?php include 'footer.php';?>
