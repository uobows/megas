<?php
include_once('simple_html_dom.php');

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
include_once 'urls/add_new_url.php';
include_once 'urls/get_content_type.php';
include_once 'urls/get_url_header.php';
include_once 'spiders/spider_html.php';
include_once 'spiders/spider_rss.php';
include_once 'spiders/spider_audiostream.php';
include_once 'spiders/get_crawl_rule.php';
include_once 'spiders/get_spider.php';
include_once 'queue/start_url_queue.php';
include_once 'urls/get_url_header.php';
include_once 'urls/get_domain_id.php';
include_once 'urls/get_full_domain.php';
include_once 'urls/get_content_type.php';
include_once 'urls/get_scheme_id.php';
include_once 'urls/get_store_rule.php';
include_once 'simple_html_dom.php';
include_once 'spiders/rss/rss_fetch.inc';

$cs = db_exec_query("SET NAMES utf8;");
$id_queue = null;

$response = "";

do {
    if (!empty($id_queue)) {

        // Processing URLs in session
        $q = db_exec_query("SELECT url_id from ms_queue_list where queue_id = ".$id_queue);

        // Proccesing each URL
        while ($qi = mysqli_fetch_assoc($q)) {
            $result = db_exec_query("SELECT u.id, u.path, u.id_domain, u.visited, u.parsed, u.query FROM ms_url u, ms_domain d where d.id = u.id_domain and u.id = ".$qi["url_id"]);
            $row = mysqli_fetch_assoc($result);	
            $url = make_url($row["id"]);
            $path = $row["path"];
            $query = $row["query"];
            $domain = $row["id_domain"];
            $num = $row["visited"];
            $id = $row["id"];
            $parsed = $row["parsed"];
            $state = 0;
            print "URL in progress: {$url}";
            start_url_queue($id_queue, $url);
        
            $headers = get_url_header($url);

            if (empty($headers)) {
                print "empty header";
                $err = $err + 1;
                $state = -1;
            }

            
            if (empty($headers["contenttype"])) {
                $types = '';
            } else $types = $headers["contenttype"];

            if (empty($headers["httpcode"])) {
                $http_code = 0;
            } else $http_code = $headers["httpcode"];

            // clear type
            $pos = strpos($types, ';');
            if ( !empty($pos) ) {
                $types = substr(strtolower($types), 0, $pos);
            }
            print " - {$types} - {$http_code}" . PHP_EOL;

            $type = get_content_type($types);

            if ($state == 0) {
                $state = 1;
            }

            if ($http_code >= 400) {
                $state = -1;
            }

            $num = $num + 1;

            // Redirection
            if (($state == 1) and (($http_code >= 300) and ($http_code < 400))) {
                $new_id = add_new_url($headers["location"], $domain, $path);
                if ((!empty($new_id)) and ($new_id !== -1)) {
                    if ($new_id <> $id) {
                        $ins_res = db_exec_query("update ms_url set id_url_redirect = ".$new_id." where id = ".$id);
                }
                else {
                    $http_code = 200;
                            $ins_res = db_exec_query("update ms_url set id_url_redirect = null where id = ".$id);
                }
                }
            }

            $up_res = db_exec_query("update ms_url set visited_at = now(), http_code = ".$http_code.", state = " . $state . ", visited = " . $num . ", id_content_type = ".$type." where id = " . $id);

            // Process active URL    
            if (($state == 1)  and (($http_code >= 200) and ($http_code < 300))) {
            switch (get_spider($type)) {
            case 1:
                if ($http_code == 200) { spider_html($url, $id); }
                break;
            case 2:
                if ($http_code == 200) { spider_rss($url, $id);}
                break;
            case 3:
                if ($http_code == 200) { spider_audiostream($url, $id);}
                break;
            }
            if ((get_crawl_rule($domain, $path, $type) == 1)) {	 
                $r = db_exec_query("insert into ms_global_queue (id_url, type) values(".$id.", 2)");
            }

        }
        mark_url_queue($id_queue, $id, 1);
        }
        mysqli_free_result($result);
        $id_queue = stop_queue($id_queue);
    }
	$id_queue = start_queue(1);
} while (1 == 1)
//} while (!empty($id_queue))


?>