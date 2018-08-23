<?php

function add_new_url ($new_url, $id_domain, $parent_path){
    $new_id = null;
    $new_url = str_replace(' ','',$new_url);    
    $new_url = trim($new_url);
	$new_url = str_replace("://www.", "://", $new_url);
	global $link;

	$is_bs = substr($new_url, strlen($new_url) - 1, 1);
       if ($is_bs === '/' ) {
       	$new_url = substr($new_url, 0, strlen($new_url) - 1);
       }
              
	$new_url = substr($new_url, 0, 254);
	//print "{$new_url}".PHP_EOL;
	$parsed_url = parse_url($new_url);
	if (isset($parsed_url["scheme"])) {
       	$scheme = strtolower($parsed_url["scheme"]);
	}
	else {
       	$scheme = 'http';
	}
	$scheme_id = get_scheme_id($scheme);

	if (isset($parsed_url["host"])) {
       	$domain = strtolower($parsed_url["host"]);
	}
	else {
       	$domain = '';
	}
	if (isset($parsed_url["port"])) {
       	$port = $parsed_url["port"];
	}
	else {
       	$port = null;
	}
	if (isset($parsed_url["path"])) {
      		$path = $parsed_url["path"];
		if (empty($path)) {
			$path = '/';
		}
		else {
			if (($path[0] != '/') and ($path[strpos($parent_path,'/')] === '/')) {
				$path = $parent_path.$path;
			}
		}
       }
	else {
		$path = '/';
	}
	$path = substr($path, 0, 254);

	if (!empty($parsed_url["query"])) {
       	$query = $parsed_url["query"];
	}
	else {
       	$query = null;
	}
	$query = substr($query, 0, 127);

	if (empty($domain)) {
       	$domain_id = $id_domain;
		$domain = get_full_domain($id_domain);
	} else {
		$domain_id = get_domain_id($domain, 1);
	}

	$theURL = $scheme."://".$domain;
	if (!empty($port)) {
		$theURL = $theURL.":".$port;
	}
	$theURL = $theURL.$path;
	if (!empty($query)) {
		$theURL = $theURL."?".$query;
	}

	// check exists URL
	static $URLs;
	if (!empty($URLs)) {
		$new_id = array_search($theURL, $URLs);
	}

	if (empty($new_id)) {   
		$q = "SELECT id FROM ms_url where substr(lower(path), 1, 256) = substr(lower('" . $path . "'), 1, 256) and id_domain = " . $domain_id . " and id_scheme = ".$scheme_id;
		if (!empty($port)) {
			$q = $q." and port = ".$port;
		}
		if (!empty($query)) {
			$q = $q.' and substr(lower(query), 1, 128) = substr(lower("'.$query.'"), 1, 128)';
		}
		$eu = db_exec_query($q);
		$num_rows = mysqli_num_rows($eu);
		if ($num_rows > 0) {
				$row = mysqli_fetch_row($eu);
				$new_id = $row[0];
				print ".";

		} else {
			// URL decision
			//$toAdd = 1;

			$toAdd = 0;
			$uh = get_url_header($theURL);
			if (!empty($uh)) {
				if (($uh["httpcode"] >= 200) and ($uh["httpcode"] < 400)) {
					if (isset($uh["contenttype"])) {
						if (get_store_rule($domain_id, $path.$query, get_content_type($uh["contenttype"])) == 1) {
							$toAdd = 1;
						}
						else print "z";
					}
				}
			}
			if ($toAdd == 1 ) {
						print "+";
				$iq = "insert into ms_url (path, id_domain, id_scheme";
				$iv = "values('" . $path . "', " . $domain_id . ", ".$scheme_id;
					// insert new url into db
				if (!empty($port)) {
						$iq = $iq.", port";
					$iv = $iv.", ".$port;
				}
				if (!empty($query)) {
						$iq = $iq.", query";
					$iv = $iv.", '".$query."'";
				}
				$ins_res = db_exec_query($iq.") ".$iv.")");	
					if ($ins_res) {
						$new_id = mysqli_insert_id($link);
						db_exec_query("insert into ms_global_queue (id_url, type) values(".$new_id.", 1)");
						}
			} else $new_id = -1;

		}
		if ($new_id != -1) { $URLs[$new_id] = $theURL; }
	} else print "c";

	return $new_id;
}

?>
