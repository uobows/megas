<?php

include_once '/usr/lib/megas/db/connect_db.php';
include_once '/usr/lib/megas/db/db_exec_query.php';
include_once '/usr/lib/megas/keywords/extract_and_save.php';
include_once '/usr/lib/megas/urls/make_url.php';
include_once '/usr/lib/megas/urls/add_new_url.php';
include_once '/usr/lib/megas/spiders/rss/rss_fetch.inc';


//function spider_rss ($url, $id){
	
	$result = db_exec_query("SELECT u.id, u.path, u.id_domain FROM ms_url u where u.state = 1 and u.http_code = 200 and u.id_content_type in (10, 17, 22)");
       while ($qi = mysql_fetch_assoc($result)) {
              $id = $qi["id"];
              $url = make_url($id);
		$rss = fetch_rss($url);

		if ($rss) {
			$title = $rss->channel['title'];
			$desc = $rss->channel['description'];
			$link = $rss->channel['link'];
            		print "Channel found: {$title}".PHP_EOL;
			$query  = 'insert into ms_rss_channel (id_origin_url, title';
			$values =  ' values ('.$id.', "'.$title.'"';
			if (!empty($desc)) {
				$query = $query.', description';
				$values = $values.', "'.$desc.'"';
			}
			if (!empty($link)) {
		       	$id_hp = add_new_url($link, '', '');
				$query = $query.', id_homepage';
				$values = $values.', '.$id_hp;
				if (!empty($id_hp)) {
					$query = $query.', web_site';
					$values = $values.', "'.make_url($id_hp).'"';
				}
			}
			$query = $query . ')';
			$values = $values . ')';
			$rss_ins = db_exec_query($query.$values);
		}
		else {
		   echo "An error occured!  " .magpie_error();
		}
//	}
}

?>
