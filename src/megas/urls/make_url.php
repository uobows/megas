<?php

function make_url ($url_id){
	$new_url = null;
	static $URLs;
	if (!empty($URLs)) {
		if (array_key_exists($url_id, $URLs)) {
			$new_url = $URLs[$url_id];
		}
	}

	if (empty($new_url)) {
    		$result = db_exec_query("SELECT u.id, u.path, u.id_domain, s.name as scheme, u.port, u.query FROM ms_url u, ms_scheme s where s.id = u.id_scheme and u.id = " . $url_id);
		$row = mysqli_fetch_assoc($result);
       	$domain = $row["id_domain"];
       	$path = $row["path"];
       	$scheme = $row["scheme"];
       	$port = $row["port"];
       	$query = $row["query"];
       	$id = $row["id"];
		$domain_name = get_full_domain($domain);

    		$new_url = $scheme.'://'.$domain_name;
		if (!empty($port)) {
			$new_url = $new_url.':'.$port;
		}
		$new_url = $new_url.$path;
		if (!empty($query)) {
			$new_url = $new_url.'?'.$query;
		}
		$URLs[$url_id] = $new_url;
	}
	return $new_url;
}

?>
