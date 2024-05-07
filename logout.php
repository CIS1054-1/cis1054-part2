<?php
require_once __DIR__ . '/bootstrap.php';

$session->destroy_session($user_row);
$cookies->destroy_cookies($user_row);

header("Location: index");
exit;
?>