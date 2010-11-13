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
    $elem->src = $baseURI->resolve($elem->src)->__toString();
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
/* Save number of pages to variable */
foreach ($html->find('div[class=paging]') as $key => $testinfo) {
    $page[] = $testinfo->plaintext;
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
/* If Page 2 exists, scrape Page 2 */
if (strlen(strstr($page[0], "2")) > 0) {
    foreach ($html2->find('*[src]') as $elem) {
        $elem->src = $baseURI->resolve($elem->src)->__toString();
    }
    foreach ($html2->find('*[href]') as $elem) {
        $charprofilename = strip_tags($elem->outertext);
        $elem->title = "$charprofilename's Profile";
        if ($greybox == 1)
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
    foreach ($html2->find('td[class=member]') as $key => $memberinfo) {
        $members[] = $memberinfo;
        $members2[] = $memberinfo->plaintext;
    }
    foreach ($html2->find('td[class=grade]') as $gradekey => $gradeinfo) {
        $grade[] = $gradeinfo;
        $gradetext[] = preg_replace('/[^(\x20-\x7F)]*/', '', $gradeinfo->plaintext);
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
/* If Page 3 exists, scrape Page 3 */
if (strlen(strstr($page[0], "3")) > 0) {
    foreach ($html3->find('*[src]') as $elem) {
        $elem->src = $baseURI->resolve($elem->src)->__toString();
    }
    foreach ($html3->find('*[href]') as $elem) {
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
    foreach ($html3->find('td[class=member]') as $key => $memberinfo) {
        $members[] = $memberinfo;
        $members3[] = $memberinfo->plaintext;
    }
    foreach ($html3->find('td[class=grade]') as $gradekey => $gradeinfo) {
        $grade[] = $gradeinfo;
        $gradetext[] = preg_replace('/[^(\x20-\x7F)]*/', '', $gradeinfo->plaintext);
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
