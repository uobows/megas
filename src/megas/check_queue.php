<?php

include_once 'db/connect_uobo_db.php';

print "Check Queue.".PHP_EOL;
$eu = mysql_query("call uobo.check_queue");

?>