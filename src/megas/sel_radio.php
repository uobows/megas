<?php
$url = $_GET['urlid'];

include_once 'connect_uobo_db.php';

$eu = mysql_query("call uobo.sel_url_4_radio(".$url.");");
if (!$eu) {
    echo 'Error: ' . mysql_error() . '</br>';
}
echo $url.' selected.';

?>