<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <script src="./assets/jquery-3.5.1.min.js"></script>

</head>

<body>

    <script>
        $(document).ready(function() {



            setInterval(function() {
                update_table();

            }, 500);

            // SHOW CARS
            function update_table() {

                $.ajax({
                    url: 'display_table.php',
                    type: 'POST',
                    success: function(show_table) {
                        if (!show_table.error) {
                            $("#show-table").html(show_table);
                        }
                    }
                });

                $('#search').keyup(function() {

                    var search = $('#search').val();

                    $.ajax({
                        url: 'search.php',
                        data: {
                            search: search
                        },
                        type: 'POST',
                        success: function(data) {
                            if (!data.error) {
                                $('#result').html(data);
                            }
                        }
                    })
                });


            }

            // ADD CARS NAME TO DB

            $("#add-table-form").submit(function(evt) {
                evt.preventDefault();

                var postData = $(this).serialize();
                var url = $(this).attr('action');

                // alert(postData);

                $.post(url, postData, function(php_table_data) {
                    $("#table-result").html(php_table_data);
                    $("#add-table-form")[0].reset();

                });
            });

        }); //DOCUMENT READY
    </script>


    <div id="container" class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <h2>Search Database</h2>
                <input class="form-control" type="text" type="text" name="search" id="search" placeholder="Search">
                <br />
                <br />
                <h2 class="bg-success" id="result"></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <form method="post" id="add-table-form" action="add_tables.php">
                    <div class="row">
                        <div class="col-sm-5 mb-3">
                            <label for="player_name">Player Name</label>
                            <input type="text" class="form-control" id="player_name" name="player_name" placeholder="Player Name" required>
                        </div>
                        <div class="col-sm-5 mb-3">
                            <label for="club">Club</label>
                            <input type="text" class="form-control" id="club" name="club" placeholder="Club" required>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="goals">Goals</label>
                            <input type="number" class="form-control" id="goals" name="goals" placeholder="Goals" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </form>

            </div>
        </div>

        <div class="row mt-5">

            <div class="col-sm-8 offset-sm-2">
                <div id="action-container">

                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">S/N</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Club</th>
                            <th class="text-center">Goal(s)</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="show-table">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>