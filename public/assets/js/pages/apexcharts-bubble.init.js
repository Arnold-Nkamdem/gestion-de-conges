(()=>{function e(e){if(console.log(e),null!==document.getElementById(e)){var t=document.getElementById(e).getAttribute("data-colors");return(t=JSON.parse(t)).map((function(e){var t=e.replace(" ","");if(-1===t.indexOf(",")){var a=getComputedStyle(document.documentElement).getPropertyValue(t);return a||t}var n=e.split(",");if(2==n.length){var r=getComputedStyle(document.documentElement).getPropertyValue(n[0]);return r="rgba("+r+","+n[1]+")"}return t}))}}function t(e,t,a){for(var n=0,r=[];n<t;){var m=Math.floor(750*Math.random())+1,l=Math.floor(Math.random()*(a.max-a.min+1))+a.min,o=Math.floor(61*Math.random())+15;r.push([m,l,o]),864e5,n++}return r}var a=e("simple_bubble"),n={series:[{name:"Bubble1",data:t(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"Bubble2",data:t(new Date("12 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"Bubble3",data:t(new Date("13 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"Bubble4",data:t(new Date("14 Feb 2017 GMT").getTime(),20,{min:10,max:60})}],chart:{height:350,type:"bubble",toolbar:{show:!1}},dataLabels:{enabled:!1},fill:{opacity:.8},title:{text:"Simple Bubble Chart",style:{fontWeight:500}},xaxis:{tickAmount:12,type:"category"},yaxis:{max:70},colors:a};new ApexCharts(document.querySelector("#simple_bubble"),n).render();a=e("bubble_chart"),n={series:[{name:"Product1",data:t(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"Product2",data:t(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"Product3",data:t(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"Product4",data:t(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:60})}],chart:{height:350,type:"bubble",toolbar:{show:!1}},dataLabels:{enabled:!1},fill:{type:"gradient"},title:{text:"3D Bubble Chart",style:{fontWeight:500}},xaxis:{tickAmount:12,type:"datetime",labels:{rotate:0}},yaxis:{max:70},theme:{palette:"palette2"},colors:a};new ApexCharts(document.querySelector("#bubble_chart"),n).render()})();