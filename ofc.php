<?php
include_once 'php-ofc-library/open-flash-chart-object.php';
$uri = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
open_flash_chart_object( 500, 500, $uri .'/chart-data.php', false );
?>
