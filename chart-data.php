<?php
require('inc/php/lib/AionRosterAPI.php');
require('php-ofc-library/open-flash-chart.php');

$title = new title("$legionname Class Percentage");
$title->set_style("{font-size: 20px; font-family: Verdana; font-weight: bold; color: #A2ACBA; text-align: center;}");

$pie = new pie();
$pie->set_alpha(0.6);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#val# of #total#<br>#percent# of 100%' );
$pie->set_colours(array("#337733","#337733","#998866","#998866","#0077ff","#0077ff","#773366","#773366"));
$pie->set_values(array(new pie_value($assassins, "Assassins"),new pie_value($rangers, "Rangers"),new pie_value($chanters, "Chanters"),new pie_value($clerics, "Clerics"),new pie_value($gladiators, "Gladiators"),new pie_value($templars, "Templars"),new pie_value($sorcerers, "Sorcerers"),new pie_value(8, "Spiritmasters")));

$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $pie );


$chart->x_axis = null;

echo $chart->toPrettyString();
?>
