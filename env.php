<?php

//konfigurasi database
$DB_HOST="127.0.0.1";
$DB_PORT="3360";
$DB_DATABASE="magang"; //nama database anda
$DB_USER="root";
$DB_PASS=""; //password dari database anda

//konfigurasi folder
$name_project= "projekmagang21-04-25"; //nama project kalian
$base_url=""; //kosongi saja

function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME']; // /nsms/folder lain/nama_project/index.php
    $pathParts = explode('/', trim($scriptName, '/'));
    $base_url= "";
    global $name_project;

    $kondisi=false;
    for( $i = count($pathParts)-1; $i >= 0; $i-- ) {
        
        if( $pathParts[$i] == $name_project && $i !=0) {
            $i--;
            $kondisi=true;
        }

        if($kondisi) {
            $base_url = $pathParts[$i] . "/" .$base_url;
        }
    }

    return $base_url;
}

// Contoh pakai
// Output: http://localhost/nsms/folder lain/nama_project/


// Output: http://localhost/nsms/folder%20lain/nama_project/
 //nama projectAnda