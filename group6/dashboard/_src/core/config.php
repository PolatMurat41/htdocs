<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'Group6');
define('DB_USER', 'root');
define('DB_PASS', '');

define('BASE_URL','http://localhost/group6/');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();