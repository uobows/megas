<?php

function get_crawl_rule ($id_domain, $url_path, $type){
    	$rule = 0;
	if (($url_path === '/')) {
		$rule = 1;
	}
	else {
		$res = db_exec_query("select crawl from ms_domain_rule where id_domain = ".$id_domain);
		$num_rows = mysqli_num_rows($res);
		if ($num_rows > 0) {
			$row = mysqli_fetch_row($res);
			$rule = $row[0];
		}
		else {
			if (!empty($type)) {
				$res = db_exec_query("select crawler from ms_content_type where id = ".$type);
				$num_rows = mysqli_num_rows($res);
				if ($num_rows > 0) {
					$row = mysqli_fetch_row($res);
					$rule = $row[0];
				}
			}
		}
	}
	return $rule;
}

?>
