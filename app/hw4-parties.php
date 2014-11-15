<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
$db = mysql_connect("localhost", "usr_2014_5", "internetics");
if (!$db) {
    print "Error - Could not connect to MySQL";
    exit;
}
$er = mysql_select_db("db_2014_5");
if (!$er) {
    print "Error - Could not select the guest database";
    exit;
}
if ($_REQUEST["time"]) {
  $time = mysql_escape_string($_REQUEST['time']);
  $place = mysql_escape_string($_REQUEST['place']);
  $hostname = mysql_escape_string($_REQUEST['hostname']);
  mysql_query("INSERT INTO party VALUES (NULL, '$time', '$place', '$hostname')");
}
if ($id = intval($_REQUEST["delete"])) {
  mysql_query("delete from `guest-party` where Party_Num = $id");
  mysql_query("delete from `party` where Party_Num = $id");
}
?><!DOCTYPE html>
<title>Manage Parties</title>
<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">
<!-- build:css(.tmp) styles/main.css -->
<link rel="stylesheet" href="styles/main.css" />
<!-- endbuild -->
<style>
  #form {
    width: 500px;
    margin: 20px auto;
  }
</style>
<div class="container">
  <h1>Manage Parties</h1>
  <form id="form" class="form-horizontal" method="post">
    <div class="form-group">
      <label for="time" class="col-sm-3 control-label">Time</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="time" name="time">
      </div>
    </div>
    <div class="form-group">
      <label for="place" class="col-sm-3 control-label">Place</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="place" name="place">
      </div>
    </div>
    <div class="form-group">
      <label for="hostname" class="col-sm-3 control-label">Host name</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="hostname" name="hostname">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
  <table class="table">
    <thead>
      <tr>
        <td>ID</td>
        <th>Time</th>
        <th>Place</th>
        <th>Host name</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php $result = mysql_query("select * from party"); while ($rec = mysql_fetch_array($result)) { ?>
      <tr>
        <td><?php echo $rec[0] ?></td>
        <td><?php echo $rec[1] ?></td>
        <td><?php echo $rec[2] ?></td>
        <td><?php echo $rec[3] ?></td>
        <td><a href="?delete=<?php echo $rec[0] ?>">delete</a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
