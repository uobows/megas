<?php
include_once('simple_html_dom.php');

include_once '/var/www/lib/connect_uobo_db.php';
include_once '/var/www/lib/utils/add_new_url.php';


// Check queue state
$qs = mysql_query("SELECT value FROM uobo_parametrs where name = 'queue_state';");
if (mysql_affected_rows($link) > 0) {
    $row = mysql_fetch_row($qs);
    $queue_state = $row[0];
}

//if ($queue_state === 'stop') {
//    return;
//};

print "Start new session:" . PHP_EOL;

// Processing URLs in session
$result = mysql_query("SELECT id, filename, extension FROM uobo_v_files_2_crawl");
if (!$result) {
    echo 'Query Error: ' . mysql_error();
    exit;
}

// Proccesing each URL
try {
    while ($row = mysql_fetch_assoc($result)) {
        $filename = $row["filename"];
        $ext = $row["extension"];
        $id = $row["id"];
        print "File in progress: {$filename} - ";

        $file = file_get_contents('//data//files//file_id_'.$id.'.bin');
        if (!empty($file)) {
            print "OK".PHP_EOL;
            preg_match_all('!https?://[\S]+!', $file, $matches);
            foreach ($matches[0] as $item) {
                $url_id = add_new_url($item, '');
                print "URL {$url_id} - {$item}".PHP_EOL;
                if (!empty($url_id)) {
                    $ins_res = mysql_query("insert into uobo_url_from_files (file_id, url_id) values(" . $id . ", " . $url_id . ");");
                }
            }
            $up_res = mysql_query("update uobo_url_files set processed = now() where id = " . $id);
            if (!$up_res) {
                $rsd = mysql_error();
                print "Error up {$rsd}";
            }
            sleep(5);
        }
        else {
            print "Error!".PHP_EOL;
        }
    }
} catch (Exception $exception) {
    print "Exception: {$exception}" . PHP_EOL;
}
mysql_free_result($result);

?>