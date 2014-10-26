#!/usr/bin/perl -w

use CGI ":standard";

sub error {
  print header('text/html', '500 Internal Server Error');
  print start_html("Error");
  print "<h1>ERROR</h1> File could not be opened.";
  print end_html();
  exit(1);
}

$LOCK = 2;
$UNLOCK = 8;

open(QUESFILE, "<questionare.dat") or error();
flock(QUESFILE, $LOCK);
@lines = <QUESFILE>;
flock(QUESFILE, $UNLOCK);
close(QUESFILE);

foreach (param()) {
  delete $lines[$_];
}

open(QUESFILE, ">questionare.dat") or error();
flock(QUESFILE, $LOCK);
print QUESFILE @lines;
flock(QUESFILE, $UNLOCK);
close(QUESFILE);

print header('text/plain', '204 No Response');
