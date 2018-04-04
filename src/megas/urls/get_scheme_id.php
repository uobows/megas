<?php

function get_scheme_id ($scheme){
    $id = null;
	static $schemas;
	if (!empty($schemas)) {
		$id = array_search($scheme, $schemas);
	}
	if (empty($id)) {
		$res = db_exec_query("select id, id_parent from ms_scheme where name = '".$scheme."'");
	      	$num_rows = mysqli_num_rows($res);
	      	if ($num_rows > 0) {
	             	$row = mysqli_fetch_row($res);
			$id = $row[0];
			if (!empty($row[1])) {
				$id = $row[1];
			}
		}
		else {
			$res = db_exec_query("insert into ms_scheme (name) values('".$scheme."')");
              	$id = mysqli_insert_id();
		}
		$schemas[$id] = $scheme;
	}
	return $id;
}

?>
