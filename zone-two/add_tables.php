<?php 
include("db.php");

if (isset($_POST['player_name'])) {
//    echo "RECIEVED";
$player_name = $_POST['player_name'];
$club = $_POST['club'];
$goals = $_POST['goals'];

$query = "INSERT INTO zone_four(player_name, club, goals) VALUES('$player_name', '$club', '$goals')";
$query_table = mysqli_query($connect, $query);

header("Location: index.php");

if (!$query_table) {
    die("QUERY FAILED");
}

}

?>