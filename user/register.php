<?php $title = "Register"; ?>
<?php include "../inc/header.php"; ?>


<main class="container mt-5">
  <div class="row">
    <div class="col-xs-12 col-sm-4 offset-sm-4">
      <div class="card">
        <div class="card-header text-center h3">DOL</div>
        <div class="card-body">
          <form action="user_process.php" class="form-signin" method="POST">

            <?php if (!empty($msg)) : ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
                <?php echo $msg; ?>
            </div>
            <?php endif; ?>

            <h4 class="h5 font-weight-normal text-center">Sign Up</h4>
            <div class="form-group">
              <label for="name" id="name-label">Name</label>
              <input type="text" id="name" class="form-control" name="name" placeholder="Please Enter Your Name" required>
            </div>
            <div class="form-group">
              <label for="contact" id="contact-label">Contact</label>
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Please Enter Your contact" required>
            </div>
            <div class="form-group">
              <label for="email" id="email-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter Your Email" required>
            </div>
            <div class="form-group">
              <label for="password" id="password-label">Password</label>
              <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="password" id="password-label">Re-enter Password</label>
              <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Re-enter Password" required>
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Sign Up</button>
        </form>

      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-success btn-lg btn-block" role="button">Home</a>
      </div>
    </div>

  </div>
  </div>
</main>



<?php include "../inc/footer.php"; ?>