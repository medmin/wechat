<?php

class Calculator {
	
	const molUnit = "mol/L";
	const GRAM = "g";
	const KILOGRAM = "Kg";
	const stdSolutionVol = 1000;
	const mlVol = "mL";
	
	protected $stdSolventMolWeight = array('H2O'=>18.01);
	protected $stdSoluteMolWeight = array('NaCl'=>58.44);
	
	public function getSoluteWeight($solute, $solutionVol, $molarity) {
//		$soluteMolWeight = $stdSoluteMolWeight[$solute];  这个不能识别，必须用$this->stdSoluteMolWeight[$solute]
		$soluteWeight = $molarity * $this->stdSoluteMolWeight[$solute] * $solutionVol / self::stdSolutionVol;
		return number_format($soluteWeight, 2).self::GRAM; // number_format's return value is string.
	}
	
}

$calculator = new Calculator();

if (isset($_POST['solute']) && isset($_POST['solutionVol']) && isset($_POST['molarity'])){
	$solute = $_POST['solute'];
	$solutionVol = $_POST['solutionVol'];
	$molarity = $_POST['molarity'];
}
else {
	$solute = 'NaCl';
	$solutionVol = 0;
	$molarity = 0;
}


$soluteWeight = $calculator->getSoluteWeight($solute, $solutionVol, $molarity);


//这里必须用echo，否则不能输出结果。
//此外，如果有多个返回值呢？咋办？
echo $soluteWeight;

?>