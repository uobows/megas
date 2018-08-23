<?php

function get_domain_id ($domain, $action){
    global $link;
	if (!isset($action)) {
		$action = 0;
	}

	$id_domain = 0;
	static $domains;
	if (!empty($domains)) {
		$id_domain = array_search($domain, $domains);
	}
	if (empty($id_domain)) {
		$pieces = explode(".", $domain);
		$c = count($pieces);
		for($i = $c - 1; $i >= 0; $i--) 
   		{ 
			$level = $c - $i;
      			$domain_piece = $pieces[$i];
			$query = "select id, parent_id from ms_domain where name = '".$domain_piece."' and level = ".$level;
			if (!empty($id_parent)) {
				$query = $query." and parent_id = ".$id_parent;
			}
			$eu = db_exec_query($query);
       		$num_rows = mysqli_num_rows($eu);
       		if ($num_rows > 0) {
              		$row = mysqli_fetch_row($eu);
				$id_parent = $row[0];
				$id_domain = $row[0];
       		}
			else {
				if ($action = 1) {
					if (!empty($id_parent)) {
						$res = db_exec_query("insert into ms_domain (name, parent_id, level) values('".$domain_piece."', ".$id_parent.", ".$level.")");
					}
					else {
						$res = db_exec_query("insert into ms_domain (name, level) values('".$domain_piece."', ".$level.")");
					}
                    $id_domain = mysqli_insert_id($link);
					$id_parent = $id_domain;
				}
			}		
   		}
		$domains[$id_domain] = $domain;
	}
	return $id_domain;
}

?>
