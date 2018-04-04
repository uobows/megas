<?php

function get_spider ($type){
    $spider = -1;
	$res = db_exec_query("select spider from ms_content_type where id = ".$type);
    $num_rows = mysqli_num_rows($res);
    if ($num_rows > 0) {
       	$row = mysqli_fetch_row($res);
		$spider = $row[0];
	}
	return $spider;
}

?>
