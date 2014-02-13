<?php
/**
 * @file
 * delete
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */

$id = (isset ($_GET['id']))?$_GET['id']:'';
?>

<b>Are you sure you want to delete this post?</b>
</br>
<form action="index.php" method="post">
  <input type="hidden" id="method" name="method" value="delete">
  <input type="hidden" id="id" name="id" value="<?=$id;?>">
  </br>
  <input type="submit" value="Delete" class="btn btn-danger">
  <a href="/index.php" class="btn btn-danger">Cancel</a>
</form>