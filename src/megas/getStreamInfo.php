<?php
include_once 'db/connect_db.php';
include_once 'db/db_exec_query.php';
include_once 'streams/streaminfo.php';
include_once 'streams/get_current_title.php';
include_once 'urls/make_url.php';

// Processing URLs with file
$result = db_exec_query("SELECT id, origin_url as url, name as title FROM ms_audiostream order by id asc");
if (!$result) {
    echo 'РћС€РёР±РєР° Р·Р°РїСЂРѕСЃР°: ' . mysql_error();
    exit;
}

// Proccesing each radiostation
while ($row = mysqli_fetch_assoc($result)) {
    $url = $row["url"];
    $radio_name = $row["title"];
    $radio_id = $row["id"];
    print "Radio: {$url} ";
    $t = get_current_title($url);
    if ($t != '') {
            print "Title: {$t}" . PHP_EOL;

    }
    else {
            print " no title" . PHP_EOL;

    }
}
mysql_free_result($result);

?>