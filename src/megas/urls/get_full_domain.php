<?php

function get_full_domain ($id_domain){
    	$domain = null;

	static $domains;
	if (!empty($domains)) {
		if (array_key_exists($id_domain, $domains)) {
    			$domain = $domains[$id_domain];
		}
	}
	if (empty($domain)) {
		$res = db_exec_query('select name, parent_id from ms_domain where id = ' . $id_domain);
		$row = mysqli_fetch_assoc($res);
		$domain = $row["name"];
		if (!empty($row["parent_id"])) {
			$domain = $domain . '.' . get_full_domain($row["parent_id"]);
		}
		$domains[$id_domain] = $domain;
	}
	return $domain;
}

?>
