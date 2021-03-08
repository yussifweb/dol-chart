<?php
session_start();

include ("db.php");

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOL | <?php echo $title ?></title>
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&family=Roboto+Slab:wght@300;400;500&family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="zone_one/index.php">Zone 1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="zone_two/index.php">Zone 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="zone_three/index.php">Zone 3</a>
                    </li>
                </ul>
                <div class="me-2 my-lg-0">
                    <!-- Button trigger modal -->
                    <?php
                    if ((isset($_SESSION["email"]) && $_SESSION["email"] == $email)) {

                        echo "<a class='btn btn-danger' href='../logout.php' role='button'>Log Out</a>";

                        $level = $_SESSION["email"];
                        $sql = "SELECT * FROM users WHERE email='$level'";
                        $result = mysqli_query($connect, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($user = mysqli_fetch_assoc($result)) {
                                $level = $user['level'];
                                if ($level == 100) {
                                    echo '<a class="btn btn-primary" href="../user/register.php" role="button">Register</a>';
                    ?>
                    <?php
                                }
                            }
                        }
                    } else {
                        echo "<a class='btn btn-primary' href='../user/login.php' role='button'>Login</a>";
                    }
                    ?>
                </div>

                <form class="d-flex">
                    <input class="form-control me-2" type="text" type="text" name="search" id="search" placeholder="Search" aria-label="Search">
                    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>