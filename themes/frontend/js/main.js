jQuery(document).ready(function(e){e(".selectpicker").selectpicker({style:"btn-select",size:4})}),$("#carousel-slider").carousel(),$('a[data-slide="prev"]').click(function(){$("#carousel-slider").carousel("prev")}),$('a[data-slide="next"]').click(function(){$("#carousel-slider").carousel("next")}),jQuery(document).ready(function(e){e(".counter").counterUp({delay:1,time:800})});var wow=new WOW({mobile:!1});wow.init(),$(window).load(function(){"use strict";$("#loader").fadeOut()}),$(document).ready(function(){jQuery(".tp-banner").show().revolution({dottedOverlay:"none",delay:9e3,startwidth:1170,startheight:540,hideThumbs:200,thumbWidth:100,thumbHeight:50,thumbAmount:5,navigationType:"bullet",navigationArrows:"solo",navigationStyle:"preview3",touchenabled:"on",onHoverStop:"on",swipe_velocity:.7,swipe_min_touches:1,swipe_max_touches:1,drag_block_vertical:!1,parallax:"mouse",parallaxBgFreeze:"on",parallaxLevels:[7,4,3,2,5,4,3,2,1,0],keyboardNavigation:"off",navigationHAlign:"center",navigationVAlign:"bottom",navigationHOffset:0,navigationVOffset:20,soloArrowLeftHalign:"left",soloArrowLeftValign:"center",soloArrowLeftHOffset:20,soloArrowLeftVOffset:0,soloArrowRightHalign:"right",soloArrowRightValign:"center",soloArrowRightHOffset:20,soloArrowRightVOffset:0,shadow:0,fullWidth:"on",fullScreen:"off",spinner:"spinner1",stopLoop:"off",stopAfterLoops:-1,stopAtSlide:-1,shuffle:"off",autoHeight:"off",forceFullWidth:"off",hideThumbsOnMobile:"off",hideNavDelayOnMobile:1500,hideBulletsOnMobile:"off",hideArrowsOnMobile:"off",hideThumbsUnderResolution:0,hideSliderAtLimit:0,hideCaptionAtLimit:0,hideAllCaptionAtLilmit:0,startWithSlide:0,fullScreenOffsetContainer:""})}),$("#new-products").owlCarousel({navigation:!0,pagination:!0,slideSpeed:1e3,stopOnHover:!0,autoPlay:!0,items:5,itemsDesktopSmall:[1024,3],itemsTablet:[600,1],itemsMobile:[479,1]}),$(".touch-slider").owlCarousel({navigation:!1,pagination:!0,slideSpeed:1e3,stopOnHover:!0,autoPlay:!0,items:1,itemsDesktopSmall:[1024,1],itemsTablet:[600,1],itemsMobile:[479,1]}),$(".touch-slider").find(".owl-prev").html('<i class="fa fa-angle-left"></i>'),$(".touch-slider").find(".owl-next").html('<i class="fa fa-angle-right"></i>'),$("#new-products").find(".owl-prev").html('<i class="fa fa-angle-left"></i>'),$("#new-products").find(".owl-next").html('<i class="fa fa-angle-right"></i>');var owl;$(document).ready(function(){function e(){$(".owl-controls .owl-page").append('<a class="item-link" />');var e=$(".owl-controls .item-link");$.each(this.owl.userItems,function(t){$(e[t]).css({background:"url("+$(this).find("img").attr("src")+") center center no-repeat","-webkit-background-size":"cover","-moz-background-size":"cover","-o-background-size":"cover","background-size":"cover"}).click(function(){owl.trigger("owl.goTo",t)})}),$(".owl-pagination").prepend('<a href="#prev" class="prev-owl"/>'),$(".owl-pagination").append('<a href="#next" class="next-owl"/>'),$(".next-owl").click(function(){owl.trigger("owl.next")}),$(".prev-owl").click(function(){owl.trigger("owl.prev")})}owl=$("#owl-demo"),owl.owlCarousel({navigation:!1,slideSpeed:300,paginationSpeed:400,singleItem:!0,afterInit:e,afterUpdate:e})});var offset=200,duration=500;$(window).scroll(function(){$(this).scrollTop()>offset?$(".back-to-top").fadeIn(400):$(".back-to-top").fadeOut(400)}),$(".back-to-top").click(function(e){return e.preventDefault(),$("html, body").animate({scrollTop:0},600),!1}),$(".list,switchToGrid").click(function(e){e.preventDefault(),$(".grid").removeClass("active"),$(".list").addClass("active"),$(".item-list").addClass("make-list"),$(".item-list").removeClass("make-grid"),$(".item-list").removeClass("make-compact"),$(".item-list .add-desc-box").removeClass("col-sm-9"),$(".item-list .add-desc-box").addClass("col-sm-7")}),$(".grid").click(function(e){e.preventDefault(),$(".list").removeClass("active"),$(this).addClass("active"),$(".item-list").addClass("make-grid"),$(".item-list").removeClass("make-list"),$(".item-list").removeClass("make-compact"),$(".item-list .add-desc-box").removeClass("col-sm-9"),$(".item-list .add-desc-box").addClass("col-sm-7")});