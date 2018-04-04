<?php

function get_store_rule ($id_domain, $url_path, $type){
	$rule = 0;
	if (($url_path === '/')) {
		$rule = 1;
	}
	else {
		$res = db_exec_query("select crawl, pattern from ms_domain_rule where id_domain = ".$id_domain);
		$num_rows = mysqli_num_rows($res);
		if ($num_rows > 0) {
			$row = mysqli_fetch_row($res);
			$rule = $row[0];
			if ($rule = 1) {
				$pattern = $row[1];
				if (!empty($pattern)) {
					preg_match($pattern, $url_path, $matches);
					if (!empty($matches)) {
						$rule = 1;
					} 
					else {
						$rule = 0;
					}
				}
			}
		}
		else 
		{
			if (!empty($type)) {
				$res = db_exec_query("select store from ms_content_type where id = ".$type);
      			$num_rows = mysqli_num_rows($res);
      			if ($num_rows > 0) {
             		$row = mysqli_fetch_row($res);
					$rule = $row[0];
				}
			}
		}
	}
	//print PHP_EOL."{$url_path}";
	return $rule;
}

?>
