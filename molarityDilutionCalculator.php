<?php

$motherSolutionMolarityC = isset($_POST['motherSolutionMolarityC']) ? $_POST['motherSolutionMolarityC'] : false;
$workingSolutionMolarityC = isset($_POST['workingSolutionMolarityC']) ? $_POST['workingSolutionMolarityC'] :false;
$workingSolutionMolarityV = isset($_POST['workingSolutionMolarityV']) ? $_POST['workingSolutionMolarityV'] :false;

if ( isset($_POST['motherSolutionMolarityC']) && isset($_POST['workingSolutionMolarityC']) && isset($_POST['workingSolutionMolarityV']) ) {
    $motherSolutionMolarityV = $workingSolutionMolarityC * $workingSolutionMolarityV / $motherSolutionMolarityC;
    $motherSolutionMolarityV = number_format($motherSolutionMolarityV, 2);
}

else {
    $motherSolutionMolarityV = 0;
}

echo $motherSolutionMolarityV;
