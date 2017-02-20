<html>
<head>
    <meta charset="utf-8">
    <title>稀释计算器I：摩尔浓度</title>
    <!--Bootstrap CSS-->
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap-theme.css"/>-->
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap.css"/>-->

    <!--LayUI-->
    <link rel="stylesheet" type="text/css" href="js/layui-v1.0.7/css/layui.css" />

</head>
<body>
    <h2>稀释计算器I：摩尔浓度</h2>
    <form action="molarityDilutionCalculator.php" method="post" id="molarityVolForm">
        <p>母液摩尔浓度：
            <input type="text">
            <br>
            <input type="radio">mol/L (M)
            <input type="radio">mmol/L (mM)
            <input type="radio">μmol/L (μM)
        </p>
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
    <!--LayUI JS-->
    <script type="text/javascript" src="js/layui-v1.0.7/layui.js"></script>
    <!--Bootstrap JS-->
    <!--<script type="text/javascript" src="css/bootstrap-3.3.0/js/bootstrap.js"></script>-->

    <script>
        $('#ReloadBtn').click(function () {
            window.location.reload(true);
        });

    </script>
</body>
</html>