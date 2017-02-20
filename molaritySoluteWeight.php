<html>
	<head>
		<meta charset="utf-8" />
		<title>乐睿实验助手</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <link rel="stylesheet" href="css/weui.min.css" />
        <!--Bootstrap CSS-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap-theme.css"/>-->
        <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap.css"/>-->

	</head>
	<body>
        <h2 class="weui-btn weui-btn_primary">溶液配置I:摩尔浓度</h2>
		<form id="soluteWeightForm" action="molaritySoluteWeightCalculator.php" method="post">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">摩尔质量<br>(分子量)</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="soluteMW" class="weui-input " placeholder="溶质分子量">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label"> g/mol</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">试剂纯度</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="purity" class="weui-input" placeholder="试剂纯度">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label"> %</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">溶液体积</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="solutionVol" class="weui-input" placeholder="溶液终体积">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label"> ml</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">溶液浓度</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="solutionMolarity" class="weui-input" placeholder="溶液终浓度">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label"> mol/L (M)</label>
                </div>
            </div>
		</form>

		<div class="weui-cell">
            <p></p>
            <div class="weui-cell__hd">
                <label class="weui-label">计算结果</label>
            </div>
            <div class="weui-cell__bd">
                <p id="result1"></p>
            </div>
            <div class="weui-cell__ft">
                <label class="weui-label"> g</label>
            </div>
        </div>

        <button type="button" id="soluteWeightCalculatorBtn" class="weui-btn weui-btn_primary">计算</button>
        <button type="button" id="reloadBtn" class="weui-btn weui-btn_default">刷新</button>


        <!--VueJS-->
<!--        <script type="text/javascript" src="js/vue.js"></script>-->
        <!--jQuery-->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

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
                        $("#result1").text(res);
                    });
                }
                else {
                    $("#result1").text("请输入适当的数字");
                }


			});
		</script>
	</body>
</html>