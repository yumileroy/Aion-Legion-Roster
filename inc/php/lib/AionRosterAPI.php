<?php
/************************************************************\
 *
 *	  Aion Roster Script Copyright 2010 - Yumi Nanako
 *	  www.yuminanako.info
 *
 \************************************************************/
/* Include Config, Simple HTML DOM Parser and Pagination and PEAR Net_URL2 and cURL */
require('inc/php/config.php');
require('inc/php/lib/simple_html_dom.php');
require('inc/php/lib/pagination.class.php');
require('inc/php/lib/URL2.php');
require('inc/php/lib/curl.php');

/* Set Default Timezone */
date_default_timezone_set($timezone);

/* Initialize Pagination */
$pagination = new pagination;

/* Create DOM from URL (Curl / file_get_html) - Fallback to file_get_html if Curl is not installed */
if (_iscurlinstalled() && (time() - filemtime($cachedir.$sfilec) >= $scachetime))
{
    file_get_curl($url, $cachedir.$sfile0);
    if(strpos(file_get_contents($cachedir.$sfile0), "error/500"))
    {
        file_get_curl($url, $cachedir.$sfile0);
    }
    file_get_curl($url2, $cachedir.$sfile1);
    if(strpos(file_get_contents($cachedir.$sfile1), "error/500"))
    {
        file_get_curl($url2, $cachedir.$sfile1);
    }
    file_get_curl($url3, $cachedir.$sfile2);
    if(strpos(file_get_contents($cachedir.$sfile2), "error/500"))
    {
        file_get_curl($url3, $cachedir.$sfile2);
    }
    file_get_curl($url4, $cachedir.$sfile3);
    if(strpos(file_get_contents($cachedir.$sfile3), "error/500"))
    {
        file_get_curl($url4, $cachedir.$sfile3);
    }
    file_get_curl($url5, $cachedir.$sfile4);
    if(strpos(file_get_contents($cachedir.$sfile4), "error/500"))
    {
        file_get_curl($url5, $cachedir.$sfile4);
    }
}
else if (_iscurlinstalled() == false)
{
    $html0 = file_get_contents($url);
    file_put_contents($cachedir.$sfile0, $html0);
    if(strpos(file_get_contents($cachedir.$sfile0), "error/500"))
    {
        $html0 = file_get_contents($url);
        file_put_contents($cachedir.$sfile0, $html0);
    }

    $html1 = file_get_contents($url2);
    file_put_contents($cachedir.$sfile1, $html1);
    if(strpos(file_get_contents($cachedir.$sfile1), "error/500"))
    {
        $html1 = file_get_contents($url2);
        file_put_contents($cachedir.$sfile1, $html1);
    }

    $html2 = file_get_contents($url3);
    file_put_contents($cachedir.$sfile2, $html2);
    if(strpos(file_get_contents($cachedir.$sfile2), "error/500"))
    {
        $html2 = file_get_contents($url3);
        file_put_contents($cachedir.$sfile2, $html2);
    }

    $html3 = file_get_contents($url4);
    file_put_contents($cachedir.$sfile3, $html3);
    if(strpos(file_get_contents($cachedir.$sfile3), "error/500"))
    {
        $html3 = file_get_contents($url4);
        file_put_contents($cachedir.$sfile3, $html3);
    }

    $html4 = file_get_contents($url5);
    file_put_contents($cachedir.$sfile4, $html4);
    if(strpos(file_get_contents($cachedir.$sfile4), "error/500"))
    {
        $html4 = file_get_contents($url5);
        file_put_contents($cachedir.$sfile4, $html4);
    }
}

if(!file_exists($cachedir.$sfilec) or (time() - filemtime($cachedir.$sfilec) >= $scachetime))
{
    $htmlc = $cachedir.$sfilec;
    if(file_exists($htmlc))
    {
        unlink($htmlc);
    }
    $fh = fopen($htmlc, 'a');
    $legion0 = file_get_contents($cachedir.$sfile0);
    $legion1 = file_get_contents($cachedir.$sfile1);
    $legion2 = file_get_contents($cachedir.$sfile2);
    $legion3 = file_get_contents($cachedir.$sfile3);
    $legion4 = file_get_contents($cachedir.$sfile4);
    fwrite($fh, $legion0);
    fwrite($fh, $legion1);
    fwrite($fh, $legion2);
    fwrite($fh, $legion3);
    fwrite($fh, $legion4);
    fclose($fh);
    unlink($cachedir.$sfile0);
    unlink($cachedir.$sfile1);
    unlink($cachedir.$sfile2);
    unlink($cachedir.$sfile3);
    unlink($cachedir.$sfile4);
}

