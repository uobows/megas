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

do {
    // Select next URL
    $q = db_exec_query("SELECT u.id FROM ms_url u, ms_content_type t where t.id = u.id_content_type and t.crawler = 1 and not exists (select 1 from ms_url_locked l where l.id_url = u.id) and u.state = 1 order by u.parsed, u.parsed_at asc limit 1");

    // Proccesing each URL
    try {
        while ($qi = mysqli_fetch_assoc($q)) {
			$result = db_exec_query("SELECT u.id, u.path, u.id_domain FROM ms_url u, ms_domain d where d.id = u.id_domain and u.id = ".$qi["id"]);
			$row = mysqli_fetch_assoc($result);	
			$domain = $row["id_domain"];
            $path = $row["path"];
            $id = $row["id"];
			$locked = db_insert_query("insert into ms_url_locked (id_url, type) values(".$row["id"].", 2)");
            $url = make_url($id);

            print "URL in progress: {$url}";
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
			}

			// Extract URLs	
			preg_match_all('/(https?:\/\/)(www\.)?([-�-�a-z0-9_\.]{2,}\.)(��|[a-z0-9]{2,9})?(:[0-9]{2,})?(((\/[-�-�a-z0-9_\.\#\!]{1,}){1,})?\/?([a-z0-9_-]\.[a-z])?(\?[a-z0-9_]{1,}=[a-z0-9_-]{1,})?((\&[a-z0-9_-]{1,}=[-0-9]{1,}){1,})?)/i', $html, $matches);
			foreach ($matches[0] as $item) {
				$to_id = add_new_url($item, $domain, $path);    
				$r = make_url_link($id, $to_id, '');
			}
			print PHP_EOL;	
            }
           $res = db_exec_query("update ms_url set parsed = 1, parsed_at = now() where id = ".$id);
		   $locked = db_exec_query("delete from ms_url_locked where id_url = ".$id." and type = 2");
        }
    	mysqli_free_result($result);    
	} catch (Exception $exception) {
		print "Exception: {$exception}" . PHP_EOL;
	}
} while (1 == 1)
?>