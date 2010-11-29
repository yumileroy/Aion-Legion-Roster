Aion Legion Roster (PHP script)
------------------
------------------

### **Description**:
**Aion Legion Roster** is a [PHP](http://www.php.net "PHP Website") script which parses the official Aion site for your legion information.

I was kinda bored so I just made a script to parse out the legion roster.
Don't mind if it looks bad or is kinda unpolished.
My template is 100% XHTML 1.0 Strict compatible. (After much screaming and yelling and almost tearing my hair out xD)

- Supported scraping and parsing HTML with [PHP Simple HTML DOM Parser](http://simplehtmldom.sourceforge.net/ "PHP Simple HTML DOM Parser")
- Supported Javascript / CSS minifier with [Pretty Fly JS/CSS Compressor](http://prettyflywebsite.com/css/simple-and-fast-css-javascript-compressor-updated/ "Pretty Fly CSS/JS Compressor")
- Supported File Caching with [PEAR Cache Lite](http://pear.php.net/package/Cache_Lite/ "PEAR Cache Lite")
- Supported character replacement links to point to Aion site with [PEAR Net_URL2](http://pear.php.net/package/Net_URL2/ "PEAR Net_URL2")
- Supported Pagination with [Lots of Code PHP Array Pagination](http://www.lotsofcode.com/php/php-array-pagination.htm "Lots of Code PHP Array Pagination")
- Supported AJAX profile popup with [Orangoo Labs - Greybox](http://orangoo.com/labs/GreyBox/ "Orangoo Labs - Greybox")
- Supported Flash chart of classes with [Open Flash Chart 2](http://teethgrinder.co.uk/open-flash-chart-2/ "Open Flash Chart 2")
- Supported file retrieval with either [cURL](http://php.net/manual/en/book.curl.php "PHP: cURL - Manual") or fallbacks to file_get_contents if cURL PHP extension is not installed.

### **Requirements**:
#### List of prerequisites:

	Webhost with PHP5
	PHP with cURL / file_get_contents (Webhost needs to have cURL or have enabled fopen_wrappers for file_get_contents to work)

#### Installation:

##### To use the PHP script:
    Just upload it to a web-accessible directory on your web server, and make sure that the cache folder is writable.
    Then edit inc/php/config.php to suit your legion.

##### To change how the page display: 
    Edit inc/php/roster.tpl.php, inc/php/rosterbody.tpl.php and inc/css/style.css

### **Variables**:
#### Configuration (Although the config file is pretty much explained, I'll put it in here just for reference)

    $countryID (Values are 'na' for North American servers and 'uk' for United Kingdom servers)
    $serverID (ID for your server, value can be taken from the Aion site by searching for your legion)
    $guildID (ID for your legion, value can be taken from the Aion site by searching for your legion)
    $timezone (Default timezone used for date and time functions in roster script. Values can be taken from http://php.net/manual/en/timezones.php)
    $datestyle (Time / Date style used for roster script. Values can be taken from http://php.net/manual/en/function.date.php)
    $url (URL for getting legion info. Don't change it unless you know what you are doing)
    $url1 (Same as $url)
    $url2
    $url3
    $aionabsoluteurl (Replace character profile links with the official Aion site)
    $charnum (Number of characters to display per page)
    $greybox (Use Greybox. Values can be 0 to off or 1 to on)
    $greyboxalt (Use Greybox alternate layout. Values can be 0 to off or 1 to on)
    $cachedir (Directory to store cache output)
    $cachetime (Number of seconds to cache output for)
    $scachetime (Number of seconds to cache scraped output for)
    $sfile0 (File name of page 1 of scraped output)
    $sfile1 (File name of page 2 of scraped output)
    $sfile2 (File name of page 3 of scraped output)
    $sfilec (File name of combined pages of scraped output)

#### Legion Information:

    $legionname (Name of legion)
    $legioncreated (Date and time when legion was created, etc : Friday, October 23 2009, 11:53 pm UTC)
    $legionmember (Number of members in legion)

#### Number of classes:

    $assassins (Number of Assassins in legion)
    $rangers (Number of Rangers in legion)
    $chanters (Number of Chanters in legion)
    $clerics (Number of Clerics in legion)
    $gladiators (Number of Gladiators in legion)
    $templars (Number of Templars in legion)
    $sorcerers (Number of Sorcerers in legion)
    $spiritmasters (Number of Spiritmasters in legion)

#### Number of levels:

    $levels (Array containing levels[number of levels])

#### Number of grades:

    $brigadegeneral (Number of Brigade General in legion - I know, kinda stupid of me to include this)
    $centurions (Number of Centurions in legion)
    $legionaries (Number of Legionaries in legion)    

#### Characters Information:

    $members (Array containing link to character profile and character name)
    $grade (Array containing character grade in legion)
    $level (Array containing character level)
    $class (Array containing character class)

### **To-Do**:

    Add class counts for first classes
    Tidy up source
    More....

### **Demo**:

An demo of the script running is [here](http://nanaforge.info/roster/ "Yumi Aion Legion Roster Script Demo").

### **Authors**:

Original Author is [**Yumi Nanako**](mailto:yuminanako@yuminanako.info "Yumi Nanako E-mail") / [**Yumi (Mythical) of Israphel**](http://na.aiononline.com/livestatus/character-legion/search?serverID=2&charID=329640 "Yumi's Aion Profile").
It is currently maintained by [**Yumi Nanako**](mailto:yuminanako@yuminanako.info "Yumi Nanako E-mail") / [**Yumi (Mythical) of Israphel**](http://na.aiononline.com/livestatus/character-legion/search?serverID=2&charID=329640 "Yumi's Aion Profile")
