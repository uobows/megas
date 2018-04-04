<?php

include_once '/var/www/lib/connect_uobo_db.php';

$eu = mysql_query("call uobo.stop_queue");
print "Update domain list...".PHP_EOL;
$eu = mysql_query("call uobo.update_domain_list");
print "Mark bad domains...".PHP_EOL;
$eu = mysql_query("call uobo.update_domain_state");
//print "Spider Queue: Updating...".PHP_EOL;
//$eu = mysql_query("call uobo.update_spider_queue;");
//print "Crawler Queue: Updating...".PHP_EOL;
//$eu = mysql_query("call uobo.update_crawler_queue;");
$eu = mysql_query("call uobo.start_queue");

?>