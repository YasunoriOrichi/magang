<?php
//konfigurasi database
define('DB_HOST', 'localhost:3360');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'magang'); // ganti dengan nama database kamu


// Create a connection
$nama_projek = 'magang'; // ganti dengan nama projek kamu
function getConnection() {
    return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}

// Membuat BASE_URL dinamis
define('BASE_PATH', 'http://' . $nama_projek .'.localhost');
?>