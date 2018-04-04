<?php

function get_keyword_id ($keyword){
    global $link;
	$id = null;
	$keyword = trim($keyword);
	// Cleanup punctuation
	$keyword = preg_replace("|[^\d\w ]+|i","",$keyword);
	$keyword =  preg_replace("/\s{2,}/",' ',$keyword);
	$keyword = trim($keyword);

	$res = db_exec_query("select id from ms_keyword where lower(keyword) = lower('".$keyword."')");
      	$num_rows = mysqli_num_rows($res);
      	if ($num_rows > 0) {
             	$row = mysqli_fetch_row($res);
		$id = $row[0];
	}
	else {
		$res = db_exec_query("insert into ms_keyword (keyword) values(lower('".$keyword."'))");
              $id = mysqli_insert_id($link);
	}
	return $id;
}

?>
