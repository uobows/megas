<?php
$id = $_GET['id'];
$act = $_GET['act'];

include_once '\var\www\lib\connect_uobo_db.php';

if ($act === 'apr') {
    $eu = mysql_query("call uobo.approve_radio(".$id.");");
    echo 'ID ' . $id . ' - Approved';
}
if ($act === 'clr') {
    $eu = mysql_query("call uobo.clear_radio(".$id.");");
    echo 'ID ' . $id . ' - Cleared';
}
if ($act === 'pub') {
    $eu = mysql_query("call uobo.publish_radio(".$id.");");
    echo 'ID ' . $id . ' - Published';
}
if ($act === 'unpub') {
    $eu = mysql_query("call uobo.unpublish_radio(".$id.");");
    echo 'ID ' . $id . ' - Unpublished';
}

if (!$eu) {
    echo 'Error: ' . mysql_error() . '</br>';
}

?>