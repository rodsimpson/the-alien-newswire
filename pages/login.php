<?php
/**
 * @file
 * login
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */

?>

<h2>Log in</h2>
</br>
<?php if ($message) { echo $message; } ?>
<form action="index.php" method="post" role="form">
  <input type="hidden" id="method" name="method" value="login">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="title" name="username" placeholder="Username" value="moderator">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="text" class="form-control" id="title" name="password" placeholder="Password" value="moderator">
  </div>
  <input type="submit" value="Log in" class="btn btn-danger">
  <a href="/index.php" class="btn btn-danger">Cancel</a>
</form>