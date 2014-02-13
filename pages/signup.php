<?php
/**
 * @file
 * signup
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */

?>

<h2>Sign up</h2>
</br>
<?php if ($message) { echo $message; } ?>
<form action="index.php" method="post" role="form">
  <input type="hidden" id="method" name="method" value="signup">
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <input type="submit" value="Log in" class="btn btn-danger">
  <a href="/index.php" class="btn btn-danger">Cancel</a>
</form>