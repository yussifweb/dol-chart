<?php
include("db.php");

// echo "ther";

// QUERY DATA

if (isset($_POST['id'])) {

    $id = mysqli_real_escape_string($connect, $_POST['id']);


    $query = "SELECT * FROM zone_one WHERE id = {$id}";
    $query_table_info = mysqli_query($connect, $query);


    if (!$query_table_info) {
        die("Query failed" . mysqli_error($connect));
    }

    while ($row = mysqli_fetch_array($query_table_info)) {

        echo "<div class='modal-dialog modal-dialog-centered' id='id' rel='" . $row['id'] . "'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<h5 class='modal-title'>{$row['player_name']}</h5>";
        echo "<button type='button' class='btn btn-close close'></button>";
        echo "</div>";
        echo "<div class='modal-body row'>";
        echo "<div class='col-sm-5'><input type='text' class='form-control player-name' value='" . $row['player_name'] . "'></div>";
        echo "<div class='col-sm-5'><input type='text' class='form-control club' value='" . $row['club'] . "'></div>";
        echo "<div class='col-sm-2'><input type='number' class='form-control goals' value='" . $row['goals'] . "'></div>";
        echo "</div>";
        echo "<div class='modal-footer'>";
        echo "<button rel='" . $row['id'] . "' type='button' class='btn btn-danger delete'>Delete</button>";
        echo "<button type='button' class='btn btn-primary update'>Save</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

// UPDATING DATA

if (isset($_POST['updatethis'])) {
    // echo "E dey Job";
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $player_name = mysqli_real_escape_string($connect, $_POST['player_name']);
    $club = mysqli_real_escape_string($connect, $_POST['club']);
    $goals = mysqli_real_escape_string($connect, $_POST['goals']);

    $query = "UPDATE zone_one SET player_name = '$player_name', club = '$club', goals = '$goals' WHERE id = $id ";
    $result_set = mysqli_query($connect, $query);

    if (!$result_set) {
        die("Query failed" . mysqli_error($connect));
    }
}

// DELETING DATA

if (isset($_POST['deletethis'])) {
    // echo "E dey Job";
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $id = $_POST['id'];

    $query = "DELETE FROM zone_one WHERE id = $id ";
    $result_set = mysqli_query($connect, $query);

    if (!$result_set) {
        die("Query failed" . mysqli_error($connect));
    }
}


?>

<script>
    $(document).ready(function() {

        var id;
        var player_name;
        var club;
        var goals;
        var updatethis = "Updated";
        var deletethis = "Deleted";

        // EXTRACT INFO

        $(".modal").on('input', function() {
            id = $('#id').attr('rel');
            player_name = $('.player-name').val();
            club = $('.club').val();
            goals = $('.goals').val();
            // console.log(id);
            // console.log(id, player_name, club, goals);
        });




        // UPDATE BUTTON
        $(".update").on('click', function() {
            // alert("title");

            $.post("process.php", {
                id: id,
                player_name: player_name,
                club: club,
                goals: goals,
                updatethis: updatethis
            }, function(data) {
                // alert("Updated Succesfully");
                $(".modal").hide();
                $("#feedback").text("Updated Succesfully");

            });

        });

        // DELETE BUTTON
        $(".delete").on('click', function() {

            if (confirm('Are You Sure?')) {
                id = $(".delete").attr('rel');
                // alert("title");

                $.post("process.php", {
                    id: id,
                    deletethis: deletethis
                }, function(data) {
                    alert("Done");
                    // alert("Updated Succesfully");
                    // $("#feedback").text("Deleted Succesfully");

                    $(".modal").hide();

                });
            }

        });

        // CLOSE BUTTON
        $(".close").on('click', function() {
            $(".modal").hide();
        });


    });
</script>