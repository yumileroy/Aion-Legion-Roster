<?php

/************************************************************\
 *
 *	  Aion Roster Script Copyright 2010 - Yumi Nanako
 *	  www.yuminanako.info
 *
 \************************************************************/

/* Values are 'na' for North American servers and 'uk' for United Kingdom servers */
$countryID = 'na';

/* Get the server ID and guild ID from the Aion site. */
$serverID = '2';
$guildID = '11569';

/* Timezone for roster script (Values can be taken from http://php.net/manual/en/timezones.php) */
$timezone = 'UTC';

/* Time / Date style used for roster script (Values can be taken from http://php.net/manual/en/function.date.php) */
$datestyle = "l, F j Y, g:i A T";

/* URL for getting legion info (Don't change it unless you know what you are doing) */
$url = 'http://' . $countryID . '.aiononline.com/livestatus/character-legion/search?serverID=' . $serverID . '&guildID=' . $guildID;
$url1 = $url . '&currentPage=1&connectGame=';
$url2 = $url . '&currentPage=2&connectGame=';
$url3 = $url . '&currentPage=3&connectGame=';

/* Replace links and img relative url to absolute url to Aion site */
$aionabsoluteurl = "http://" . $countryID . ".aiononline.com/";

/* Number of characters to display per page */
$charnum = '20';

/* Use Greybox (Values can be 0 to off or 1 to on) */
$greybox = '1';

/* Use Greybox alternate layout (Values can be 0 to off or 1 to on) */
$greyboxalt = '0';

/* Directory to store cache roster output */
$cachedir = './cache/';

/* Seconds to cache roster output (In seconds) */
$cachetime = '300';

/* Seconds to cache scraped data from Aion site */
$scachetime = '300';

/* Files of scraped data from Aion site */
$sfile0 = $guildID."legion0.html";
$sfile1 = $guildID."legion1.html";
$sfile2 = $guildID."legion2.html";
$sfilec = $guildID."legionc.html";

?>
