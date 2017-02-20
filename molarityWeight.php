<html>
	<head>
		<meta charset="utf-8" />
		<title>摩尔浓度计算器</title>
        <!--Bootstrap CSS-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap-theme.css"/>-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap.css"/>-->

        <!--LayUI-->
        <link rel="stylesheet" type="text/css" href="js/layui-v1.0.7/css/layui.css" />

	</head>
	<body>
        <h2>摩尔浓度计算器：</h2>
		<form id="soluteWeightForm" action="molarityWeightCalculator.php" method="post">
			<input type="text" id="solute"  placeholder="请输入溶质的分子量">
			<br>
			<input type="text" id="solutionVol" placeholder="请输入您要配制的体积">单位：ml
			<br>
			<input type="text" id="molarity" placeholder="请输入最终摩尔浓度">单位：mol/L (M)
			<br>

		</form>

        <button type="button" id="soluteWeightCalculatorBtn">计算</button>
        <button type="button" id="reloadBtn">刷新</button>
		<div id="result1"><p></p></div>


        <!--VueJS-->
        <script type="text/javascript" src="js/vue.js"></script>
        <!--jQuery-->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
        <!--LayUI JS-->
        <script type="text/javascript" src="js/layui-v1.0.7/layui.js"></script>
        <!--Bootstrap JS-->
        <!--<script type="text/javascript" src="css/bootstrap-3.3.0/js/bootstrap.js"></script>-->

		<script type="text/javascript">

            $('#reloadBtn').click(function () {
                window.location.reload(true);
            });


			$("#soluteWeightCalculatorBtn").click(function(){
				var solute = $("#solute").val();
				var solutionVol = $("#solutionVol").val();
				var molarity = $("#molarity").val();

				if (solute != '' && solutionVol != '' && molarity != ''){
                    $.post("molarityWeightCalculator.php", {solute:solute,solutionVol:solutionVol,molarity:molarity}, function(res){
                        $("#result1 p").text("您计算的结果为：" + res);
                    });
                }
                else {
                    $("#result1 p").text("请输入适当的数字。");
                }


			});
		</script>
	</body>
</html>