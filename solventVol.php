<html>
<head>
    <meta charset="utf-8">
    <title>科研小保姆</title>
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
<h2 class="weui-btn weui-btn_primary">溶液配制II：求溶剂体积</h2>
<form action="solventVolCalculator.php" method="post" id="solventVolForm">
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <label class="weui-label">最终浓度</label>
        </div>
        <div class="weui-cell__bd">
            <input type="number" id="finalC" class="weui-input" placeholder="最终浓度">
        </div>
        <div class="weui-cell__ft">
            <label class="weui-label">
                <select class="weui-select colorRed" id="finalCUnit">
                    <option value="fc_default">浓度单位</option>
                    <option value="fc_mol">mol/L (M)</option>
                    <option value="fc_gram">g/L</option>
                </select>
            </label>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <label class="weui-label">溶质分子量</label>
        </div>
        <div class="weui-cell__bd">
            <input type="number" id="soluteMW" class="weui-input" placeholder="如果浓度单位是%，这里可不填">
        </div>
        <div class="weui-cell__ft">
            <label class="weui-label">
                g/mol
            </label>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd">
            <label class="weui-label">溶质质量</label>
        </div>
        <div class="weui-cell__bd">
            <input type="number" id="soluteWeight" class="weui-input" placeholder="溶质质量">
        </div>
        <div class="weui-cell__ft">
            <label class="weui-label">
                g
            </label>
        </div>
    </div>

    <div class="weui-cell">
        <div class="weui-cell__hd">
            <label class="weui-label">溶剂体积</label>
        </div>
        <div class="weui-cell__bd">
            <p id="solventVol">求溶剂体积</p>
        </div>
        <div class="weui-cell__ft">
            <label class="weui-label">
                ml
            </label>
        </div>
    </div>
    <div class="weui-cell">
        <p class="colorRed">温馨提示：1、请注意计量单位，2、请注意本计算器假设溶质溶解后体积为零，可以满足一般实验要求，如果要求精确，请使用容量瓶定容。</p>
    </div>
</form>
<button type="button" id="solventVolCalBtn" class="weui-btn weui-btn_primary">计算</button>
<button type="button" id="ReloadBtn" class="weui-btn weui-btn_default">刷新</button>

<!--jQuery-->
<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<!--Custom JS-->
<script type="text/javascript" src="js/AndroidWechatReload.js"></script>

<script>
    $('#ReloadBtn').click(function () {
        window.location.href = updateUrl(window.location.href);
    });

    $("#solventVolCalBtn").click(function () {
        var finalC = parseFloat($("#finalC").val());
        var soluteMW = parseFloat($("#soluteMW").val());
        var soluteWeight = parseFloat($("#soluteWeight").val());

        var finalCUnit = $('#finalCUnit').val();


        if ( finalC > 0 && soluteMW > 0  && soluteWeight > 0 ) {

            if (finalCUnit == 'fc_default'){
                $("#solventVol").text("请选择浓度单位！").addClass("colorRed");
            }
            else if ( finalCUnit == 'fc_mol' || finalCUnit == 'fc_gram' ) {
                $.post("solventVolCalculator.php",
                    {
                        finalC : finalC,
                        soluteMW : soluteMW,
                        soluteWeight : soluteWeight,
                        finalCUnit : finalCUnit
                    },
                    function (result) {
                        $("#solventVol").text(result).addClass("colorGreen");
                    });
            }
        }
        else  {
            $("#solventVol").text("请输入恰当的数字！").addClass("colorRed");
        }

    });

</script>
</body>
</html>