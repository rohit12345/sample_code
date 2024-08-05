<?php
function calculateTotalPrice($b, $r, $g) {
	$b_price = 7.95;
	$r_price = 32.95;
	$g_price = 24.95;
	
	$total = $b * $b_price + $r * $r_price + $g * $g_price;

	// Apply discounts
	if ($r > 1) {
		$r_price = ($r_price / 2) + ($r - 1) * $r_price;
		$total = $b * $b_price + $r_price + $g * $g_price;
	} else {
		if ($b > 0) {
			$b_price /= 2;
		}
		if ($g > 0) {
			$g_price /= 2;
		}
		$total = $b * $b_price + $r * $r_price + $g * $g_price;	
	}

	// Apply shipping fee
	if ($total < 50) {
		$total += 4.95;
	} elseif ($total < 90) {
		$total += 2.95;
	}
	return $total;
}

// Get quantities from GET parameters
$b1 = isset($_GET['B01']) && !empty($_GET['B01']) ? (int)$_GET['B01'] : 0;
$r1 = isset($_GET['R01']) && !empty($_GET['R01']) ? (int)$_GET['R01'] : 0;
$g1 = isset($_GET['G01']) && !empty($_GET['G01']) ? (int)$_GET['G01'] : 0;

// Calculate total price
if(isset($_GET) && !empty($_GET)) {
	$total_price = calculateTotalPrice($b1, $r1, $g1);
	echo '$'.round($total_price,2);
} else {
	echo "GET parameters are data passed from a form or URL to a PHP script. They are appended to the URL after a question mark (?), with key-value pairs separated by ampersands (&).";
}

?>