<html>
<head>
    <meta charset="utf-8">
    <title>科研小保姆</title>
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
    <h2 class="weui-btn weui-btn_primary">qPCR引物设计v1.0</h2>
    <form action="qPCRPrimerDesignAPI.php" method="post">
        <textarea name="geneSeq" id="geneSeq" cols="30" rows="10" placeholder="请输入基因序列"></textarea>
        <br>
        <input type="text" name="geneID" id="geneID" placeholder="请输入基因序列号" style="width: 231px" >
    </form>
        <button type="button" id="PrimerDesignBtn">开始设计引物</button>
        <br>
        <button type="button" id="PrimerReloadBtn">重新设计引物</button>
    <div id="PrimerDetails"></div>


    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script>
        $("#PrimerDesignBtn").click(function () {
            var geneSeq = $("#geneSeq").val();

            if (geneSeq !== ""){
                $.post("qPCRPrimerDesignAPI.php",
                    {
                        geneSeq : geneSeq,
                    },
                    function (result) {
                        $("#PrimerDetails").text(result).addClass('colorGreen');
                    }
                );
            }
            else {
                $("#PrimerDetails").text("请输入基因序列或基因标号！").addClass('colorRed');
            }
        });
    </script>
</body>
</html>