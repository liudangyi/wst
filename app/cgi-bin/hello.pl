#!/usr/bin/perl -w
print "Content-type: text/html\n\n";
print "<TITLE>The Hello, World example page</TITLE>";
print "<H1>Hello, World!</H1>";
print "<pre>";
foreach (keys %ENV) {
  print $_, "=", $ENV{$_}, "\n";
}
print "</pre>\n";
