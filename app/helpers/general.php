<?php
function formatoSeoSlug($url){
    $url = strtolower($url);

    //Rememplazamos caracteres especiales latinos 
    $find = array('á','é','í','ó','ú','ñ');
    $repl = array('a','e','i','o','u','n');
    $url = str_replace($find,$repl,$url);

    // Añadimos los guiones
    $find = array(' ', '&', '\r\n', '\n', '+'); 
            $url = str_replace ($find, '-', $url); 

    // Eliminamos y Reemplazamos demás caracteres especiales 
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/'); 
    $repl = array('', '-', ''); 
    $url = preg_replace ($find, $repl, $url); 
    //$palabra=trim($palabra);
    //$palabra=str_replace(" ","-",$palabra);
    return $url;
} 

function sluggable($str) {

    $before = array(
        'àáâãäåòóôõöøèéêëðçìíîïùúûüñšž',
        '/[^a-z0-9\s]/',
        array('/\s/', '/--+/', '/---+/')
    );
 
    $after = array(
        'aaaaaaooooooeeeeeciiiiuuuunsz',
        '',
        '-'
    );

    $str = strtolower($str);
    $str = strtr($str, $before[0], $after[0]);
    $str = preg_replace($before[1], $after[1], $str);
    $str = trim($str);
    $str = preg_replace($before[2], $after[2], $str);
 
    return $str;
}
?>
