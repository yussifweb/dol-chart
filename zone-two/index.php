<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <script src="../assets/jquery-3.5.1.min.js"></script>
    <script src=".//assets/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

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

    <div class="modal" tabindex="-1">

    </div>

    <div id="container" class="container">
        <nav class="nav">
            <ul>
                <li class="nav-item"><a href="../zone-one/index.php">Zone 1</a></li>
                <li class="nav-item"><a href="../zone-two/index.php">Zone 2</a></li>
                <li class="nav-item"><a href="../zone-three/index.php">Zone 3</a></li>
            </ul>
        </nav>


        <h1 class="text-center mt-3">Division One League 2020 - 21</h1>
        <h2 class="text-center">Goal King Chart - Zone 2</h2>


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
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>

            </div>
        </div>

        <div class="row mt-5">

            <div class="col-sm-8 offset-sm-2">
                <div id="action-container" class="mb-3">

                </div>

                <table class=" table table-green table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">S/N</th>
                            <th>Name</th>
                            <th>Club</th>
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