$display = $_GET['display'];
$html = file_get_html($cachedir.$sfilec);

/* Create Arrays for Different variables */
$members = array();
$members2 = array();
$members3 = array();
$grade = array();
$grade2 = array();
$grade3 = array();
$gradetext = array();
$level = array();
$level2 = array();
$level3 = array();
$leveltext = array();
$class = array();
$class2 = array();
$class3 = array();
$classtext = array();
$page = array();
$legion = array();

/* Initialize PEAR Net_URL2 for absolute pathing */
$uri = new Net_URL2($aionabsoluteurl); // URI of the resource
$baseURI = $uri;

foreach ($html->find('base[href]') as $elem) {
    $baseURI = $uri->resolve($elem->href);
}
foreach ($html->find('*[src]') as $elem) {
    //$elem->src = $baseURI->resolve($elem->src)->__toString();
    $elem->src = str_replace("http://static.na.aiononline.com/aion/common/", "inc/img/", $elem->src);
    if(strpos($elem->src, "/race/"))
    {
        $elem->width = "18";
        $elem->height = "18";
    }
    if(strpos($elem->src, "/grade/"))
    {
        $elem->width = "15";
        $elem->height = "16";
    }
    if(strpos($elem->src, "/class/"))
    {
        $elem->width = "18";
        $elem->height = "18";
    }

}
foreach ($html->find('*[href]') as $elem) {
    $charprofilename = strip_tags($elem->outertext);
    $elem->title = "$charprofilename's Profile";
    if($greybox == 1)
    {
        if($greyboxalt == 0)
        {
            $elem->rel = "gb_page_fs[]";
        }
        else if($greyboxalt == 1)
        {
            $elem->onclick = "return GB_showPage(this.title, this.href)";
        }
    }
    if (strtoupper($elem->tag) === 'BASE') continue;
    $elem->href = htmlspecialchars($elem->href);
    $elem->href = $baseURI->resolve($elem->href)->__toString();
}
foreach ($html->find('ul[class=legion]') as $key => $legioninfo) {
    $legion[] = preg_replace('/[^(\x20-\x7F)]*/', '', $legioninfo->plaintext);
}
foreach ($html->find('td[class=member]') as $key => $memberinfo) {
    $members[] = $memberinfo;
}
foreach ($html->find('td[class=grade]') as $gradekey => $gradeinfo) {
    $grade[] = $gradeinfo;
    $gradetext[] = preg_replace('/[^(\x20-\x7F)]*/', '', $gradeinfo->plaintext);
}
foreach ($html->find('td[class=level]') as $levelkey => $levelinfo) {
    $level[] = $levelinfo;
    $leveltext[] = $levelinfo->plaintext;
}
foreach ($html->find('td[class=class]') as $classkey => $classinfo) {
    $class[] = $classinfo;
    $classtext[] = $classinfo->plaintext;
}

/* Count number of classes in legion */
$classes = array_count_values($classtext);
$assassins = $classes[' Assassin'];
$rangers = $classes[' Ranger'];
$chanters = $classes[' Chanter'];
$clerics = $classes[' Cleric'];
$gladiators = $classes[' Gladiator'];
$templars = $classes[' Templar'];
$sorcerers = $classes[' Sorcerer'];
$spiritmasters = $classes[' Spiritmaster'];

/* Count number of levels in legion and sort array by array key */
$levels = array_count_values($leveltext);
ksort($levels);

/* Count number of each rank in legion */
$grades = array_count_values($gradetext);
$brigadegeneral = $grades['Brigade General'];
$centurions = $grades['Centurion'];
$legionaries = $grades['Legionary'];

/* Create variables for legion name, created date and members */
$legionname = explode(" (", $legion[0]);
$legionname = $legionname[0];
$legioncreatedmember = explode(" (", $legion[0]);
$legioncreatedmember = substr($legioncreatedmember[1], 0, -5);
$legioncreated = explode(" / ", $legioncreatedmember);
$legioncreated = $legioncreated[0];
$legioncreated = explode("Created ", $legioncreated);
$legioncreated = date($datestyle, strtotime($legioncreated[1]));
$legionmember = count($members);


?>
