<?php
	require("./Pages/Header.php");
	require("./Pages/Data/Donnees.inc.php");
	
	function dispBlank($tabu) {
		while ($tabu > 0) {
			echo "&nbsp&nbsp&nbsp";
			$tabu--;
		}
		echo '-> ';
	}
	
	function display($A, $tabu) {
		// Will display an array, and calls itself if it encounters a sub-array
		
		foreach($A as $key=>$element) {
			dispBlank($tabu);
			if (is_array($element)) {
				echo $key . ' :<br/>';
				display($element, $tabu+1);
			}
			else	echo $element.'<br/>';
		}
		echo '<br/>';
	}
	
	$tabu = 0;
	display($Recettes, $tabu);
	
	require("./Pages/Footer.php");
?>