<?php

function add_title_to_playlist ($radio_id, $title_id){
    // get last item in playlist
    $item_id = 0;
    $eu = mysql_query('SELECT id, title_id FROM uobo.uobo_radiostation_playlist l where l.radio_id = ' . $radio_id . ' and l.start_at = (select max(r.start_at) from uobo.uobo_radiostation_playlist r where r.radio_id = l.radio_id);');
    $num_rows = mysql_num_rows($eu);
    if ($num_rows > 0) {
          $row = mysql_fetch_row($eu);
          $item_id = $row[0];
          $item_title_id = $row[1];
          if ($item_title_id === $title_id) {
            $up_res = mysql_query('update uobo_radiostation_playlist set start_at = now() where id = ' . $item_id );
          }
          else {
            $item_id = 0;
          }
    }      
    if ($item_id === 0) {
    // insert new item into playlist
      $ins_res = mysql_query('insert into uobo_radiostation_playlist (title_id, radio_id, start_at) values(' . $title_id . ', ' . $radio_id . ', now())');
      if ($ins_res) {
            $item_id = mysql_insert_id();
      }
    }
     return $item_id;
}
?>
