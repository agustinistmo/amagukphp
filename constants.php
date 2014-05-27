<?php
/**
 * AMAGUK PHP FRAMEWORK
 * Copyright 2013 AGUSTIN CORONA JIMENEZ. All rights reserved.
 * agustinistmo@gmail.com 
 * http://amagukmx.wordpress.com/
 */
 
/*
defined('MGK_APPLICATION_DIRECTORY')||define('MGK_APPLICATION_DIRECTORY', 'actividades');
define('MGK_WORK_DIRECTORY', MGK_APPLICATION_DIRECTORY );
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)).'/..' );
require_once '../index.php'; */

header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Mexico_City');
ini_set("display_errors",true);
ini_set('log_errors', 1);

$items = explode("/", $_SERVER["SCRIPT_NAME"] );
$p = stripos( $items[1] , ".php");
$d = ( $p === false )?"/".$items[1]:"/";

define('REAL_ROOT_DIRECTORY', $d );
$d.=""; // esto en caso que el proyecto amaguk se encuentre dentro de otro proyecto php, ejempo: $d = "/otro"
define('MGK_ROOT_DIRECTORY', $d );
//define('MGK_ROOT_DIRECTORY',($_SERVER['HTTP_HOST']=="actividades.destec-mex.com.mx")?"":"/actividades");
define('MGK_LANGUAGE', "es" );
define('MGK_SESSION_NAME', "ses_mgk_".MGK_ROOT_DIRECTORY );
define('MGK_SHOW_INFO', false );

define('MGK_PROJECT_REAL_PATH', realpath(dirname(__FILE__) ));
defined('MGK_APPLICATION_DIRECTORY')||define('MGK_APPLICATION_DIRECTORY', 'application');
defined('MGK_APPLICATION_REAL_PATH')||define('MGK_APPLICATION_REAL_PATH', MGK_PROJECT_REAL_PATH.'/'.MGK_APPLICATION_DIRECTORY );
defined('MGK_WORK_DIRECTORY')||define('MGK_WORK_DIRECTORY', '' );
define('MGK_HOME', MGK_ROOT_DIRECTORY);
set_include_path( get_include_path() . PATH_SEPARATOR . realpath( dirname(__FILE__) ) );
?>