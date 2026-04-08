<?php
// Nyalakan session untuk menyimpan status login
if (!session_id()) {
    session_start();
}

require_once __DIR__ . '/../app/init.php';

$app = new App();