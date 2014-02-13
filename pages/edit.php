<?php
/**
 * @file
 * edit
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */

$id = (isset ($_GET['id']))?$_GET['id']:'';


$endpoint = 'posts/'.$id;
$query_string = array();
$results = $client->get($endpoint, $query_string);
if ($results->get_error()){
  echo "Error getting posts";
}
$data = $results->get_data();

$data = $data['entities'][0];
$post_title = isset($data['title'])?$data['title']:'';
$post_summary = isset($data['summary'])?$data['summary']:'';
$post_body = isset($data['body'])?$data['body']:'';
?>

<h2>Edit Post</h2>
</br>
<form action="index.php" method="post" role="form">
  <input type="hidden" id="method" name="method" value="edit">
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" value="<?=$post_title;?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea class="form-control" id="body" name="body" placeholder="Post Description"><?=$post_body;?></textarea>
  </div>
  <input type="submit" value="edit" class="btn btn-danger">
  <a href="/index.php" class="btn btn-danger">Cancel</a>
</form>