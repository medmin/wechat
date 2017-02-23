<html>
    <head>
        <meta charset="utf-8">
        <title>乐睿实验助手</title>
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
        <h2 class="weui-btn weui-btn_primary">稀释计算器II：体积或质量浓度</h2>
        <form action="volDilutionCalculator.php" method="post"  id="volDilutionForm">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">母液浓度</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="motherSolutionC" class="weui-input" placeholder="母液浓度">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label">%</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">母液体积</label>
                </div>
                <div class="weui-cell__bd" >
                    <p id="motherSolutionV">求母液体积</p>
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
                    <input type="text" id="workingSolutionC" class="weui-input" placeholder="终浓度">
                </div>
                <div class="weui-cell__ft">
                    <label class="weui-label">%</label>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">工作液体积</label>
                </div>
                <div class="weui-cell__bd">
                    <input type="text" id="workingSolutionV" class="weui-input" placeholder="终体积">
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
        <!--Custom JS-->
        <script type="text/javascript" src="js/AndroidWechatReload.js"></script>

        <script>

            $('#reloadBtn').click(reloadPage());

            $("#volDilutionBtn").click(function () {
                var motherSolutionC = $("#motherSolutionC").val();
                var workingSolutionC = $("#workingSolutionC").val();
                var workingSolutionV = $("#workingSolutionV").val();

                if ( $.isNumeric(motherSolutionC) &&　$.isNumeric(workingSolutionC) && $.isNumeric(workingSolutionV)){
                    if ( motherSolutionC > workingSolutionC ) {
                        $.post("volDilutionCalculator.php",
                            {
                                motherSolutionC : motherSolutionC,
                                workingSolutionC : workingSolutionC,
                                workingSolutionV : workingSolutionV
                            },
                            function (result) {
                                $("#motherSolutionV").text(result).addClass("colorGreen");
                            });
                    }
                    else {
                        $("#motherSolutionV").text("请注意逻辑错误！").addClass("colorRed");
                    }

                }
                else {
                    $("#motherSolutionV").text("请输入数字！").addClass("colorRed");
                }

            });

        </script>
    </body>
</html>