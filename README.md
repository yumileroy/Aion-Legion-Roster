Aion Legion Roster (PHP script)
------------------
------------------

### **Description**:
**Aion Legion Roster** is a [PHP](http://www.php.net "PHP Website") script which parses the official Aion site for your legion information.

I was kinda bored so I just made a script to parse out the legion roster.
Don't mind if it looks bad or is kinda unpolished.
I tried to make it to comply to XHTML as much as I can, the output validated with 19 errors so far on my demo site (Reduced it from hundreds to 19 errors). 
I think that's the best I can make do without making use of the [PHP Tidy](http://php.net/manual/en/book.tidy.php "PHP: Tidy - Manual") extension which I know not many hosts will have, so I decided not to code that in.

- Supported File Caching with [PEAR Cache Lite](http://pear.php.net/package/Cache_Lite/ "PEAR Cache Lite")
- Supported character replacement links to point to Aion site with [PEAR Net_URL2](http://pear.php.net/package/Net_URL2/ "PEAR Net_URL2")
- Supported Pagination with [Lots of Code PHP Array Pagination](http://www.lotsofcode.com/php/php-array-pagination.htm "Lots of Code PHP Array Pagination")
- Supported file retrieval with either [cURL](http://php.net/manual/en/book.curl.php "PHP: cURL - Manual") or fallbacks to file_get_contents if cURL PHP extension is not installed.

### **Requirements**:
#### List of prerequisites:

	Webhost with PHP
	PHP with CURL / file_get_contents (Webhost needs to have CURL or have enabled fopen_wrappers for file_get_contents to work)

#### Installation:

To use the PHP script, just upload it to a web-accessible directory on your web server, and make sure that the cache folder is writable.

### **Variables**:
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

### **Demo**:

An demo of the script running is [here](http://nanaforge.info/roster/ "Yumi Aion Legion Roster Script Demo").

### **Authors**:

Original Author is [**Yumi Nanako**](mailto:yuminanako@yuminanako.info "Yumi Nanako E-mail") and [**Leroy Lim**](mailto:leroylim@yuminanako.info "Leroy Lim E-mail").
It is currently maintained by [**Yumi Nanako**](mailto:yuminanako@yuminanako.info "Yumi Nanako E-mail")
