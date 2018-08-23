<?php

function make_url_link ($link_from, $link_to, $link_name){
	$id = null;
	if ((!empty($link_to)) and ($link_to !== -1)) {
		$res = db_exec_query("select to_id from ms_url_link where from_id = ".$link_from." and to_id = ".$link_to);
      		$num_rows = mysqli_num_rows($res);
      		if ($num_rows > 0) {
			$id = null;
		}
		else {
			$res = db_exec_query("insert into ms_url_link (from_id, to_id) values(".$link_from.", ".$link_to.")");
		}
		if (!empty($link_name)) {
    			$link_name = str_replace('"','',$link_name);    
			$res = db_exec_query('update ms_url_link set link_name = trim("'.$link_name.'") where from_id = '.$link_from.' and to_id = '.$link_to);
			//extract_and_save($link_name, $link_to, ' ');	    
		}
	}
	return $id;
}

?>
