<?php

$finalC = isset($_POST['finalC']) ? $_POST['finalC'] : false;
$finalCUnit = isset($_POST['finalCUnit']) ? $_POST['finalCUnit'] : false;
$soluteMW = isset($_POST['soluteMW']) ? $_POST['soluteMW'] : false ;
$soluteWeight = isset($_POST['soluteWeight']) ? $_POST['soluteWeight'] : false ;

$solventVol =  function ($finalC, $finalCUnit,$soluteMW, $soluteWeight){
    if ( $finalCUnit == 'fc_mol') {
        $solventVol = $soluteWeight * 1000 / ($soluteMW * $finalC);
        $solventVol = number_format($solventVol, 2);
    }
    else if ($finalCUnit == 'fc_gram') {
        $solventVol = $soluteWeight * 1000 / $finalC;
        $solventVol = number_format($solventVol, 2);
    }
    else {
        $solventVol = '请输入恰当数字';
    }
    return $solventVol;
};

echo $solventVol($finalC, $finalCUnit,$soluteMW, $soluteWeight);
