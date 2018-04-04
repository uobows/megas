<?php
$domain_id = $_GET['domain_id'];

include_once '/var/www/lib/connect_uobo_db.php';

$ins_res = mysql_query("insert into uobo_domains_radio (id) values(".$domain_id.")");
if (!$ins_res) {
	echo 'Error: Insert radio domain ' . mysql_error() . '</br>';
}
echo $domain_id.' added';

?>