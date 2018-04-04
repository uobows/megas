<?php

function get_title_id ($title){
    $eu = mysql_query('SELECT id FROM uobo_title where lower(full_title) = lower("' . $title . '")');
    $num_rows = mysql_num_rows($eu);
    if ($num_rows > 0) {
          $row = mysql_fetch_row($eu);
          $title_id = $row[0];
    } else {
          // insert new title into db
          $ins_res = mysql_query('insert into uobo_title (full_title) values("' . $title . '")');
          if ($ins_res) {
                $title_id = mysql_insert_id();
         }
    }    
    return $title_id;
}

?>
