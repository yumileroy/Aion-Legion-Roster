<?php
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$finish = $time;
$totaltime = ($finish - $start);
echo "<div class='center'>Page generated in $totaltime seconds.</div>";
?>
