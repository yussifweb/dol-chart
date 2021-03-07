<?php

// REGISTER USER

if (isset($_POST['register'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $contact = mysqli_real_escape_string($connect, $_POST['contact']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $password_2 = mysqli_real_escape_string($connect, $_POST['password_2']);
    if ($password != $password_2) {
        $error = 'password not match';
        $msg = "Passwords do not match";
        $msg_class = "alert-danger";
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $sql = "SELECT * FROM users WHERE name='$name' OR email='$email' LIMIT 1";
    $result = mysqli_query($connect, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['name'] === $name) {
            $error = 'name exists';
            $msg = "Name already exists";
            $msg_class = "alert-danger";
        }

        if ($user['email'] === $email) {
            $error = 'email exists';
            $msg = "Email already exists";
            $msg_class = "alert-danger";
        }
    }

    if (empty($error)) {
        // $name = $_POST['name'];
        // $contact = $_POST['contact'];
        // $email = $_POST['email'];
        $password = md5($_POST['password']);
        $level = 50;
        $sql = "INSERT INTO users (name, contact, email, password, level) VALUES ( '$name', '$contact', '$email', '$password', '$level' )";
        if (mysqli_query($connect, $sql)) {
            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}


// LOGIN PROCESS 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
            if ($email == $user['email'] && $password == $user['password']) {
                $_SESSION['email'] = $email;

                header('Location: index.php');
            } else {
                echo '<script>
    alert("Error username or password incorrect!");
</script>';
            }
        }
    } else {
        echo "No User Found";
    }
}

// RESET PASSWORD

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    // ensure that the user exists on our system
    $sql = "SELECT email FROM users WHERE email='$email'";
    $results = mysqli_query($connect, $sql);

    if (empty($email)) {
        $error = 'No Email';
        $msg = "Your email is required";
        $msg_class = "alert-danger";
    } else if (mysqli_num_rows($results) <= 0) {
        $error = 'User not found';
        $msg = "Sorry, no user exists on our system with that email";
        $msg_class = "alert-danger";
    }

    // generate a unique random token of length 100
    // "<a href='www.yourwebsite.com/reset-password.php?key=".$email."&amp;token=".$token."'>Click To Reset password</a>"
    $token = bin2hex(random_bytes(50));
    $link = "<html>
    <head>
      <title>Password Reset</title>
    </head>
    <body>
      <p><strong>Click on the link below to reset your password</strong></p>
      <br/>
      <div style='padding-top: 1rem;'></div>
      <div style='background-color: #33d6b3; border: none; 
      padding: 20px 32px; text-align: center; display: inline-block; border-radius: 15px; margin: 0 auto;'>
      <a style='text-decoration: none; color: rgb(253, 235, 235); font-size: 16px; font-weight: 500;' href='localhost/job2/new_pass.php?token=" . $token . "'><strong>Reset Password</strong></a></div>      
    </body>
    </html>";

    if (empty($error)) {
        // store token in the password-reset database table against the user's email
        $sql = "INSERT INTO reset(email, token) VALUES ('$email', '$token')";
        $results = mysqli_query($connect, $sql);

        // Send email to user with the token in a link they can click on
        $to = $email;
        $subject = "Reset your password on DOL.";
        $message = $link;
        $message = wordwrap($message, 70);
        $headers = "From: djiceman.gh@gmail.com";
        $headers .= "MIME-Version: DOL\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $message, $headers);
        //   header('location: reset.php?email=' . $email);              
        $msg = "Email sent. Please login into your email account and click on the link we sent to reset your password";
        $msg_class = "alert-success";
    }
}


// NEW PASSWORD

// ENTER A NEW PASSWORD
if (isset($_POST['reset'])) {
    $new_password = mysqli_real_escape_string($connect, $_POST['new_password']);
    $new_password2 = mysqli_real_escape_string($connect, $_POST['new_password2']);

    // Grab to token that came from the email link
    $token = $_GET['token'];

    if (empty($new_password) || empty($new_password2)) {
        $error = 'No Password';
        $msg = "Password is required";
        $msg_class = "alert-danger";
    }

    if ($new_password !== $new_password2) {
        $error = 'No Password match';
        $msg = "Passwords do not match";
        $msg_class = "alert-danger";
    }
    if (empty($error)) {
        // select email address of user from the password_reset table 
        $sql = "SELECT email FROM reset WHERE token='$token' LIMIT 1";
        $results = mysqli_query($connect, $sql);
        $email = mysqli_fetch_assoc($results)['email'];

        if ($email) {
            $new_password = md5($new_password);
            $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
            $results = mysqli_query($connect, $sql);
            header('location: index.php');
        }
    }
}
?>


?>