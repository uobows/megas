<?php

function get_content_type ($type){
    	$id = null;
	$type = strtolower($type);
       
	$pos = strpos($type, ';');
       if (!empty($pos)) {
           $type = substr(strtolower($type), 0, $pos);
       }

	static $content_types;
	if (!empty($content_types)) {
		$id = array_search($type, $content_types);
	}
	if (empty($id)) {
		$res = db_exec_query("select id from ms_content_type where lower(name) = lower('".$type."')");
      		$num_rows = mysqli_num_rows($res);
      		if ($num_rows > 0) {
             		$row = mysqli_fetch_row($res);
			$id = $row[0];
		}
		else {
			$res = db_exec_query("insert into ms_content_type (name) values(lower('".$type."'))");
              	$id = mysqli_insert_id();
		}
		$content_types[$id] = $type;
	}
	return $id;
}

?>
