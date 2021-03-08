<?php $title = "LogIn"; ?>
<?php include "../inc/header.php"; ?>

<main class="container">
    <div class="row">
        <div class="col-12 col-sm-4 offset-sm-4 mt-5">
            <div class="card">
                <div class="card-header h5 text-center">DOL</div>
                <div class="card-body">
                    <form action="user_process.php" class="form-signin" method="POST">
                        <h4 class="h3 mb-3 font-weight-normal text-center">Please Sign In</h4>
                        <div class="form-group mb-2">
                            <label for="inputEmail" class="sr-only">Email address</label>
                            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                        </div>
                        <div class="form-group mb-2">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
                    </form>
                    <p><a href="reset.php">Forgot your password?</a></p>
                </div>
                <div class="foot card-footer text-center">
                    <p class="text-muted">&copy; <?php echo date("Y") ?>. DOL Platform <br /> All Rights Reserved</p>

                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../inc/footer.php"; ?>