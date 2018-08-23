<?php
$domain = $_GET['domain'];
if ($_GET['act'] == 'inc') {
  $act = 1;
}
else {
  $act = -1;
}

include_once '../lib/connect_uobo_db.php';

$eu = mysql_query("SELECT id FROM uobo_domains where domain = '".$domain."'");
if (mysql_affected_rows($link) > 0) {
    $row = mysql_fetch_row($eu);
    $id = $row[0];
	$up_res = mysql_query("update uobo_domains set search_state = ".$act." where id = ".$id);
	if (!$up_res) {
		echo 'Error: Update search status ' . mysql_error() . '</br>';
	}
}  
else {
	$ins_res = mysql_query("insert into uobo_domains (domain, search_state) values('".$domain."', '".$act."')");
	if (!$ins_res) {
		echo 'Error: Insert domain ' . mysql_error() . '</br>';
	}
}
echo $domain.' to '.$act;

?>