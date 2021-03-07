<?php $title = "New Password"; ?>
<?php require 'header.php'; ?>

<main class="container">
  <div class="row">
    <div class="col-12 col-sm-4 offset-sm-4 mt-5">
      <div class="card">
        <div class="card-header h5 text-center">DOL Platform</div>
        <div class="card-body">
          <form action="user_process.php" class="form-signin" method="POST">
            <h4 class="h3 mb-3 font-weight-normal text-center">New Password</h4>
            <div class="form-group">
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" class="form-control" name="new_password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="sr-only">Confirm Password</label>
              <input type="password" id="inputPassword" class="form-control" name="new_password2" placeholder="Confirm Password" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" name="reset" type="submit">Submit</button>
          </form>
        </div>
        <div class="foot card-footer text-center">
          <p class="text-muted">&copy; <?php echo date("Y") ?>. DOL Platform <br /> All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</main>

<?php if (!empty($msg)) : ?>
  <div class="alert <?php echo $msg_class ?>" role="alert">
    <?php echo $msg; ?>
  </div>
<?php endif; ?>


</body>

</html>