<html>
<head>
    <meta charset="utf-8">
    <title>稀释计算器I：摩尔浓度</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="css/weui.min.css" />
</head>
<body>
    <h2>稀释计算器I：摩尔浓度</h2>
    <form action="molarityDilutionCalculator.php" method="post" id="molarityVolForm">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label class="weui-label">母液摩尔浓度</label>
            </div>
            <div class="weui-cell__bd">
                <input type="text" id="motherSolutionMolarityC" class="weui-input " placeholder="母液摩尔浓度">
            </div>
            <div class="weui-cell__ft">
                <select class="weui-select">
                    <option value="">选择单位</option>
                    <option value="">mol/L (M)</option>
                    <option value="">mmol/L (mM)</option>
                    <option value="">μmol/L (μM)</option>
                </select>
            </div>
        </div>
        <p>母液体积：
            <input type="text">
            <br>
            <input type="radio">L
            <input type="radio">ml
            <input type="radio">μl
        </p>
        <p>工作液摩尔浓度：
            <input type="text">
            <br>
            <input type="radio">mol/L (M)
            <input type="radio">mmol/L (mM)
            <input type="radio">μmol/L (μM)
        </p>
        <p>工作液体积：
            <input type="text">
            <br>
            <input type="radio">L
            <input type="radio">ml
            <input type="radio">μl
        </p>
    </form>
    <button type="button" id="CalBtn">计算</button>
    <button type="button" id="ReloadBtn">刷新</button>

    <!--jQuery-->
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

    <script>
        $('#ReloadBtn').click(function () {
            window.location.reload(true);
        });

    </script>
</body>
</html>