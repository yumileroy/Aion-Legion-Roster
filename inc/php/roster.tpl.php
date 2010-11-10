<?php
$uri = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php echo $legionname; ?> Legion Roster</title>
<link rel="stylesheet" type="text/css" href="gzload.php?type=css&amp;files=inc/greybox/gb_styles.css,inc/css/style.css" />
<script type="text/javascript">
var GB_ROOT_DIR = "<?php echo $uri ?>inc/greybox/";
</script>
<script type="text/javascript" src="gzload.php?type=js&amp;files=inc/js/sorttable.js,inc/greybox/AJS.js,inc/greybox/AJS_fx.js,inc/greybox/gb_scripts.js"></script>
</head>

<body>

<?php

// Generate Pagination pages from the members
$memberPages = $pagination->generate($members, $charnum);
$gradePages = $pagination->generate($grade, $charnum);
$levelPages = $pagination->generate($level, $charnum);
$classPages = $pagination->generate($class, $charnum);

if ($display !== "all") { ?>

<?php include('inc/php/rosterbody.tpl.php'); ?>

<tbody>
<?php for ( $i = 0; $i < count($memberPages); $i++) {
    echo "<tr>";
    echo $memberPages[$i];
    echo $gradePages[$i];
    echo $levelPages[$i];
    echo $classPages[$i];
    echo "</tr>";
}
?>
</tbody>
</table>

<div class='centerblock'>
<?php echo $pagination->links() . "<br/>"; ?>
<a href='?display=all'>All</a><br/>
<?php include('inc/php/timer-footer.tpl.php'); } ?>
</div>

<?php if ($display == "all") { ?>

<?php include('inc/php/rosterbody.tpl.php'); ?>

<tbody>
<?php for ( $i = 0; $i < count($members); $i++) {
    echo "<tr>";
    echo $members[$i];
    echo $grade[$i];
    echo $level[$i];
    echo $class[$i];
    echo "</tr>";
}
?>
</tbody>
</table>

<div class='centerblock'>
<?php include('inc/php/timer-footer.tpl.php'); } ?>
</div>

</body>
</html>
