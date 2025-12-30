<?php
if (!defined('INDEX')) {
    http_response_code(403);
    exit('Akses langsung dilarang');
}

if (!isset($_SESSION['ses_level'])) {
    header("Location: login.php");
    exit;
}

function allow_level(array $levels)
{
    if (!in_array($_SESSION['ses_level'], $levels)) {
        http_response_code(403);
        exit('Anda tidak berhak mengakses halaman ini');
    }
}
