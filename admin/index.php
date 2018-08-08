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


    <div class="row">

        <div class="col-md-7">

            <div class="card border-success">
                <div class="card-header text-center">
                   <h5>Councilor performance</h5>
                    <hr>
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn border-success btn_per" value="today">Today</button>
                        <button type="button" class="btn border-primary btn_per" value="week">This week</button>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Month
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li class="dropdown-item" value="1">January</li>
                                <li class="dropdown-item" value="2">February</li>

                                <li class="dropdown-item" value="3">March</li>
                                <li class="dropdown-item" value="4">April</li>
                                <li class="dropdown-item" value="5">May</li>
                                <li class="dropdown-item" value="6">June</li>
                                <li class="dropdown-item" value="7">July</li>
                                <li class="dropdown-item" value="8">August</li>
                                <li class="dropdown-item" value="9">September</li>
                                <li class="dropdown-item" value="10">October</li>
                                <li class="dropdown-item" value="11">November</li>
                                <li class="dropdown-item" value="12">December</li>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Appointed</th>
                        </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                    </table>


                </div>

            </div>

        </div>

        <div class="col-md-5">


            <div class="card border-success">
                <div class="card-header text-center">
                    <h5>Call of Counselor </h5>
                    <hr>
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn border-success btn_per" value="today_call">Today</button>


                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Call</th>
                        </tr>
                        </thead>
                        <tbody id="result_call">

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




        $(".dropdown-item").hover(function () {
            $(this).css({
                "cursor":"pointer",

            });


        });

        $(".dropdown-item").click(function () {
            var value = $(this).text();
            var intval = $(this).val();
            var year = new Date().getFullYear();

            var query = [];
            query[0] = "month";
            var month_year = year+"-"+intval;
            query[1] = month_year;



            $("#btnGroupDrop1").html(value)
            $.ajax({
                url:"month.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });


        });

        $(".btn_per").click(function () {

            var request_type = $(this).val()
            if (request_type == "today"){

                var button_per = [];
                button_per[0] = request_type;
                $.ajax({
                    url:"month.php",
                    method:"POST",
                    data:{query:button_per},
                    success:function(data)
                    {
                        $('#result').html(data);
                    }
                });

            }

            if (request_type == "week"){
                var curr = new Date;
                var firstday = new Date(curr.setDate(curr.getDate() - curr.getDay()));
                var lastday = new Date(curr.setDate(curr.getDate() - curr.getDay()+6));
                var button_per = [];
                button_per[0] = request_type;
                button_per[1] = firstday;
                button_per[2] = lastday;
                $.ajax({
                        url:"month.php",
                        method:"POST",
                        data:{query:button_per},
                        success:function (data) {
                            $('#result').html(data);
                        }
                });





            }

            if (request_type == "today_call"){

                var button_per = [];
                button_per[0] = request_type;
                $.ajax({
                    url:"month.php",
                    method:"POST",
                    data:{query:button_per},
                    success:function(data)
                    {
                        $('#result_call').html(data);
                    }
                });

            }


        });



    });

</script>

<?php include "footer.php"; ?>
