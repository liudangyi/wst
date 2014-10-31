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
if ($_REQUEST["name"]) {
  $name =mysql_escape_string($_REQUEST['name']);
  $age = mysql_escape_string($_REQUEST['age']);
  $gender = mysql_escape_string($_REQUEST['gender']);
  $email = mysql_escape_string($_REQUEST['email']);
  mysql_query("INSERT INTO guest VALUES (NULL, '$name', '$age', '$gender', '$email')");
  if ($_REQUEST["parties"]) {
    $id = mysql_fetch_array(mysql_query("SELECT Guest_ID FROM guest ORDER BY Guest_ID DESC LIMIT 1"))[0];
    foreach ($_REQUEST["parties"] as $key => $value) {
      mysql_query("INSERT INTO `guest-party` VALUES ('$id', '$key')");
    }
  }
}
if ($id = intval($_REQUEST["delete"])) {
  mysql_query("delete from `guest-party` where Guest_ID = $id");
  mysql_query("delete from `guest` where Guest_ID = $id");
}
?><!DOCTYPE html>
<title>Guest Book</title>
<link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="styles/446ce9bb.main.css">
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
  <h1>Guest Book</h1>
  <form id="form" class="form-horizontal" method="post">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name">
      </div>
    </div>
    <div class="form-group">
      <label for="age" class="col-sm-2 control-label">Age</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="age" name="age">
      </div>
    </div>
    <div class="form-group">
      <label for="age" class="col-sm-2 control-label">Gender</label>
      <div class="col-sm-10">
        <select class="form-control" name="gender">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Parties</label>
      <div class="col-sm-10">
        <div class="checkbox">
        <?php $result = mysql_query("select * from party"); while ($rec = mysql_fetch_array($result)) { ?>
          <label><input type="checkbox" name="parties[<?php echo $rec[0] ?>]"><?php echo $rec[1], ", ", $rec[2], ", ", $rec[3] ?></label>
        <?php } ?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Email</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php $result = mysql_query("select * from guest"); while ($rec = mysql_fetch_array($result)) { ?>
      <tr>
        <td><?php echo $rec[1] ?></td>
        <td><?php echo $rec[2] ?></td>
        <td><?php echo $rec[3] ?></td>
        <td><?php echo $rec[4] ?></td>
        <td>
          <a href="?id=<?php echo $rec[0] ?>">activity(<?php echo mysql_fetch_array(mysql_query("select count(*) from `guest-party` where Guest_ID = $rec[0]"))[0]; ?>)</a> |
          <a href="?delete=<?php echo $rec[0] ?>">delete</a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php if ($id = intval($_REQUEST["id"])) { ?>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Time</th>
        <th>Place</th>
        <th>Host name</th>
      </tr>
    </thead>
    <tbody>
    <?php $result = mysql_query(stripslashes("select * from `guest-party` gp, party p, guest g where gp.Guest_ID = g.Guest_ID and gp.Party_Num = p.Party_Num and g.Guest_ID = $id"));
          while ($rec = mysql_fetch_array($result)) { ?>
      <tr>
        <td><?php echo $rec[7] ?></td>
        <td><?php echo $rec[3] ?></td>
        <td><?php echo $rec[4] ?></td>
        <td><?php echo $rec[5] ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>

