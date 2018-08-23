<?php

function spider_audiostream ($url, $id){
	$stream = get_url_header($url);
	if ($stream) {
		if (!empty($stream["icybr"])) {
			$query = 'insert into ms_audiostream (origin_url, origin_id_url, bitrate';
			$values = '"'.$url.'", '.$id.', '.$stream["icybr"];
			if (!empty($stream["contenttype"])) {
				$query = $query.', streamtype'; 
				$values = $values.', "'.$stream["contenttype"].'"'; 
			}
			if (!empty($stream["icyname"])) {
				$query = $query.', name'; 
				$values = $values.', "'.$stream["icyname"].'"'; 
			}
			if (!empty($stream["icygenre"])) {
				$query = $query.', genre'; 
				$values = $values.', "'.$stream["icygenre"].'"'; 
			}
			if (!empty($stream["icyurl"])) {
				$id_website = add_new_url($stream["icyurl"], '', '');
				if ($id_website > 0) {
					$web_site = make_url($id_website); 
					$query = $query.', website';
					$values = $values.', "'.$web_site.'"';
				}
			}
//			if (!empty($stream["icydescription"])) {
//				$query = $query.', desc'; 
//				$values = $values.', "'.$stream["icydescription"].'"'; 
//			}
			db_exec_query($query.') values('.$values.')');
		}
	}
	else {
	   echo "An error occured!  " .magpie_error();
	}
}

?>
