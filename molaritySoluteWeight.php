<html>
	<head>
		<meta charset="utf-8" />
		<title>配置:摩尔浓度</title>
        <!--Bootstrap CSS-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap-theme.css"/>-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap.css"/>-->

        <!--LayUI-->
        <link rel="stylesheet" type="text/css" href="js/layui-v1.0.7/css/layui.css" />

	</head>
	<body>
        <h2>配置:摩尔浓度</h2>
		<form id="soluteWeightForm" action="molaritySoluteWeightCalculator.php" method="post">
			<input type="text" id="soluteMW"  placeholder="请输入溶质的分子量">
			<br>
            <input type="text" id="purity" placeholder="请输入溶质的纯度">%
            <br>
			<input type="text" id="solutionVol" placeholder="请输入您要配制的体积">ml
			<br>
			<input type="text" id="solutionMolarity" placeholder="请输入最终摩尔浓度">mol/L (M)
		</form>
        <br>
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
				var soluteMW = $("#soluteMW").val();
				var purity = $("#purity").val();
				var solutionVol = $("#solutionVol").val();
				var solutionMolarity = $("#solutionMolarity").val();

				if (soluteMW != '' && purity != '' && solutionVol != '' && solutionMolarity != ''){
                    $.post("molaritySoluteWeightCalculator.php",
                        {
                            soluteMW:soluteMW,
                            purity:purity,
                            solutionVol:solutionVol,
                            solutionMolarity:solutionMolarity
                        },
                        function(res){
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