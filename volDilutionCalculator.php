<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 14:01
 */

$motherSolutionC = isset($_POST['motherSolutionC']) ? $_POST['motherSolutionC'] : false;
$workingSolutionC = isset($_POST['workingSolutionC']) ? $_POST['workingSolutionC'] : false;
$workingSolutionV = isset($_POST['workingSolutionV']) ? $_POST['workingSolutionV'] : false;

if (isset($_POST['motherSolutionC']) && isset($_POST['workingSolutionC']) && isset($_POST['workingSolutionV'])){
    $motherSolutionV = number_format($workingSolutionC * $workingSolutionV / $motherSolutionC, 2);
}
else {
    $motherSolutionV = 0;
}

echo $motherSolutionV;