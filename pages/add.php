<?php
/**
 * @file
 * add
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */

?>

<h2>Add Post</h2>
</br>
<form action="index.php" method="post" role="form">
  <input type="hidden" id="method" name="method" value="add">
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Post Title">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea class="form-control" id="body" name="body" placeholder="Post Description"></textarea>
  </div>

  <input type="submit" value="Add" class="btn btn-danger">
  <a href="/index.php" class="btn btn-danger">Cancel</a>
</form>