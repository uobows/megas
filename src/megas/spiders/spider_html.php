<?php

function spider_html ($url, $id){
    $title = '';
    $description = '';
    $keywords = '';

    $id_domain = db_get1_query("select id_domain u from ms_url u where id = ".$id);

    if ($id_domain == 23508) {
       print "Facebook {$id_domain} {$url}".PHP_EOL;
       $url = make_url($id);
       db_exec_query("insert into ms_social (id_url, nm_url, kd_type, guid) values (".$id.", '".$url."', 1, UUID())");
    }
    else {// Get html by URL
        $html = file_get_html($url);
        if ($html) {                
            // Get URL TITLE
            $t = $html->find('title', 0);
            if ($t) {
                $title = str_replace("'", "", substr(trim($t->innertext), 0, 255));
            }
            // Get URL KEYWORDS and DESCRIPTION
            foreach ($html->find('meta[name=description],meta[name=keywords],meta[name=Keywords]', null, true) as $desc) {
                if (strtolower($desc->getattribute('name')) == 'description') {
                    $description = substr(str_replace("'", "", trim($desc->getattribute('content'))), 0, 1023);
                }
                if (strtolower($desc->getattribute('name')) == 'keywords') {
                    $keywords = substr(str_replace("'", "", trim($desc->getattribute('content'))), 0, 1023);
                }
            }
            $up_res = db_exec_query("update ms_url set title = '" . $title . "', keywords = '" . $keywords . "', description = '" . $description . "' where id = " . $id);
    
            if (!empty($title)) {
                $r = db_exec_query('insert into ms_homepage (origin_id_url, origin_url, title) values ('.$id.', "'.$url.'", "'.$title.'")');
                $r = db_exec_query("insert into ms_global_queue (id_url, type) values(".$id.", 3)");
            }
    
            // $up_res = mysql_query("update ms_url set title = '" . $title . "', description = '" . $description . "' where id = " . $id);
            if (!$up_res) {
                $rsd = mysqli_error();
                print "Error up {$rsd}";
            }
        }
    }
}
?>
