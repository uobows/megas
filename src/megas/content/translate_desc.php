<?php

include_once '/var/www/lib/content/translate_content.php';
include_once '/var/www/lib/db/db_exec_query.php';
include_once '/var/www/lib/db/connect_uobo_db.php';


function translate_desc ($radio_id, $from_lang, $to_lang){
    $res = db_exec_query("select short_descript, descript from uobo_radiostation where id = ".$radio_id);
    if (mysql_affected_rows() > 0) {
        $row = mysql_fetch_row($res);
        $short = $row[0];
        $descript = $row[1];
    }
    if ($from_lang !== $to_lang) {
        if (!empty($short)) {
            $short = translate_content($short, $from_lang, $to_lang);
        }
        if (!empty($descript)) {
            $descript = translate_content($descript, $from_lang, $to_lang);
        }
    }

    $chk = db_exec_query('select * from uobo_radiostation_desc where id = '.$radio_id.' and lang = "'.$to_lang.'"');
    if (mysql_affected_rows() === 0) {
        $query = 'insert into uobo_radiostation_desc (radio_id, lang, short_descript, descript) values(';
        $query = $query . $radio_id . ', "' . $to_lang . '", "' . $short . '", "' . $descript . '")';
        $res = db_exec_query($query);
    }
    
    return 1;
}

?>
