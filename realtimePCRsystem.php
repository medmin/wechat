<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RealTime-PCR System</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-3.3.0/css/bootstrap.css"/>
<!--    <script type="text/javascript" src="css/bootstrap-3.3.0/js/bootstrap.js"></script>-->
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
    <div>
        <form id="RealTimePCRForm" method="post" action="realtimePCRsystemCalculator.php">
            <h2>Choose the type of your PCR machine: </h2>
            <p>
                <select name="PCRMachineType">
                    <option value="default" selected="selected">Please Click here to select the type of your PCR machine!</option>
                    <option value="typeA">BioRad iCycler, MyiQ, iQ5, CFX-96,CFX-384, Eppendorf Mastercycler realplex, Roche LightCycler 480,LightCycler 2.0</option>
                    <option value="typeB">ABI PRISM 7000/7300/7700/7900H and 7900HTFast, ABI Step One, ABI Step One Plus</option>
                    <option value="typeC">ABI 7500，7500 Fast, ABI Viia7, Stratagene Mx3000P, Mx3005P, Mx4000</option>
                </select>
            </p>
            <p id="PCRmachineWarning"></p>
            <h2>Fill the following form: </h2>
            <table border="1">
                <tr>
                    <th>PCR Components</th>
                    <th>1 Reaction (μL)</th>
                    <th><input type="number" id="reactionNumber" placeholder="How many reactions?"></th>
                </tr>
                <tr>
                    <td>2X qPCR Mix</td>
                    <td class="stdValue">10</td>
                    <td class="resultValue"></td>
                </tr>
                <tr>
                    <td>Primer 1 (2μM)</td>
                    <td class="stdValue">2</td>
                    <td class="resultValue"></td>
                </tr>
                <tr>
                    <td>Primer 2 (2μM)</td>
                    <td class="stdValue">2</td>
                    <td class="resultValue"></td>
                </tr>
                <tr>
                    <td>cDNA</td>
                    <td class="stdValue">2</td>
                    <td class="resultValue"></td>
                </tr>
                <tr>
                    <td>ROX (50X)</td>
                    <td class="stdValue">0</td>
                    <td class="resultValue"></td>
                </tr>
                <tr>
                    <td>dd H<sub>2</sub>O</td>
                    <td class="stdValue">0</td>
                    <td class="resultValue"></td>
                </tr>
                <tr>
                    <td>总体积</td>
                    <td class="stdValue">20</td>
                    <td class="resultValue"></td>
                </tr>
            </table>
        </form>
    </div>
    <div>
        <p id="PCRsystemWarning"></p>
    </div>

    <button type="button" id="PCRsystemBtn">计算</button>
<!--    <button type="button" id="PCRsystemReloadBtn">刷新</button>-->

    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>

    <script>

        $("#PCRsystemBtn").click(function () {

            if ( $("select").val() == 'default') {
                $("#PCRmachineWarning").text("The type of PCR machine is required.").addClass('colorRed');
            }
            else if ($("select").val() == 'typeA') {
                $("#PCRmachineWarning").text("Great!").addClass('colorGreen');
                $(".stdValue").get(4).innerHTML = 0;
                $(".stdValue").get(5).innerHTML = 20 - 10 - 2 - 2 - 2 - $(".stdValue").get(4).innerHTML;
            }
            else if ($("select").val() == 'typeB') {
                $("#PCRmachineWarning").text("Great!").addClass('colorGreen');
                $(".stdValue").get(4).innerHTML = 0.4;
                $(".stdValue").get(5).innerHTML = 20 - 10 - 2 - 2 - 2 - $(".stdValue").get(4).innerHTML;
            }
            else if ($("select").val() == 'typeC') {
                $("#PCRmachineWarning").text("Great!").addClass('colorGreen');
                $(".stdValue").get(4).innerHTML = 0.1;
                $(".stdValue").get(5).innerHTML = 20 - 10 - 2 - 2 - 2 - $(".stdValue").get(4).innerHTML;
            }

            if ( ! ($("#reactionNumber").val() > 0) ) {
                $("#PCRsystemWarning").text("reactionNumber should be a positive integer.").addClass('colorRed');
            }
            else {
                $("#PCRsystemWarning").text("Your reaction number is " + ($("#reactionNumber").val())).addClass('colorGreen');
            }

            var machineType = $("select").val();

            var stdqPCRMixVol = Number($(".stdValue").get(0).innerHTML);
            var stdPrimer1Vol = Number($(".stdValue").get(1).innerHTML);
            var stdPrimer2Vol = Number($(".stdValue").get(2).innerHTML);
            var stdcDNAVol = Number($(".stdValue").get(3).innerHTML);
            var stdROXVol = Number($(".stdValue").get(4).innerHTML);
            var stdddH2OVol = Number($(".stdValue").get(5).innerHTML);
            var stdTotalVol = Number($(".stdValue").get(6).innerHTML);

            var reactionNumber = $("#reactionNumber").val();

            $.post("realtimePCRsystemCalculator.php",
                {
                    machineType : machineType,
                    stdqPCRMixVol : stdqPCRMixVol,
                    stdPrimer1Vol : stdPrimer1Vol,
                    stdPrimer2Vol : stdPrimer2Vol,
                    stdcDNAVol : stdcDNAVol,
                    stdROXVol : stdROXVol,
                    stdddH2OVol : stdddH2OVol,
                    stdTotalVol : stdTotalVol,
                    reactionNumber : reactionNumber

                },
                function (result) {
                $(".resultValue").get(0).innerHTML = JSON.parse(result)[0];
                $(".resultValue").get(1).innerHTML = JSON.parse(result)[1];
                $(".resultValue").get(2).innerHTML = JSON.parse(result)[2];
                $(".resultValue").get(3).innerHTML = JSON.parse(result)[3];
                $(".resultValue").get(4).innerHTML = JSON.parse(result)[4];
                $(".resultValue").get(5).innerHTML = JSON.parse(result)[5];
                $(".resultValue").get(6).innerHTML = JSON.parse(result)[6];
            });

        });
    </script>
</body>
</html>