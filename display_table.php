<?php
include("db.php");


$query = "SELECT * FROM zone_one ORDER BY goals DESC";
$query_table_info = mysqli_query($connect, $query);


if (!$query_table_info) {
    die("Query failed" . mysqli_error($connect));
}

$number = 1;
while ($row = mysqli_fetch_array($query_table_info)) {
    echo "<tr>";
    echo "<td>{$number}</td>";
    echo "<td>{$row['player_name']}</td>";
    echo "<td>{$row['club']}</td>";
    echo "<td class='text-center'>{$row['goals']}</td>";
    echo "<td class='text-center'><a rel='" . $row['id'] . "'class='upd-link btn btn-warning btn-sm' href='javascript:void(0)'>Edit</a></td>";
    echo "<td class='text-center'><a rel='" . $row['id'] . "'class='del-link btn btn-danger btn-sm' href='javascript:void(0)'>Del</a></td>";
    echo "</tr>";
    ++$number;
}

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
        // $("#action-container").hide();

        $(".upd-link").on('click', function() {
            // alert('Click');

            $("#action-container").show();

            var id = $(this).attr("rel");
            // alert(id);
            $.post("process.php", {
                id: id
            }, function(data) {
                // alert(data)
                $("#action-container").html(data);

            });
        });

        // DELETE BUTTON
        $(".del-link").on('click', function() {

            if (confirm('Are You Sure?')) {
                id = $(this).attr('rel');
                deletethis = "Deleted"
                // alert("title");

                $.post("display_table.php", {
                    id: id,
                    deletethis: deletethis
                }, function(data) {
                    alert("Done");
                    // alert("Updated Succesfully");
                    // $("#feedback").text("Deleted Succesfully");

                    $("#action-container").hide();

                });
            }

        });

    });
</script>