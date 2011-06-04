<?php

function open_flash_chart_object_str( $width, $height, $url, $use_swfobject=true, $base='' )
{
    //
    // return the HTML as a string
    //
    return _ofc( $width, $height, $url, $use_swfobject, $base );
}

function open_flash_chart_object( $width, $height, $url, $use_swfobject=true, $base='' )
{
    //
    // stream the HTML into the page
    //
    echo _ofc( $width, $height, $url, $use_swfobject, $base );
}

function _ofc( $width, $height, $url, $use_swfobject, $base )
{
    //
    // I think we may use swfobject for all browsers,
    // not JUST for IE...
    //
    //$ie = strstr(getenv('HTTP_USER_AGENT'), 'MSIE');

    //
    // escape the & and stuff:
    //
    $url = urlencode($url);

    //
    // output buffer
    //
    $out = array();

    //
    // check for http or https:
    //
    if (isset ($_SERVER['HTTPS']))
    {
        if (strtoupper ($_SERVER['HTTPS']) == 'ON')
        {
            $protocol = 'https';
        }
        else
        {
            $protocol = 'http';
        }
    }
    else
    {
        $protocol = 'http';
    }

    //
    // if there are more than one charts on the
    // page, give each a different ID
    //
    global $open_flash_chart_seqno;
    $obj_id = 'chart';
    $div_name = 'flashcontent';

    //$out[] = '<script type="text/javascript" src="'. $base .'inc/js/ofc.js"></script>';
    $out[] = '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>';

    if( !isset( $open_flash_chart_seqno ) )
    {
        $open_flash_chart_seqno = 1;
        $out[] = '<script type="text/javascript" src="'. $base .'inc/js/swfobject.js"></script>';
    }
    else
    {
        $open_flash_chart_seqno++;
        $obj_id .= '_'. $open_flash_chart_seqno;
        $div_name .= '_'. $open_flash_chart_seqno;
    }

    if( $use_swfobject = 1)
    {
        // Using library for auto-enabling Flash object on IE, disabled-Javascript proof
        $out[] = '<script type="text/javascript">';
		
		$out[] = "var flashvars = {'data-file':'$url'};";
		$out[] = "var params = {'allowscriptaccess':'always'};";
		$out[] = "var attributes = {'id':'my_chart'};";

		$out[] = 'swfobject.embedSWF("'. $base .'inc/swf/open-flash-chart.swf", "'. $div_name .'", "'. $width . '", "' . $height . '", "9.0.0", "inc/swf/expressInstall.swf" ,flashvars, params, attributes);';
        $out[] = '</script>';

    	$out[] = '<script type="text/javascript" src="inc/js/saveimage.js"></script>';
		$out[] = '    </head>';

		$out[] = '<body>'; 
        $out[] = '<div id="'. $div_name .'">';
		$out[] = '<a href="http://www.adobe.com/go/getflashplayer">';
		$out[] = '<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />';
		$out[] = '</a>';
		$out[] = '</div>';
        $out[] = '<noscript>';
    }

	$out[] = '<script type="text/javascript" src="inc/js/saveimage.js"></script>';
    $out[] = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="' . $protocol . '://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" ';
    $out[] = 'width="' . $width . '" height="' . $height . '" id="ie_'. $obj_id .'" align="middle">';
    $out[] = '<param name="allowScriptAccess" value="sameDomain" />';
    $out[] = '<param name="movie" value="'. $base .'inc/swf/open-flash-chart.swf?data-file='. $url .'" />';
    $out[] = '<param name="quality" value="high" />';
    $out[] = '<param name="bgcolor" value="#FFFFFF" />';
    $out[] = '<embed src="'. $base .'inc/swf/open-flash-chart.swf?data-file=' . $url .'" quality="high" bgcolor="#FFFFFF" width="'. $width .'" height="'. $height .'" name="'. $obj_id .'" align="middle" allowScriptAccess="sameDomain" ';
    $out[] = 'type="application/x-shockwave-flash" pluginspage="' . $protocol . '://www.macromedia.com/go/getflashplayer" id="'. $obj_id .'"/>';
    $out[] = '</object>';

    if ( $use_swfobject ) {
        $out[] = '</noscript>';
    }

    return implode("\n",$out);
}
?>