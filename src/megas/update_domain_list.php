<?php

include_once '/var/www/lib/connect_uobo_db.php';

print "Update domain list...".PHP_EOL;
$eu = mysql_query("call uobo.update_domain_list");
?>