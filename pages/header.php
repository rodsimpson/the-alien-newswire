<!DOCTYPE html>
<html lang="en">
<head>
  <title>The Alien Newswire</title>
  <meta charset="utf-8">
  <meta name="description" content="The Alien Newswire" />
  <meta name="keywords" content="The Alien Newswire" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/css/styles.css" type="text/css" />
</head>
<body>
<div style="text-align: right; padding: 10px;">
  <h1 style="margin-top: 10px;"><a href="/index.php" class="logo">The Alien Newswire</a></h1>
  <h3 style="margin-top: -5px">...post em if you see em</h3>
  <div style="float: right"><a href="/index.php?page=login">Login</a></div>
  <?php
  if (isset($token) && $token) {
  ?>
    <div style="float: right; margin-right: 10px"><a href="/index.php?method=signout">sign out</a></div>
  <?php } else { ?>
    <div style="float: right; margin-right: 10px"><a href="/index.php?page=signup">sign up</a> </div>
  <?php } ?>
</div>
<div style="padding: 10px">

