<?php
/**
 * @file
 * view
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */

if ((isset($permissions['moderator']) && $permissions['moderator']) || (isset($permissions['poster']) && $permissions['poster'])) {
  ?>
  <a href="/index.php?page=add" class="btn btn-danger" style="margin-bottom: 10px;">Add new Post</a>
  <?php
}
?>

<?php
$endpoint = 'posts';
$query_string = array("ql"=>"order by created DESC", "limit"=>"100");
$results = $client->get($endpoint, $query_string);
if ($results->get_error()){
  echo "Error getting posts";
}
$data = $results->get_data();

foreach ($data['entities'] as $post) {
  $created = '';
  if (isset($post['created'])) {
    $timestamp  = substr($post['created'],0,10);
    $created = date('Y-m-d H:i:s', $timestamp);
  }
  ?>

  <div style="border:1px solid black; padding: 10px;">
    <h3><?= isset($post['title'])?$post['title']:''; ?></h3></br>
    <?= isset($post['body'])?$post['body']:''; ?></br></br>

    <?php if (isset($permissions['moderator']) && $permissions['moderator']) { ?>
      <div style="float: right">
        <a href="/index.php?page=edit&id=<?=isset($post['uuid'])?$post['uuid']:'';?>" class="btn btn-danger">Edit</a>
        <a href="/index.php?page=delete&id=<?=isset($post['uuid'])?$post['uuid']:'';?>" class="btn btn-danger">Delete</a>
      </div>
    <?php } ?>
    Posted on: <b><?= $created; ?></b></br></br>
  </div>
  <div style="height: 20px;">&nbsp;</div>
<?php
}
?>
