<?php
require_once __DIR__.'/config.php';
function require_login(){ if(empty($_SESSION['user_id'])) { header('Location: login.php'); exit; } }
function require_admin(){ require_login(); if(($_SESSION['role']??'user')!=='admin'){ http_response_code(403); exit('Admin access required.'); } }
?>