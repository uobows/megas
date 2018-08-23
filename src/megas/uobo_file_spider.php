<?php
include_once('simple_html_dom.php');

include_once '/var/www/lib/connect_uobo_db.php';

// Check queue state
$qs = mysql_query("SELECT value FROM uobo_parametrs where name = 'queue_state';");
if (mysql_affected_rows($link) > 0) {
    $row = mysql_fetch_row($qs);
    $queue_state = $row[0];
}
if ($queue_state === 'stop') {
    exit;
};

// Processing URLs with file
$result = mysql_query("SELECT f.id, u.url FROM uobo_url_files f, uobo_urls u where u.id = f.url_id and f.url_modified > ifnull(f.downloaded, 0) and not (u.http_code >= 300 and u.http_code < 400);");
if (!$result) {
    echo 'Ошибка запроса: ' . mysql_error();
    exit;
}
// Proccesing each URL
while ($row = mysql_fetch_assoc($result)) {
    $url = $row["url"];
    $f_id = $row["id"];
    $pos = strrpos($url, '/');
    $filename = substr($url, $pos+1);
    $pos = strrpos($url, '.');
    $ext = substr($url, $pos+1);
    $error = 0;
    
    $dest = '//data//files//file_id_'.$f_id.'.bin';
    print "URL in progress: {$url}";
    if (!copy($url, $dest)) {
        print " - error!".PHP_EOL;
        $error = 1;
    }
    else {
        print " - OK".PHP_EOL;
    }    
    $up_res = mysql_query("update uobo_url_files set downloaded = now(), error = ".$error.", filename = '" . $filename . "', extension = '" . $ext ."'  where id = " . $f_id);
    if (!$up_res) {
        $rsd = mysql_error();
        print "Error up {$rsd}";
    }
}
mysql_free_result($result);

?>