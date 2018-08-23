<?php
define('CRLF', "\r\n");

function get_url_header($url){
    $http_code = 0;
    $headers = '';	
    $t = parse_url($url);
    if (empty($t['port'])) {
        $t['port'] = 80;
    }

    $sock = @fsockopen($t['host'], $t['port'], $errno, $errstr, 5);
    $path = isset($t['path'])?$t['path']:'/';
    if (!empty($t['query'])) {
	$path = $path.'?'.$t['query'];
    }		
    if ($sock){
        $request = 'GET '.$path.' HTTP/1.0' . CRLF . 
            'Host: ' . $t['host'] . CRLF . 
            'Connection: Close' . CRLF . 
            'Accept: */*' . CRLF . CRLF;

        if (fwrite($sock, $request)){
            $theaders = $line = '';
            while (!feof($sock)){ 
                $line = fgets($sock, 4096);
                if('' == trim($line)){
                    break;
                }
                $theaders .= $line;
            }

            $theaders = explode(CRLF, $theaders);
	     $c = 0;	
            foreach ($theaders as $header){
		  if ($c == 0) { 
			preg_match("/\d\d\d/", $header, $match);
			$headers["httpcode"] = (int)$match[0]; 
		  }
		  $c = $c + 1;
                $t = explode(':', $header); 
                if (isset($t[0]) && trim($t[0]) != ''){
                    $name = preg_replace('/[^a-z][^a-z0-9]*/i','', strtolower(trim($t[0])));
                    array_shift($t);
                    $value = trim(implode(':', $t));
//	     		print "{$name}: {$value}".PHP_EOL;	
                    if ($value != ''){
                        if (is_numeric($value)){
                            $headers[$name] = (int)$value;
                        }else{
                            $headers[$name] = $value;
                        }
                    }
                }
            }
            fclose($sock);
            $valid = true;
        }else $http_code = 0;
    }else $http_code = 0;

    return $headers;
}

?>
