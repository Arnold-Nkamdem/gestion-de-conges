function onload(e){var t=function(e){return{then:function(e){setTimeout((function(){e(5*Math.random())}),1e3)}}},n=(raterJs({starSize:32,element:document.querySelector("#rater"),rateCallback:function(e,t){this.setRating(e),t()}}),raterJs({starSize:32,step:.5,element:document.querySelector("#rater-step"),rateCallback:function(e,t){this.setRating(e),t()}}),raterJs({isBusyText:"Rating in progress. Please wait...",element:document.querySelector("#rater4"),rateCallback:function(e,r){n.setRating(e),t().then((function(e){n.setRating(e),r()}))}})),r=raterJs({max:5,rating:4,element:document.querySelector("#rater2"),disableText:"Custom disable text!",ratingText:"My custom rating text {rating}",showToolTip:!0,rateCallback:function(e,t){r.setRating(e),r.disable(),t()}}),a=(raterJs({max:16,readOnly:!0,rating:4.4,element:document.querySelector("#rater3")}),raterJs({max:6,reverse:!0,element:document.querySelector("#rater7"),rateCallback:function(e,t){this.setRating(e),t()}}),raterJs({element:document.querySelector("#rater5"),rateCallback:function(e,t){this.setRating(e),t()},onHover:function(e,t){document.querySelector(".live-rating").textContent=e},onLeave:function(e,t){document.querySelector(".live-rating").textContent=t}}),raterJs({element:document.querySelector("#rater6"),rateCallback:function(e,t){this.setRating(e),t()}}));document.querySelector("#rater6-button").addEventListener("click",(function(){a.clear(),console.log(a.getRating())}),!1)}window.addEventListener("load",onload,!1);