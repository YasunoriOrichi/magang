<?php
// ===============================
// KONFIGURASI DASAR
// ===============================

// Path absolut ke folder proyek
define('BASE_PATH', __DIR__);

// Koneksi Database
$DB_HOST     = "127.0.0.1";
$DB_PORT     = "3306";
$DB_DATABASE = "magang";
$DB_USER     = "root";
$DB_PASS     = "";

// ===============================
// BASE URL OTOMATIS
// ===============================
function getBaseUrl() {
    $protocol    = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host        = $_SERVER['HTTP_HOST'];
    $scriptName  = $_SERVER['SCRIPT_NAME'];
    $dir         = rtrim(str_replace(basename($scriptName), '', $scriptName), '/');
    return $protocol . "://" . $host . $dir . "/";
}
