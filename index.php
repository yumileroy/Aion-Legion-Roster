<?php
/************************************************************\
 *
 *	  Aion Roster Script Copyright 2010 - Yumi Nanako
 *	  www.yuminanako.info
 *
 \************************************************************/
// Include Timer, Config, Simple HTML DOM Parser and Pagination and PEAR Net_URL2 and Curl and Snoopy 
require('inc/php/timer-header.tpl.php');
require('inc/php/config.php');
require('inc/php/simple_html_dom.php');
require('inc/php/pagination.class.php');
require('inc/php/URL2.php');
require('inc/php/curl.php');

/* Include the class */
require_once 'inc/php/CacheLite.php';

/* Set a key for this cache item */
$cacheid = $guildID . basename($_SERVER['REQUEST_URI']);

/* Set a few options */
$cacheoptions = array(
    'cacheDir' => $cachedir,
    'lifeTime' => $cachetime,
	'fileNameProtection' => FALSE
);

$cachefile = $cacheoptions['cacheDir'] . "cache_default_" . $cacheid;

/* Create a Cache_Lite object */
$Cache_Lite = new Cache_Lite($cacheoptions);

/* Set Default Timezone */
date_default_timezone_set($timezone);

if ($cachedata = $Cache_Lite->get($cacheid))
{
    /* Cache hit! We've got the cached content stored in $data! */
	$cachedata .= "<!-- Cached copy, generated ".date($datestyle, filemtime($cachefile))." -->\n";
} 
else 
{

ob_start();

// Initialize Pagination
$pagination = new pagination;

// Create DOM from URL (Curl / file_get_html) - Fallback to file_get_html if Curl is not installed
if (_iscurlinstalled())
{
$html = str_get_html(file_get_contents_curl($url));
$html2 = str_get_html(file_get_contents_curl($url2));
$html3 = str_get_html(file_get_contents_curl($url3));
}
else
{
$html = file_get_html($url);
$html2 = file_get_html($url2);
$html3 = file_get_html($url3);
}

$display = $_GET['display'];

// Create Arrays for Different variables
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

// Initialize PEAR Net_URL2 for absolute pathing
$uri = new Net_URL2($aionabsoluteurl); // URI of the resource
$baseURI = $uri;


foreach ($html->find('base[href]') as $elem) {
    $baseURI = $uri->resolve($elem->href);
}
foreach ($html->find('*[src]') as $elem) {
    $elem->src = $baseURI->resolve($elem->src)->__toString();
}
foreach ($html->find('*[href]') as $elem) {
    if (strtoupper($elem->tag) === 'BASE') continue;
    $elem->href = htmlspecialchars($elem->href);
    $elem->href = $baseURI->resolve($elem->href)->__toString();
}
// Save number of pages to variable
foreach ($html->find('div[class=paging]') as $key => $testinfo) {
    $page[] = $testinfo->plaintext;
}
foreach ($html->find('ul[class=legion]') as $key => $legioninfo) {
    $legion[] = $legioninfo->plaintext;
}
foreach ($html->find('td[class=member]') as $key => $memberinfo) {
    $members[] = $memberinfo;
}
foreach ($html->find('td[class=grade]') as $gradekey => $gradeinfo) {
    $grade[] = $gradeinfo;
    $gradetext[] = $gradeinfo->plaintext;
}
foreach ($html->find('td[class=level]') as $levelkey => $levelinfo) {
    $level[] = $levelinfo;
    $leveltext[] = $levelinfo->plaintext;
}
foreach ($html->find('td[class=class]') as $classkey => $classinfo) {
    $class[] = $classinfo;
    $classtext[] = $classinfo->plaintext;
}
if (strlen(strstr($page[0], "2")) > 0) {
    foreach ($html2->find('*[src]') as $elem) {
        $elem->src = $baseURI->resolve($elem->src)->__toString();
    }
    foreach ($html2->find('*[href]') as $elem) {
        if (strtoupper($elem->tag) === 'BASE') continue;
		$elem->href = htmlspecialchars($elem->href);
        $elem->href = $baseURI->resolve($elem->href)->__toString();
    }
    foreach ($html2->find('td[class=member]') as $key => $memberinfo) {
        $members[] = $memberinfo;
        $members2[] = $memberinfo->plaintext;
    }
    foreach ($html2->find('td[class=grade]') as $gradekey => $gradeinfo) {
        $grade[] = $gradeinfo;
        $gradetext[] = $gradeinfo->plaintext;
        $grade2[] = $gradeinfo->plaintext;
    }
    foreach ($html2->find('td[class=level]') as $levelkey => $levelinfo) {
        $level[] = $levelinfo;
        $leveltext[] = $levelinfo->plaintext;
        $level2[] = $levelinfo->plaintext;
    }
    foreach ($html2->find('td[class=class]') as $classkey => $classinfo) {
        $class[] = $classinfo;
        $classtext[] = $classinfo->plaintext;
        $class2[] = $classinfo->plaintext;
    }
}
if (strlen(strstr($page[0], "3")) > 0) {
    foreach ($html3->find('*[src]') as $elem) {
        $elem->src = $baseURI->resolve($elem->src)->__toString();
    }
    foreach ($html3->find('*[href]') as $elem) {
        if (strtoupper($elem->tag) === 'BASE') continue;
		$elem->href = htmlspecialchars($elem->href);
        $elem->href = $baseURI->resolve($elem->href)->__toString();
    }
    foreach ($html3->find('td[class=member]') as $key => $memberinfo) {
        $members[] = $memberinfo;
        $members3[] = $memberinfo->plaintext;
    }
    foreach ($html3->find('td[class=grade]') as $gradekey => $gradeinfo) {
        $grade[] = $gradeinfo;
        $gradetext[] = $gradeinfo->plaintext;
        $grade3[] = $gradeinfo->plaintext;
    }
    foreach ($html3->find('td[class=level]') as $levelkey => $levelinfo) {
        $level[] = $levelinfo;
        $leveltext[] = $levelinfo->plaintext;
        $level3[] = $levelinfo->plaintext;
    }
    foreach ($html3->find('td[class=class]') as $classkey => $classinfo) {
        $class[] = $classinfo;
        $classtext[] = $classinfo->plaintext;
        $class3[] = $classinfo->plaintext;
    }
}
// Count number of classes in legion
$classes = array_count_values($classtext);
$assassins = $classes[' Assassin'];
$rangers = $classes[' Ranger'];
$chanters = $classes[' Chanter'];
$clerics = $classes[' Cleric'];
$gladiators = $classes[' Gladiator'];
$templars = $classes[' Templar'];
$sorcerers = $classes[' Sorcerer'];
$spiritmasters = $classes[' Spiritmaster'];

// Count number of levels in legion and sort array by array key
$levels = array_count_values($leveltext);
ksort($levels);

// Count number of each rank in legion and replace special non ASCII characters from Array key
$grades = array_count_values($gradetext);
$gradeskeys = preg_replace('/[^(\x20-\x7F)]*/', '', array_keys($grades));
$gradesvalues = array_values($grades);
$grades = array_combine($gradeskeys, $gradesvalues);
$brigadegeneral = $grades['Brigade General'];
$centurions = $grades['Centurion'];
$legionaries = $grades['Legionary'];

// Create variables for legion name, created date and members
$legionname = explode(" (", $legion[0]);
$legionname = preg_replace('/[^(\x20-\x7F)]*/', '', $legionname[0]);
$legioncreatedmember = explode(" (", $legion[0]);
$legioncreatedmember = substr($legioncreatedmember[1], 0, -5);
$legioncreated = explode(" / ", $legioncreatedmember);
$legioncreated = $legioncreated[0];
$legioncreated = explode("Created ", $legioncreated);
$legioncreated = $legioncreated[1];
$legionmember = count($members);

// Include Roster Template
require('inc/php/roster.tpl.php');

/* We've got fresh content stored in $data! */
$cachedata = ob_get_contents();

/* Let's store our fresh content, so next
 * time we won't have to generate it! */
$Cache_Lite->save($cachedata, $cacheid);
ob_get_clean();

}

echo $cachedata;

?>