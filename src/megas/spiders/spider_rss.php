<?php

function spider_rss ($url, $id){
		$rss = @fetch_rss($url);
		if ($rss) {
			$title = str_replace('"', '', $rss->channel['title']);
			$desc = str_replace('"', '', $rss->channel['description']);
			$link = $rss->channel['link'];
            print "Channel found: {$title}".PHP_EOL;
			$query  = 'insert into ms_rss_channel (guid, id_origin_url, title';
			$values =  ' values (uuid(), '.$id.', "'.trim($title).'"';
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
}

?>
