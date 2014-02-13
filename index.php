<?php
/**
 * @file
 * index
 *
 * @author Rod Simpson <rod@rodsimpson.com>
 * @since 06-Feb-2014
 */
session_start();

/************************************************
 * USERGRID SETUP
 */
include 'autoloader.inc.php';
$client = new Apigee\Usergrid\Client('1hotrod','whatever');
$client->set_log_callback('SDKNotifications');
$token = isset($_SESSION['token'])?$_SESSION['token']:false;
$client->set_oauth_token($token);
$permissions = array();
$message = false;


/************************************************
 * QUERY PARAMS
 */
$page = (isset ($_GET['page']))?$_GET['page']:'';
$method = isset($_REQUEST['method'])?$_REQUEST['method']:false;


/************************************************
 * SDK CALLBACK FOR NOTIFICATION MESSAGES
 */
function SDKNotifications($message){
  echo "<h4>$message</h4>";
}


/************************************************
 * INCLUDE PAGE HEADER
 */
include 'pages/header.php';


/************************************************
 * ACTIONS
 */
if ($method) {
  if ($method == 'signout') {
    $client->log_out();
    $token=false;
    $_SESSION['token']=false;
    $message = "You have been signed out.";
  }if ($method == 'login') {
    $username = isset($_POST['username'])?$_POST['username']:false;
    $password = isset($_POST['password'])?$_POST['password']:false;
    if ($client->login($username, $password)) {
      $token = $client->get_oauth_token();
      $_SESSION['token'] = $token;
      $message = "You are now logged in. Happy posting!";
    } else {
      $message = "Error: invalid credentials";
    }
  } else if ($method == 'signup') {
    $username = isset($_POST['username'])?$_POST['username']:false;
    $name = isset($_POST['name'])?$_POST['name']:false;
    $password = isset($_POST['password'])?$_POST['password']:false;
    $email = isset($_POST['email'])?$_POST['email']:false;
    $marty =  $client->signup($username, $password,$email, $name);
    if ($client->signup($username, $password)) {
      $token = $client->get_oauth_token();
      $_SESSION['token'] = $token;
      $message = "Account created!";
    } else {
      $message = "Error: invalid credentials";
    }
  } else if ($method == 'add') {
    $title = isset($_POST['title'])?$_POST['title']:'';
    $summary = isset($_POST['summary'])?$_POST['summary']:'';
    $body = isset($_POST['body'])?$_POST['body']:'';
    $endpoint = 'posts';
    $query_string = array();
    $data = array('title'=>$title, 'summary'=>$summary, 'body'=>$body);
    $result = $client->post($endpoint, $query_string, $data);
    if ($result->get_error()){
      $message = "Error: there was a problem creating the post";
    } else {
      $message = "Your post has been added.";
      $page = 'view';
    }
  } else if ($method == 'edit') {
    $title = isset($_POST['title'])?$_POST['title']:'';
    $summary = isset($_POST['summary'])?$_POST['summary']:'';
    $body = isset($_POST['body'])?$_POST['body']:'';
    $endpoint = 'posts';
    $query_string = array();
    $data = array('title'=>$title, 'summary'=>$summary, 'body'=>$body);
    $result = $client->put($endpoint, $query_string, $data);
    if ($result->get_error()){
      $message = "Error: there was a problem updating the post.";
    } else {
      $message = "Your post has been updated.";
      $page = 'view';
    }
  } else if ($method == 'delete') {
    if (isset($_POST['id'])) {
      $endpoint = 'posts/'.$_POST['id'];
      $query_string = array();
      $result =  $client->delete($endpoint, $query_string);
      $result_data = $result->get_data();
      $page = 'view';
      $message = "Your post has been deleted.";
    }
  }
}

/************************************************
 * GET USER PERMISSIONS
 */
if (isset($token) && $token) {
  $endpoint = 'users/me/roles';
  $query_string = array();
  $results = $client->get($endpoint, $query_string);
  if ($results->get_error()){
    $message =  "Error getting user info. <br/>";
  }
  $data = $results->get_data();

  if (isset($data['entities'])) {
    foreach ($data['entities'] as $role) {
      //check for moderator permissions
      if (isset($role['name'])) {
        if ($role['name'] == 'moderator') {
          $permissions['moderator'] = true;
        }
      }
      //check for poster permissions
      if (isset($role['name'])) {
        if ($role['name'] == 'poster') {
          $permissions['poster'] = true;
        }
      }
    }
  }
}

/************************************************
 * DISPLAY USER MESSAGES
 */
 if ($message){ ?> <h4><?=$message;?></h4> <?php }

/************************************************
 * ROUTER
 */
if ($page == 'add') { //add post
  include ('pages/add.php');
} else if ($page == 'edit') { //edit post
  include ('pages/edit.php');
}else if ($page == 'delete') { //edit post
  include ('pages/delete.php');
} else if ($page == 'login') { //login
  include ('pages/login.php');
} else { //default to view of posts
  include ('pages/view.php');
}


/************************************************
 * INCLUDE PAGE FOOTER
 */

include 'pages/footer.php';

?>