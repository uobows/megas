<?php


function extract_and_save ($pending, $id_url, $separator){
	// Correct separator
	$pieces = explode($separator, $pending);
	$c = count($pieces);
	if (isset($c)) {
		for($i = 0; $i < $c ; $i++) 
   		{ 
      		$id_keyword = get_keyword_id($pieces[$i]);
			$res = db_exec_query("select * from ms_url_keyword where id_url = ".$id_url." and id_keyword = ".$id_keyword);
      			$num_rows = mysqli_num_rows($res);
      			if ($num_rows == 0) {
				$res = db_exec_query("insert into ms_url_keyword (id_url, id_keyword) values(".$id_url.", ".$id_keyword.")");
			}
   		}
	}
	return $c;
}

?>
