<h1>WIP!!</h1>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$query = "SELECT Guest_Name, Gender from guest";

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
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
print $result;
for($row_num=0; $row_num < $num_rows; $row_num ++){
    $row=mysql_fetch_array($result);
    print "<p> Result row number " . ($row_num +1)." Geust_Name:";
    print htmlspecialchars($row["Guest_Name"]);
    print "  Gender:";
    print htmlspecialchars($row["Gender"]);
    print "</p>";
}
