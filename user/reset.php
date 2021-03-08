<?php $title = "Reset Password"; ?>
<?php include "../inc/header.php"; ?>

<main class="container">
  <div class="row">
    <div class="col-12 col-sm-4 offset-sm-4 mt-5">
      <div class="card">
        <div class="card-header h5 text-center">DOL Platform</div>
        <div class="card-body">
          <form class="login-form" action="user_process.php" method="POST">
            <h2 class="form-title">Reset password</h2>
            <?php if (!empty($msg)) : ?>
              <div class="alert <?php echo $msg_class ?>" role="alert">
                <?php echo $msg; ?>
              </div>
            <?php endif; ?>
            <div class="form-group">
              <label for="inputEmail" class="sr-only">Email address</label>
              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
            </div>
            <div class="form-group">
              <button class="btn btn-lg btn-primary btn-block" name="reset-password" type="submit">Submit</button>
            </div>
          </form>
        </div>
        <div class="foot card-footer text-center">
          <p class="text-muted">&copy; 2020. DOL Platform <br /> All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- <div class="col-12 col-sm-6 offset-sm-3 pt-5">
  <?php if (!empty($msg)) : ?>
    <div class="alert <?php echo $msg_class ?>" role="alert">
      <?php echo $msg; ?>
    </div>
  <?php endif; ?>
</div> -->


</body>

</html>