<div id='header' class='center' style='text-align:center;'>
<span class='header'>Legion: </span><?php echo $legionname ?><br/>
<span class='header'>Created: </span><?php echo $legioncreated ?><br/>
<span class='header'>Members: </span><?php echo $legionmember ?>
</div>

<div id="wrapper1"><!-- sets background to white and creates full length leftcol-->
	<div id="wrapper2"><!-- sets background to white and creates full length rightcol-->
		<div id="maincol"><!-- begin main content area -->

<div id='leftcol' style='text-align=left;'>
<span class='header'>Classes: </span><br/>
<span class='subheader'>Scout Classes</span><br/>
<?php echo $assassins ?> Assassins <br/>
<?php echo $rangers ?> Rangers <br/>
<span class='subheader'>Priest Classes</span><br/>
<?php echo $chanters ?> Chanters <br/>
<?php echo $clerics ?> Clerics <br/>
<span class='subheader'>Warrior Classes</span><br/>
<?php echo $gladiators ?> Gladiators <br/>
<?php echo $templars ?> Templars <br/>
<span class='subheader'>Mage Classes</span><br/>
<?php echo $sorcerers ?> Sorcerers <br/>
<?php echo $spiritmasters ?> Spiritmasters <br/>
<br/>
<a href="ofc.php" title="<?php echo $legionname ?> Class Percentage" rel="gb_page_center[550, 550]">Class Percentage</a>
</div>


<div id='rightcol' style='text-align=right;'>
<span class='header'>Grades: </span><br/>
<?php echo $brigadegeneral ?> Brigade General <br/>
<?php echo $centurions ?> Centurions <br/>
<?php echo $legionaries ?> Legionaries <br/>

<span class='header'>Levels: </span><br/>
<?php
foreach ($levels as $levelskey => $levelsvalue) {
    echo "Level $levelskey: $levelsvalue<br/>";
}
?>
</div>

<div id='centercol'>
<table class='sortable'>
<thead>
<tr>
<th class='centeralign'>
<b>Legion Members</b>
</th>
<th class='centeralign'>
<b>Grade</b>
</th>
<th class='centeralign'>
<b>Level</b>
</th>
<th class='centeralign'>
<b>Class</b>
</th>
</tr>
</thead>
