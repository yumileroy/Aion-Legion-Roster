<?php

// Set these to the correct paths
require_once 'inc/php/config.php';
require_once 'inc/php/lib/CacheLite.php';
require_once 'inc/php/lib/jsmin.php';

$cacheId = md5($_SERVER['QUERY_STRING']);
$cacheOptions = array('cacheDir' => $cachedir,  'lifeTime' => 3600, 'pearErrorMode' => CACHE_LITE_ERROR_DIE);
$cacheLite = new Cache_Lite($cacheOptions);
$cacheLite->clean();
if(false == $buffer = $cacheLite->get($cacheId)) {

	if(empty($_GET['files']) || empty($_GET['type'])) {
		trigger_error('Type and or files not set, exiting', E_USER_WARNING);
	}

	$files = explode(',' ,  $_GET['files']);
	$path = realpath(dirname(__FILE__));
	$buffer = '';

    foreach($files as $file) {
        $file = trim($file);
        if(file_exists($path . '/' . $file)) {
            $buffer .= file_get_contents($path . '/' . $file);
        }
    }

	// Minify JS
	if($_GET['type'] == 'js') {
		$buffer = JSMin::minify($buffer);
	}

	// Remove comments, excess whitespace and newlines
    if($_GET['type'] == 'css') {
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(array("\r", "\n", "\t", "  "), '', $buffer);
    }

	// Cache results
	$buffer = gzencode($buffer, 9); // Wordt geregeld door Apache
	// $cacheLite->save($buffer);
}

switch($_GET['type']) {
    case 'css':
        $contentType = 'Content-type: text/css; charset: UTF-8';
        break;

    case 'js':
        $contentType = 'Content-type: text/javascript; charset: UTF-8';
        break;

    default:
        $contentType = 'Content-type: text/plain; charset: UTF-8';
		break;
}

header('Content-Encoding: gzip');
header($contentType);
header('Cache-Control: must-revalidate');
header('Vary: Accept-Encoding');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cacheOptions['lifeTime']) . ' GMT');
echo $buffer;
?>
