<?php
include_once('simple_html_dom.php');

include_once '/usr/lib/megas/db/connect_db.php';
include_once '/usr/lib/megas/db/db_exec_query.php';
include_once '/usr/lib/megas/urls/add_new_url.php';
include_once '/usr/lib/megas/urls/make_url.php';
include_once '/usr/lib/megas/urls/make_url_link.php';
include_once '/usr/lib/megas/queue/start_queue.php';
include_once '/usr/lib/megas/queue/stop_queue.php';
include_once '/usr/lib/megas/queue/mark_url_queue.php';

$cs = db_exec_query("SET NAMES utf8;");

    // Proccesing each URL

	     $result = db_exec_query("SELECT u.id, u.path, u.id_domain FROM ms_url u, ms_domain d where d.id = u.id_domain and u.id = 458");
	     $row = mysql_fetch_assoc($result);	
            $domain = $row["id_domain"];
            $path = $row["path"];
            $id = $row["id"];
            $url = make_url($id);

            print "URL in progress: {$url} ";
            // Get html by URL
            $html = file_get_html($url);
            if (!$html) {
                print "URL is bad: {$url}" . PHP_EOL;
            } else {

                // Find all href in URL
                foreach ($html->find('a,img') as $element) {
			if ($element->tag === 'a') {
		       	$to_id = add_new_url($element->href, $domain, $path);    
				$r = make_url_link($id, $to_id, $element->plaintext);
			}
			if ($element->tag === 'img') {
		       	$to_id = add_new_url($element->src, $domain, $path);    
				$r = make_url_link($id, $to_id, $element->alt);
			}
                }

		  // Extract URLs	
		  preg_match_all('/(https?:\/\/)(www\.)?([-א-ÿa-z0-9_\.]{2,}\.)(נפ|[a-z0-9]{2,9})?(:[0-9]{2,})?(((\/[-א-ÿa-z0-9_\.\#\!]{1,}){1,})?\/?([a-z0-9_-]\.[a-z])?(\?[a-z0-9_]{1,}=[a-z0-9_-]{1,})?((\&[a-z0-9_-]{1,}=[-0-9]{1,}){1,})?)/i', $html, $matches);
       	  foreach ($matches[0] as $item) {
			print "{$item}".PHP_EOL;
		       $to_id = add_new_url($item, $domain, $path);    
			$r = make_url_link($id, $to_id, '');
            	  }
		  print PHP_EOL;	

            }

    mysql_free_result($result);
?>