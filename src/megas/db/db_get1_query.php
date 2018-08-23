<?php

function db_get1_query($query){
    global $link;
    $val = null;	
    $result = db_exec_query($query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
          	$row = mysqli_fetch_row($result);
		$val = $row[0];
    }
	
    return $val;
}

?>
