<?php

function cleanup_title ($dirty_title){
//    $dirty_title = '08 - Prava - stvar';
    $vowels = array("***Die Berlin-Fraktion*** -", 
                    "***Sternchen Live on Air*** -", 
                    "***Sven2703 live on Air***Aktueller Titel:", 
                    "***Wunschbox On-Air***", 
                    "***Sven2703 live on Air***", 
                    "Acum Asculti -", 
                    "Acum asculti -",
                    "FRISKY | ",
                    "Now On Danceradio.es :",
                    "***Draven live on Air***",
                    "***Die Chaoten live on Air***",
                    "***DebbyW on Air***",
                    "***Die Chaoten live on Air***",
                    "***Gera auf Sendung***",
                    "***Red-Angel live on Air***",
                    "**Das letzte Mal on Air - Euer Matrix** - ",
                    "BiGxGh.Com - ",
                    "***Speedy live on Air***",
                    "..::: Evil Inside Live On Air :::..  ",
                    "8 FM - ",
                    "Aktueller Song  fuer euch: ",
                    "*** Merry Christmas ***  ");

    // cut bad words
    $clean_title = str_replace($vowels, "", $dirty_title);
    
    // cut track number
    $dot_pos = strpos($clean_title, '.');
    if (empty($dot_pos)) {
        $dot_pos = 0;
    }
    $min_pos = strpos($clean_title, '-');
    if (empty($min_pos)) {
        $min_pos = 0;
    }
    if (($dot_pos < $min_pos and $dot_pos > 0) or ($dot_pos > 0 and $min_pos === 0)) {
        $pos = strpos($clean_title, '.');
    }
    if (($dot_pos > $min_pos and $min_pos > 0) or ($dot_pos === 0 and $min_pos > 0)) {
        $pos = strpos($clean_title, '-');
    }
    if (!empty($pos)) {
        $rest = substr($clean_title, 0, $pos);
        if (ctype_digit(trim($rest))) {
            $clean_title = substr($clean_title, $pos + 1);
        }
    }
    
    $clean_title = trim($clean_title);
    return $clean_title;
}

function get_current_title ($stream_url){
    @$t = new streaminfo($stream_url); // get metadata
    $title = cleanup_title($t->streamtitle);
    return $title;
}
?>
