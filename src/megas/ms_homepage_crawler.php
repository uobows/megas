<?php
include_once 'db/connect_db.php';
include_once 'db/db_exec_query.php';
include_once 'db/db_insert_query.php';
include_once 'db/db_get1_query.php';
include_once 'queue/fill_queue.php';
include_once 'queue/check_queue.php';
include_once 'queue/start_queue.php';
include_once 'queue/stop_queue.php';
include_once 'queue/mark_url_queue.php';
include_once 'urls/make_url.php';
include_once 'urls/make_url_link.php';
include_once 'urls/add_new_url.php';
include_once 'urls/get_content_type.php';
include_once 'urls/get_url_header.php';
include_once 'queue/start_url_queue.php';
include_once 'urls/get_url_header.php';
include_once 'urls/get_domain_id.php';
include_once 'urls/get_full_domain.php';
include_once 'urls/get_content_type.php';
include_once 'urls/get_scheme_id.php';
include_once 'urls/get_store_rule.php';
include_once 'simple_html_dom.php';

$cs = db_exec_query("SET NAMES utf8;");

$id_queue = null;
do {
if (!empty($id_queue)) {

    // Processing URLs in session
    $q = db_exec_query("SELECT url_id from ms_queue_list where queue_id = ".$id_queue);

    // Proccesing each URL
    try {
       while ($qi = mysqli_fetch_assoc($q)) {

		$result = db_exec_query("SELECT h.title, h.origin_url, u.* FROM ms_homepage h, ms_url u, ms_domain d where d.id = u.id_domain and u.id = h.origin_id_url and h.origin_id_url = ".$qi["url_id"]);
		$row = mysqli_fetch_assoc($result);
		$url = $row["origin_url"];

		print PHP_EOL."Homepage: {$row['title']}".PHP_EOL;
		$html = file_get_html($url);
		if (!$html) {
			print "URL is bad: {$url}" . PHP_EOL;
		} else {
			start_url_queue($id_queue, $url);
			
			// Find all href in URL
			$domain = $row["id_domain"];
			$path = $row["path"];
			$id = $row["id"];

			foreach ($html->find('a,img') as $element) {
			if ($element->tag === 'a') {
				$to_id = add_new_url($element->href, $domain, $path);    
//				print "{$element->href}". PHP_EOL;
				$r = make_url_link($id, $to_id, $element->plaintext);
				}
			}

			// Extract URLs	
			preg_match_all('/(https?:\/\/)(www\.)?([-�-�a-z0-9_\.]{2,}\.)(��|[a-z0-9]{2,9})?(:[0-9]{2,})?(((\/[-�-�a-z0-9_\.\#\!]{1,}){1,})?\/?([a-z0-9_-]\.[a-z])?(\?[a-z0-9_]{1,}=[a-z0-9_-]{1,})?((\&[a-z0-9_-]{1,}=[-0-9]{1,}){1,})?)/i', $html, $matches);
			foreach ($matches[0] as $item) {
				$to_id = add_new_url($item, $domain, $path);    
//				$r = make_url_link($id, $to_id, '');
				}
			}
			// Linked social pages
			$l = db_exec_query("SELECT u.path FROM ms_url u, ms_url_link l where l.to_id = u.id and l.from_id = ".$id);
			while ($li = mysqli_fetch_assoc($l)) {
				print "Linked: {$li["path"]}".PHP_EOL;
			}	

	     mark_url_queue($id_queue, $qi["url_id"], 3);
       }
    	
       mysqli_free_result($result);    
	} catch (Exception $exception) {
        		print "Exception: {$exception}" . PHP_EOL;
    	}

	$id_queue = stop_queue($id_queue);
}
	$id_queue = start_queue(3);
} while (!empty($id_queue))?>