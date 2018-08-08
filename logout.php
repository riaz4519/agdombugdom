<?php
session_start();
session_destroy();
$referer = $_SERVER['HTTP_REFERER'];

header('Location: '.$referer);
?>