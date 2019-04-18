<?php  session_start(); ?>

<?php

if (!isset($_SESSION['admin_id'])){
    header('Location: login.php');
}

?>

<?php include "header.php"?>

<?php include "middle_header.php";?>


<?php include "middle_header.php"; ?>


<?php include "navigation.php"; ?>


<div class="container mt-5">


    <div class="row d-flex justify-content-center">

        <div class="col-md-10">

            <div class="card border-info">

                <div class="card-header">

                    <h4 class="card-title text-center font-weight-bold">REGISTER USER</h4>

                 </div>

                <div class="card-body row d-flex justify-content-center">

                    <form class="register_user_form col-9 " >

                        <div class="form-row">

                            <div class="form-group col">

                                <label for="name" class="font-weight-bold">NAME</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Enter Full Name" required>
                            </div>
                            <div class="form-group col mb-3">

                                <label for="phone" class="font-weight-bold">PHONE</label>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter Phone Number" required>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col">

                                <label for="email" class="font-weight-bold">EMAIL</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <div class="form-group col mb-3">

                                <label for="password" class="font-weight-bold">PASSWORD</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password" required>
                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary float-right">Register</button>

                        </div>



                    </form>

                </div>

                <div class="card-body row d-flex justify-content-center">

                    <table class="table">
                        <thead>
                            <tr>

                                <th>Serial</th>

                                <th>Name</th>
                                <th>email</th>

                            </tr>
                        </thead>
                        <tbody id="table_data">



                        </tbody>
                    </table>

                </div>

            </div>

        </div>


    </div>



</div>


<?php include "middle_footer.php"; ?>

<script>

    $(document).ready(function () {


        everyload();

        $('.register_user_form').on('submit',function (event) {

            //prevent default

            event.preventDefault();

            var datas = new FormData(this);

            $.ajax({

                url:'ajax_register_user.php',
                method:"POST",

                data:{
                    type:'insert',
                    name:datas.get('name'),
                    phone:datas.get('phone'),
                    email:datas.get('email'),
                    password:datas.get('password')
                },
                success:function(data)
                {

                    $('.register_user_form').trigger('reset');
                    everyload();

                }

            });

        });



        function everyload() {


            $.ajax({

                url:'ajax_register_user.php',
                method:"get",
                data:{
                    type:"get"
                },
                success:function (data) {

                    $('#table_data').html(data);

                }

            });


        }






    });

</script>

<?php include "footer.php"; ?>
