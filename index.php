<!DOCTYPE html>

<html>
	
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
	
<div id='results'>
</div>

	
<?php

require 'randomizer.php';

$factions = array(new Faction('giants', 'red'), new Faction('chaosmagicians', 'red'),
	new Faction('engineers', 'gray'), new Faction('dwarves', 'gray'), 
	new Faction('witches', 'green'), new Faction('auren', 'green'),
	new Faction('mermaids', 'blue'), new Faction('swarmlings', 'blue'), 
	new Faction('alchemists', 'black'), new Faction('darklings', 'black'), 
	new Faction('cultists', 'brown'), new Faction('halflings', 'brown'),
	new Faction('nomads', 'yellow'), new Faction('fakirs', 'yellow'), 
	new Faction('shapeshifters', 'variable'), new Faction('riverwalkers', 'variable'), 
	new Faction('acolytes', 'variable'), new Faction('dragonlords', 'variable'),
	new Faction('icemaidens', 'variable'), new Faction('yetis', 'variable'));

$pairings = array(	"icemaidens"	=>	"yetis",
					"yetis"			=>	"icemaidens",
					"shapeshifters"	=>	"riverwalkers",
					"riverwalkers"	=>	"shapeshifters",
					"acolytes"		=>	"dragonlords",
					"dragonlords"	=>	"acolytes"
);

$randomizer = new Randomizer($factions, $pairings);
$randomizer->run();
$randomizer->display_results();	




?>
	
</body>
</html>
