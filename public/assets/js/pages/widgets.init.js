(()=>{var e={series:[{data:[10,20,15,40,20,50,70,60,90,70,110]}],chart:{type:"bar",height:50,sparkline:{enabled:!0}},plotOptions:{bar:{columnWidth:"30%"}},tooltip:{fixed:{enabled:!1},y:{title:{formatter:function(e){return""}}}},colors:["#038edc"]};new ApexCharts(document.querySelector("#sparkline-chart-1"),e).render();var t={series:[{name:"Series A",data:[10,90,30,60,50,90,25,55,30,40]}],chart:{height:50,type:"area",sparkline:{enabled:!0},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:2},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[50,100,100,100]}},colors:["#038edc","transparent"]};new ApexCharts(document.querySelector("#sparkline-chart-2"),t).render();e={series:[{data:[40,20,30,40,20,60,55,70,95,65,110]}],chart:{type:"bar",height:50,sparkline:{enabled:!0}},plotOptions:{bar:{columnWidth:"30%"}},tooltip:{fixed:{enabled:!1},y:{title:{formatter:function(e){return""}}}},colors:["#038edc"]};new ApexCharts(document.querySelector("#sparkline-chart-3"),e).render();t={series:[{name:"Series A",data:[10,90,30,60,50,90,25,55,30,40]}],chart:{height:50,type:"area",sparkline:{enabled:!0},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:2},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[50,100,100,100]}},colors:["#038edc","transparent"]};new ApexCharts(document.querySelector("#sparkline-chart-4"),t).render();t={series:[{name:"New Visitors",data:[21,65,32,80,42,25]}],chart:{height:56,type:"area",sparkline:{enabled:!0},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:2},colors:["#038edc"],fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};new ApexCharts(document.querySelector("#chart-sparkarea-1"),t).render();t={series:[{name:"Source A",data:[40,30,51,33,63,50]}],chart:{height:56,type:"area",sparkline:{enabled:!0},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:2},colors:["#038edc"],fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};new ApexCharts(document.querySelector("#chart-sparkarea-2"),t).render();t={series:[{name:"Source A",data:[21,55,32,80,42,25]}],chart:{height:56,type:"area",sparkline:{enabled:!0},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:2},colors:["#038edc"],fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};new ApexCharts(document.querySelector("#chart-sparkarea-3"),t).render();t={chart:{height:215,type:"donut"},plotOptions:{pie:{donut:{size:"70%"}}},dataLabels:{enabled:!1},series:[44,25,19],labels:["Social","Direct","Others"],colors:["#038edc","#f5f6f8","#5fd0f3"],legend:{show:!0,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0}};new ApexCharts(document.querySelector("#chart-donut"),t).render();t={chart:{height:130,type:"donut"},dataLabels:{enabled:!1},series:[44,25,19],labels:["Revenue","Expenses","Profit"],colors:["#038edc","#dfe2e6","#5fd0f3"],legend:{show:!1,position:"bottom",horizontalAlign:"center",verticalAlign:"middle",floating:!1,fontSize:"14px",offsetX:0}};new ApexCharts(document.querySelector("#chart-donut-reports"),t).render()})();