<?php

include_once '/var/www/lib/connect_uobo_db.php';
include_once '/var/www/lib/content/get_content_lang.php';
include_once '/var/www/lib/content/translate_desc.php';

// Check queue state
//$qs = mysql_query("SELECT value FROM uobo_parametrs where name = 'queue_state';");
//if (mysql_affected_rows($link) > 0) {
//    $row = mysql_fetch_row($qs);
//    $queue_state = $row[0];
//}
//if ($queue_state === 'stop') {
//    exit;
//};

// Processing URLs with file
$result = mysql_query("SELECT id, language, short_descript, descript FROM uobo_v_radio_2_update;");
if (!$result) {
    echo 'Ошибка запроса: ' . mysql_error();
    exit;
}

// Proccesing each URL
while ($row = mysql_fetch_assoc($result)) {
    $r_id = $row["id"];
    print "Radio ID {$r_id} ";
    $up_res = mysql_query("call uobo.update_radio_info(".$r_id.");");
    if (!$up_res) {
        $rsd = mysql_error();
        print " error up {$rsd} ";
    }
    $lang = $row["language"];
    if (empty($lang)) {
        $desc = $row["short_descript"];
        if (empty($desc)) {
            $desc = $row["descript"];
        }
        if (!empty($desc)) {
            $lang = get_content_lang($desc);
            $up_res = mysql_query("update uobo.uobo_radiostation set language = '".$lang."' where id = ".$r_id.";");
            if (!$up_res) {
                $rsd = mysql_error();
                print " error up {$rsd} ";
            }
            translate_desc($r_id, $lang, 'ru');
            translate_desc($r_id, $lang, 'en');
            
        }
    }
    print " - OK".PHP_EOL;
}
mysql_free_result($result);
return;
?>