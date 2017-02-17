<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		
		<!--Bootstrap CSS-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap-theme.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap.css"/>
		<script type="text/javascript" src="css/bootstrap-3.3.0/js/bootstrap.js"></script>
		
		<!--VueJS-->
		<script type="text/javascript" src="js/vue.js"></script>
		
		<!--jQuery-->
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
		
	</head>
	<body>
		<form id="soluteWeightForm" action="labcalculator.php" method="post">
			请选择您要配制的溶液：<br>
			<input type="text" id="solute" >
			<br>
			<input type="text" id="solutionVol" placeholder="请输入您要配制的体积">单位：mL
			<br>
			<input type="text" id="molarity" placeholder="请输入最终摩尔浓度">单位：mol/L
			<br>
			<button type="button" id="soluteWeightBtn">计算</button>
		</form>
		<div id="result1">您计算的结果为：<p></p></div>


		<script type="text/javascript">
			$("#soluteWeightBtn").click(function(){
				var solute = $("#solute").val();
				var solutionVol = $("#solutionVol").val();
				var molarity = $("#molarity").val();
				
				$.post("labcalculator.php", {solute:solute,solutionVol:solutionVol,molarity:molarity}, function(res){
					$("#result1 p").text(res);
				});
			});
		</script>
	</body>
</html>