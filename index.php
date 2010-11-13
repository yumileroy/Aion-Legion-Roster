<?php
/************************************************************\
 *
 *	  Aion Roster Script Copyright 2010 - Yumi Nanako
 *	  www.yuminanako.info
 *
 \************************************************************/
/* Include Timer, Config, PEAR Cache_Lite */
require('inc/php/timer-header.tpl.php');
require('inc/php/config.php');
require('inc/php/lib/CacheLite.php');

/* Set a key for this cache item */
$cacheid = $guildID . basename(htmlspecialchars($_SERVER['REQUEST_URI']));

/* Set a few options */
$cacheoptions = array(
    'cacheDir' => $cachedir,
    'lifeTime' => $cachetime,
    'fileNameProtection' => FALSE
);

$cachefile = $cacheoptions['cacheDir'] . "cache_default_" . $cacheid;

/* Create a Cache_Lite object */
$Cache_Lite = new Cache_Lite($cacheoptions);

if ($cachedata = $Cache_Lite->get($cacheid))
{
    /* Cache hit! We've got the cached content stored in $data! */
    $cachedata .= "<!-- Cached copy, generated ".date($datestyle, filemtime($cachefile))." -->\n";
} 
else 
{

    ob_start();

    /* Include Aion Roster API */
    require('inc/php/lib/AionRosterAPI.php'); 

    /* Include Roster Template */
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
