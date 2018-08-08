
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

            <div class="col-md-6" >

                <div class="card border-success" >
                    <div class="card-header text-center">
                        <h5>Targets</h5>
                        <hr>
                        <div class="input-group mb-3">
                            <input type="number" min="1900" id="search_input" max="2099" step="1" value="<?php echo date("Y")?>" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="search" type="button">Search</button>
                            </div>
                        </div>

                    </div>

                    <div class="card-body" style="max-height: 25em;min-height: 25em; overflow: scroll;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Target Month</th>
                                <th scope="col">Target</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody id="result_target" >

                            </tbody>
                        </table>


                    </div>

                </div>

            </div>
            <div class="col-md-6">

<!--                this is for setting target-->
                <div class="col">
                    <div class="card border-success">
                        <div class="card-header text-center">
                            <h5>Set Target</h5>
                            <p id="success"></p>

                        </div>

                        <div class="card-body">
                            <div class="row">



                                <input type="date" id="date" class="form-control col">
                                <input type="text" id="target" class="form-control col" placeholder="insert target">
                                <input type="button"  class="form-control btn btn-success col" id="insert" value="insert">
                            </div>


                        </div>

                    </div>
                </div>
<!--                end of setting target-->

<!--                this is for target edit-->

                <div class="col mt-3" >

                    <div class="card border-success" >
                        <div class="card-header text-center">
                            <h5>Edit Targets</h5>
                            <span id="change_edit"></span>
                            <hr>
                            <div class="input-group mb-3">
                                <input type="date"  min="<?php echo date("Y-m-d")?>" id="edit_target_input"   class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" id="edit_target_search" type="button">Search Target</button>
                                </div>
                            </div>

                        </div>
                        <div class="card-body" id="edit_target">




                        </div>



                        </div>

                    </div>
<!--            end this is for target edit     -->

                </div>

            </div>


        </div>



    </div>


<?php include "middle_footer.php"; ?>

<script>
    $(document).ready(function () {
//load first is for loading the targets
        load_first();
//this is for searching target by year
        $("#search").click(function () {

           var search_val =  $("#search_input").val();

            var button_per = [];
            button_per[0] = "target";
            button_per[1] = search_val;
            $.ajax({
                url:"call_per_day.php",
                method:"POST",
                data:{query:button_per},
                success:function(data)
                {
                    $('#result_target').html(data);
                }
            });


        });
//        end of search target

//        insert target

        $("#insert").click(function () {

            var month = $("#date").val();
            var target = $("#target").val();

            var button_per = [];
            button_per[0] = "insert";
            button_per[1] = month;
            button_per[2] = target;
            $.ajax({
                url:"call_per_day.php",
                method:"POST",
                data:{query:button_per},
                success:function(data)
                {
                    $('#success').html(data);

                    load_first();

                }
            });

        });
//        end of insert target

//        target edit search

        $("#edit_target_search").click(function () {

            var edit_target_input_value = $("#edit_target_input").val();
            $("#edit_target_input").val('');

            var edit_search = [];
            edit_search[0] = "edit_search";
            edit_search[1] = edit_target_input_value;

            $.ajax({
                url:"call_per_day.php",
                method:"POST",
                data:{query:edit_search},
                success:function(data)
                {
                    $('#edit_target').html(data);



                }
            });

        });


/*end of target edit search*/

//target edit change







    });

//method for loading the targets as soon as dom is ready
    function load_first() {

        var search_val =  $("#search_input").val();

        var button_per = [];
        button_per[0] = "target";
        button_per[1] = search_val;
        $.ajax({
            url:"call_per_day.php",
            method:"POST",
            data:{query:button_per},
            success:function(data)
            {
                $('#result_target').html(data);
            }
        });

//        end of load target method

    }

    function target_change(id) {

        var target_change  = [];

        var value_target_change = $('#edit_target_change_value').val();
        target_change[0] = "target_change";
        target_change[1] = value_target_change;
        target_change[2] = id;

        $.ajax({
            url:"call_per_day.php",
            method:"POST",
            data:{query:target_change},
            success:function(data)
            {
                $('#change_edit').html(data);

            }
        });


    }

</script>

<?php include "footer.php"; ?>
