<html>
<head>
    <meta charset="utf-8">
    <title>稀释计算器I：摩尔浓度</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="css/weui.min.css" />
    <style>
        .colorRed {
            color : red;
        }
        .colorGreen {
            color : green;
        }
    </style>
</head>
<body>
    <h2 class="weui-btn weui-btn_primary">稀释计算器I：摩尔浓度</h2>
    <form action="molarityDilutionCalculator.php" method="post" id="molarityVolForm">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">母液浓度</label>
            </div>
            <div class="weui-cell__bd">
                <input type="text" id="motherSolutionMolarityC" class="weui-input" placeholder="母液浓度">
            </div>
            <div class="weui-cell__ft">
                <label class="weui-label">
<!--                    <select class="weui-select">-->
<!--                        <option value="ms_C_default">选择单位</option>-->
<!--                        <option value="ms_M">mol/L (M)</option>-->
<!--                        <option value="ms_mM">mmol/L (mM)</option>-->
<!--                        <option value="ms_uM">μmol/L (μM)</option>-->
<!--                    </select>-->
                    mmol/L (mM)
                </label>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">母液体积</label>
            </div>
            <div class="weui-cell__bd">
                <p id="motherSolutionMolarityV">求母液体积</p>
            </div>
            <div class="weui-cell__ft">
                <label class="weui-label">
<!--                    <select class="weui-select">-->
<!--                        <option value="ms_V_default">选择单位</option>-->
<!--                        <option value="ms_l">L</option>-->
<!--                        <option value="ms_ml">ml</option>-->
<!--                        <option value="ms_ul">μl</option>-->
<!--                    </select>-->
                    ml
                </label>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">工作液浓度</label>
            </div>
            <div class="weui-cell__bd">
                <input type="text" id="workingSolutionMolarityC" class="weui-input" placeholder="工作液浓度">
            </div>
            <div class="weui-cell__ft">
                <label class="weui-label">
<!--                    <select class="weui-select">-->
<!--                        <option value="ws_C_default">选择单位</option>-->
<!--                        <option value="ws_M">mol/L (M)</option>-->
<!--                        <option value="ws_mM">mmol/L (mM)</option>-->
<!--                        <option value="ws_uM">μmol/L (μM)</option>-->
<!--                    </select>-->
                    mmol/L (mM)
                </label>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">工作液体积</label>
            </div>
            <div class="weui-cell__bd">
                <input type="text" id="workingSolutionMolarityV" class="weui-input" placeholder="工作液体积">
            </div>
            <div class="weui-cell__ft">
                <label class="weui-label">
<!--                    <select class="weui-select">-->
<!--                        <option value="ws_V_default">选择单位</option>-->
<!--                        <option value="ws_l">L</option>-->
<!--                        <option value="ws_ml">ml</option>-->
<!--                        <option value="ws_ul">μl</option>-->
<!--                    </select>-->
                    ml
                </label>
            </div>
        </div>
        <div class="weui-cell">
            <p class="colorRed">温馨提示：请注意计量单位，自行换算到要求的单位</p>
        </div>
    </form>
    <button type="button" id="molarityDilutionCalBtn" class="weui-btn weui-btn_primary">计算</button>
    <button type="button" id="ReloadBtn" class="weui-btn weui-btn_default">刷新</button>

    <!--jQuery-->
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

    <script>
        $('#ReloadBtn').click(function () {
            window.location.reload(true);
        });

        $("#molarityDilutionCalBtn").click(function () {
            var motherSolutionMolarityC = $("#motherSolutionMolarityC").val();
            var workingSolutionMolarityC = $("#workingSolutionMolarityC").val();
            var workingSolutionMolarityV = $("#workingSolutionMolarityV").val();

            if ( $.isNumeric(motherSolutionMolarityC) && $.isNumeric(workingSolutionMolarityC) && $.isNumeric(workingSolutionMolarityV) ) {
                if (motherSolutionMolarityC > workingSolutionMolarityC){
                    $.post("molarityDilutionCalculator.php",
                        {
                            motherSolutionMolarityC : motherSolutionMolarityC,
                            workingSolutionMolarityC : workingSolutionMolarityC,
                            workingSolutionMolarityV : workingSolutionMolarityV
                        },
                        function (result) {
                            $("#motherSolutionMolarityV").text(result).addClass("colorGreen");
                        });
                }
                else {
                    $("#motherSolutionMolarityV").text("请注意逻辑错误！").addClass("colorRed");
                }
            }
            else {
                $("#motherSolutionMolarityV").text("请输入数字！").addClass("colorRed");
            }

        });

    </script>
</body>
</html>