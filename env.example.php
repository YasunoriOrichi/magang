<?php

//konfigurasi database
$DB_HOST="127.0.0.1";
$DB_PORT="3360"; //port mysql yang digunakan
$DB_DATABASE="magang"; //nama database
$DB_USER="root"; //username database
$DB_PASS=""; //password dari database

//konfigurasi folder
$name_project= "nama_prpjek"; //nama project kalian
$base_url="http://nama_urlnya.localhost/"; //nama URL projek kalian

// function getBaseUrl() {
//     $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
//     $host = $_SERVER['HTTP_HOST'];
//     $scriptName = $_SERVER['SCRIPT_NAME']; // /nsms/folder lain/nama_project/index.php
//     $pathParts = explode('/', trim($scriptName, '/'));
//     $base_url= "";
//     global $name_project;

//     $kondisi=false;
//     for( $i = count($pathParts)-1; $i >= 0; $i-- ) {
        
//         if( $pathParts[$i] == $name_project && $i !=0) {
//             $i--;
//             $kondisi=true;
//         }

//         if($kondisi) {
//             $base_url = $pathParts[$i] . "/" .$base_url;
//         }
//     }

//     return $base_url;
// }

// Contoh pakai
// Output: http://localhost/nsms/folder lain/nama_project/


// Output: http://localhost/nsms/folder%20lain/nama_project/
 //nama projectAnda