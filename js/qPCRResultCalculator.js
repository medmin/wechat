var x=0;
var y=0;
var columnHeader;
var rowHeader;
$(function(){
	columnHeader=$("#columnHeader");
	rowHeader=$("#rowHeader");
	var initRowML=rowHeader.css("marginLeft");
	var initColumnMT=columnHeader.css("marginTop");
	var initRowML=parseInt(initRowML.replace("px",""));
	var initColumnMT=parseInt(initColumnMT.replace("px",""));
	$(".data-number").keydown(function(e){
		return DealKeyCode(e);
	}).focus(function(){
		//this.style.imeMode='disabled';
	});
	$("#buildTable").click(function(){
		var geneNums=$("#geneNums").val();
		var testNums=$("#testNums").val();
		var refNums=$("#refNums").val();
		var repeatNums=$("#repeatNums").val();
		if(geneNums&&testNums&&refNums&&repeatNums){
			SwitchStatus(false);
			geneNums=parseInt(geneNums);
			testNums=parseInt(testNums);
			refNums=parseInt(refNums);
			repeatNums=parseInt(repeatNums);
			if(!(geneNums>1&&testNums>0&&refNums>0&&repeatNums>0)){
				alert("请确认:基因数>1,实验样品组>0,对照样品组>0,重复试验次数>0");
				return false;
			}
			var data=BulidTable(geneNums,testNums,refNums,repeatNums);
			rowHeader.html(data[0]);
			columnHeader.html(data[1]);
			$("#dataTable").html(data[2]);
			$(".cp").click(function(){
				var geneID=this.id.replace("_icon","").replace("gene_","");
				layer.open({
					type:1,
					title:"导入基因数据(导入方法：从excel里复制输入，直接粘贴到下面！)",
					area:['600px','600px'],
					offset:'3%',
					content:"<div class='data-area'><textarea class='gene-data' id='geneDataArea'></textarea></div>",
					btn:['导入数据','关闭窗口'],
					yes:function(){
						var data=$("#geneDataArea").val();
						var dataArr=AnalyzData(data,refNums+testNums,repeatNums);
						if(dataArr.length==0){
							alert("导入失败,数据有误!");
						}else{
							ImportData(dataArr,geneID,repeatNums);
						}
						layer.closeAll();
					},
					cancel:function(){}
				});
			});
		}else{
			alert("请确认:基因数>1,实验样品组>0,对照样品组>0,重复试验次数>0");
			return false;
		}
	});
	$("#delTable").click(function(){
		SwitchStatus(true);
		$("#dataTable").html("");
		rowHeader.html("");
		columnHeader.html("");
		$("#geneNums").val("");
		$("#testNums").val("");
		$("#refNums").val("");
		$("#repeatNums").val("");
	});
	$("#calcResult").click(function(){
		Calc();
	});
	$(window).scroll(function(){
		var jqo=$(this);
		if(jqo.scrollLeft()!=x){
			rowHeader.css("marginLeft",initRowML+jqo.scrollLeft()+"px");
		}
		if(jqo.scrollTop()!=y){
			columnHeader.css("marginTop",initColumnMT+jqo.scrollTop()+"px");
		}
		x=jqo.scrollLeft();
		y=jqo.scrollTop();
	});
});
function ImportData(data,geneID,repeatNums){
	var initRow=2;
	var initCol=4+(geneID-1)*repeatNums;
	for(var i=0;i<data.length;i++){
		var R="R"+(initRow+i);
		for(var j=0;j<data[i].length;j++){
			var C="C"+(initCol+j);
			$("#"+R+"_"+C).val(data[i][j]);
		}
	}
}
function AnalyzData(data,sampleCount,repeatNums){
	var arrs=data.split(/\n/g);
	var pass=true;
	if(arrs.length<sampleCount){
		pass=false;
	}else{
		var newRow=[];
		for(var i=0;i<arrs.length;i++){
			if(arrs[i].replace(/\s+/g,"").length>0){
				newRow.push(arrs[i]);
			}
		}
		arrs=newRow;
		if(arrs.length!=sampleCount){
			pass=false;
		}
	}
	if(pass){
		for(var i=0;i<arrs.length;i++){
			var dataDetail=arrs[i].split(/\t/g);
			if(dataDetail.length==repeatNums){
				arrs[i]=dataDetail;
			}else{
				dataDetail=arrs[i].split(/\x20/g);
				if(dataDetail.length==repeatNums){
					arrs[i]=dataDetail;
				}else{
					pass=false;
				}
			}
			for(var k=0;k<arrs[i].length;k++){
				if(!arrs[i][k].match(/^[\-]?[0-9\.]+$/)){
					pass=false;
				}
			}
		}
	}
	if(pass){
		return arrs;
	}else{
		return [];
	}
}
function Calc(){
	var geneNums=$("#geneNums").val();
	var testNums=$("#testNums").val();
	var refNums=$("#refNums").val();
	var repeatNums=$("#repeatNums").val();
	geneNums=parseInt(geneNums);
	testNums=parseInt(testNums);
	refNums=parseInt(refNums);
	repeatNums=parseInt(repeatNums);
	sampleCount=refNums+testNums;
	var repeatAvg="";
	var genelist=[];
	var initCol=4;//数据起始列
	var initRow=2;//数据起始行
	var error=false;
	for(var i=0;i<geneNums;i++){
		var temp=[];
		for(var j=0;j<sampleCount;j++){
			var count=0;
			var SD5=0;
			var sample=[];
			for(var z=0;z<repeatNums;z++){
				var row=initRow+j;
				var col=initCol+z+i*repeatNums;
				var inputID="R"+row+"_"+"C"+col;
				var inputObj=$("#"+inputID);
				var data=$("#"+inputID).val();
				if(!data||!data.match(/^[\-]?[0-9\.]+$/)){
					inputObj.addClass("border-red");
					inputObj.click(function(){
						$(this).removeClass("border-red");
						$(this).off("click");
					});
					error=true;
				}else{
					data=parseFloat(data);
					sample.push(data);
					count+=data;
				}
			}
			repeatAvg=count/repeatNums;
			count=0;
			SD5=CalcSD(repeatAvg,sample)*5;
			var pass=0;
			for(var t in sample){
				if(Math.abs(sample[t]-repeatAvg)<=SD5){
					count+=sample[t];
					pass++;
				}
			}
			repeatAvg=count/pass;
			temp.push({"dataID":j+1,"avg":repeatAvg});
		}
		genelist.push({"geneID":i+1,"data":temp});
	}
	if(error){
		alert("数据有误!");
		return false;;
	}
	var refGene=[];
	for(var m=0;m<sampleCount;m++){
		refGene.push(genelist[0].data[m].avg);
	}
	var diff=[];
	for(var m=1;m<genelist.length;m++){
		var temp=[];
		for(var n=0;n<sampleCount;n++){
			temp.push(genelist[m].data[n].avg-refGene[n]);
		}
		diff.push({"geneID":genelist[m].geneID,"val":temp});
	}
	var newRefAvg=[];
	for(var m=0;m<diff.length;m++){
		var count=0;
		for(var n=0;n<refNums;n++){
			count+=diff[m].val[n];
		}
		newRefAvg.push(count/refNums);
	}
	for(var m=0;m<diff.length;m++){
		for(var n=0;n<diff[m].val.length;n++){
			diff[m].val[n]=Math.pow(2,(diff[m].val[n]-newRefAvg[m])*-1);
		}
	}
	ShowResult(diff);
}
function CalcSD(avg,sample){
	var count=0;
	for(var t in sample){
		count+=Math.pow(sample[t]-avg,2);
	}
	return Math.sqrt(count);
}
function ShowResult(genes){
	var jqo=$("#dataTable tr");
	for(var j=0;j<jqo.length;j++){
		for(var i=0;i<genes.length;i++){
			if(j==0){
				var geneName=$("#gene_"+genes[i].geneID).val();
				jqo.eq(j).append("<td><input class='result' type='text' value='"+geneName+"'></td>");
			}else{
				jqo.eq(j).append("<td><input class='result' type='text' value='"+toFixed(genes[i].val[j-1],3)+"'></td>");
			}
		}
	}
	window.scrollTo(document.body.scrollWidth,0);
}
function BulidTable(geneNums,testNums,refNums,repeatNums){
	var row=testNums+refNums+1;
	var column=repeatNums*geneNums+3;
	var serial="<span class='serial'><input class='column-flag' type='text' value='[s]'></span>";
	var serialFirst="<span class='serial first'><input class='column-flag' type='text' value='[s]'></span>";
	var serialSecond="<span class='serial second'><input class='column-flag' type='text' value='[s]'></span>";
	var inputTd="<td  class='[class]' column='[column]' row='[row]' flag='[row]_[column]'><input  id='[row]_[column]' type='text'></td>";
	var inputTd1="<td  style='width:85px'><input style='width:85px' value='[v]' type='text'></td>";
	var inputTd2="<td><input value='[v]' type='text'></td>";
	var colTd="<td column='[column]' row='[row]' flag='[row]_[column]' colspan='[cs]'><input id='gene_[gene]' style='width:[w];' type='text' value='[v]'><img  src='./img/cp.png' class='cp' id='gene_[gene]_icon'></td>";
	var rowTd="<td column='[column]' row='[row]' flag='[row]_[column]' style='vertical-align:middle;' rowspan='[rs]'><input value='[v]' style='height:100%;' type='text'></td>";
	var content="";
	var result="";
	var rowHeader="";
	var columnHeader="";
	for(var i=0;i<=row;i++){
		for(var j=0;j<=column;j++){
			if(i==0){
				if(j>0){
					if(j==1){
						columnHeader+=serialFirst.replace("[s]","C"+formatString(j));
					}else if(j==2){
						columnHeader+=serialSecond.replace("[s]","C"+formatString(j));
					}else{
						columnHeader+=serial.replace("[s]","C"+formatString(j));
					}
				}
			}else{
				if(j==0){
					if(i==1){
						rowHeader+=serialFirst.replace("[s]","R"+formatString(i));
					}else{
						rowHeader+=serial.replace("[s]","R"+formatString(i));
					}
				}else{
					if(i==1){//第一行
						if(j<=3){
							if(j==2){
								content+=inputTd1.replace("[v]","样本名称");
							}else if(j==3){
								content+=inputTd2.replace("[v]","样本编号");
							}else{
								content+=inputTd2.replace("[v]","   ");
							}
						}else{
							if((j-3)%repeatNums==0){
								if((j-3)==repeatNums){
									content+=colTd.replace(/\[cs\]/g,repeatNums).replace("[w]",65*repeatNums+(repeatNums-1)+"px").replace("[v]","对照基因").replace(/\[row\]/g,"R"+i).replace(/\[column\]/g,"C"+j).replace(/\[gene\]/g,(j-3)/repeatNums);
								}else{
									content+=colTd.replace(/\[cs\]/g,repeatNums).replace("[w]",65*repeatNums+(repeatNums-1)+"px").replace("[v]","基因名").replace(/\[row\]/g,"R"+i).replace(/\[column\]/g,"C"+j).replace(/\[gene\]/g,(j-3)/repeatNums);									
								}
							}
						}
					}else{
						if(j==1){//第一列
							if(i==2){//第二行开始
								content+=rowTd.replace(/\[rs\]/g,refNums).replace("[v]","对照组");
							}else if(i==(2+refNums)){
								content+=rowTd.replace(/\[rs\]/g,testNums).replace("[v]","实验组");
							}
						}else{
							if((j-3)%repeatNums==0){
								content+=inputTd.replace(/\[row\]/g,"R"+i).replace(/\[column\]/g,"C"+j).replace("[class]","group-border");
							}else{
								if(j==2){
									content+=inputTd.replace(/\[row\]/g,"R"+i).replace(/\[column\]/g,"C"+j).replace("[class]","nametd");
								}else{
									content+=inputTd.replace(/\[row\]/g,"R"+i).replace(/\[column\]/g,"C"+j).replace("[class]","");								
								}
							}
						}
					}
				}
			}
		}
		if(i>0){
			result+="<tr>"+content+"</tr>";
		}
		content="";
	}
	return [rowHeader,columnHeader,result];
}
function formatString(i){
	if(i<10){
		return "00"+i;
	}else if(i<100){
		return "0"+i;
	}else{
		return  i;
	}
}
function SwitchStatus(status){
	if(status){
		$("#row").removeAttr("disabled");
		$("#column").removeAttr("disabled");
		$("#group").removeAttr("disabled");
		$("#buildTable").removeAttr("disabled");
		$("#buildTable").removeClass("disabled-btn");
	}else{
		$("#row").attr("disabled","disabled");
		$("#column").attr("disabled","disabled");
		$("#group").attr("disabled","disabled");
		$("#buildTable").attr("disabled","disabled");
		$("#buildTable").addClass("disabled-btn");
	}
}
function DealKeyCode(e){
	var code = null;
	//只能输入数字
	if($.browser.msie){
		code = event.keyCode;
	}else{
		code = e.which;
	}
	//48 - 57 上排数字键    96 - 105 数字键盘   8 删除键   37 - 40 上下左右
	if (((code > 47) && (code < 58)) || (code == 8) || (code >= 96 && code <= 105)||(code>=37&&code<=40)||(code==9)) {  
        return true;  
    }else{
    	return false;
    }
}
function toFixed(num, s) {
    var times = Math.pow(10, s)
    var des = num * times + 0.5
    des = parseInt(des, 10) / times
    return des + ''
}