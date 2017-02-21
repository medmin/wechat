<html>
    <head>
        <meta>
        <title></title>
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <link rel="stylesheet" href="css/weui.min.css" />
    </head>
    <body>
        <form action="" method=""  id="">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">母液浓度</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="soluteMW" class="weui-input " placeholder="溶质分子量">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label">%(v/v)</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">母液体积</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="purity" class="weui-input" placeholder="求母液体积">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label">ml</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">工作液浓度</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="solutionVol" class="weui-input" placeholder="终浓度">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label">%(v/v)</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">工作液体积</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="solutionMolarity" class="weui-input" placeholder="终体积">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label">ml</label>
                </div>
            </div>
        </form>

        <button type="button" id="volDilutionBtn" class="weui-btn weui-btn_primary">计算</button>
        <button type="button" id="reloadBtn" class="weui-btn weui-btn_default">刷新</button>


        <!--jQuery-->
        <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

        <script>

        </script>
    </body>
</html>