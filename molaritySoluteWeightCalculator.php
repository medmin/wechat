<?php

class Calculator {
	
	const stdSolutionVol = 1000;
	const percentage =  0.01 ;
	
	public function getSoluteWeight($soluteMW, $purity, $solutionVol, $solutionMolarity) {
		$soluteWeight = ($solutionVol / self::stdSolutionVol) *$solutionMolarity * $soluteMW / ($purity * self::percentage);
		return number_format($soluteWeight, 2);
		// number_format's return value is string.
	}
	
}

$calculator = new Calculator();

if (isset($_POST['soluteMW']) && isset($_POST['purity']) && isset($_POST['solutionVol']) && isset($_POST['solutionMolarity'])){
    $soluteMW = $_POST['soluteMW'];
	$purity = $_POST['purity'];
	$solutionVol = $_POST['solutionVol'];
    $solutionMolarity = $_POST['solutionMolarity'];
}
else {
	$solute = 0;
	$purity = 100 ;
	$solutionVol = 0;
	$molarity = 0;
}


$soluteWeight = $calculator->getSoluteWeight($soluteMW, $purity, $solutionVol, $solutionMolarity);


//这里必须用echo，否则不能输出结果。
echo $soluteWeight;