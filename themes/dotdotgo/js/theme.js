// HoverIntent - Compressed

(function(e){e.fn.hoverIntent=function(f,m){var d={sensitivity:7,interval:100,timeout:0};d=e.extend(d,m?{over:f,out:m}:f);var h,i,j,k,l=function(b){h=b.pageX;i=b.pageY},n=function(b,a){a.hoverIntent_t=clearTimeout(a.hoverIntent_t);if(Math.abs(j-h)+Math.abs(k-i)<d.sensitivity){e(a).unbind("mousemove",l);a.hoverIntent_s=1;return d.over.apply(a,[b])}else{j=h;k=i;a.hoverIntent_t=setTimeout(function(){n(b,a)},d.interval)}},o=function(b,a){a.hoverIntent_t=clearTimeout(a.hoverIntent_t);a.hoverIntent_s=0; return d.out.apply(a,[b])};f=function(b){for(var a=(b.type=="mouseover"?b.fromElement:b.toElement)||b.relatedTarget;a&&a!=this;)try{a=a.parentNode}catch(p){a=this}if(a==this)return false;var g=jQuery.extend({},b),c=this;if(c.hoverIntent_t)c.hoverIntent_t=clearTimeout(c.hoverIntent_t);if(b.type=="mouseover"){j=g.pageX;k=g.pageY;e(c).bind("mousemove",l);if(c.hoverIntent_s!=1)c.hoverIntent_t=setTimeout(function(){n(g,c)},d.interval)}else{e(c).unbind("mousemove",l);if(c.hoverIntent_s==1)c.hoverIntent_t= setTimeout(function(){o(g,c)},d.timeout)}};return this.mouseover(f).mouseout(f)}})(jQuery);

// Superfish - Compressed

(function(a){a.fn.superfish=function(d){var b=a.fn.superfish,h=b.c,n=a(['<span class="',h.arrowClass,'"> &#187;</span>'].join("")),i=function(){var c=a(this),e=j(c);clearTimeout(e.sfTimer);c.showSuperfishUl().siblings().hideSuperfishUl()},k=function(){var c=a(this),e=j(c),g=b.op;clearTimeout(e.sfTimer);e.sfTimer=setTimeout(function(){g.retainPath=a.inArray(c[0],g.$path)>-1;c.hideSuperfishUl();g.$path.length&&c.parents(["li.",g.hoverClass].join("")).length<1&&i.call(g.$path)},g.delay)},j=function(c){c= c.parents(["ul.",h.menuClass,":first"].join(""))[0];b.op=b.o[c.serial];return c},o=function(c){c.addClass(h.anchorClass).append(n.clone())};return this.each(function(){var c=this.serial=b.o.length,e=a.extend({},b.defaults,d);e.$path=a("li."+e.pathClass,this).slice(0,e.pathLevels).each(function(){a(this).addClass([e.hoverClass,h.bcClass].join(" ")).filter("li:has(ul)").removeClass(e.pathClass)});b.o[c]=b.op=e;a("li:has(ul)",this)[a.fn.hoverIntent&&!e.disableHI?"hoverIntent":"hover"](i,k).each(function(){e.autoArrows&& o(a(">a:first-child",this))}).not("."+h.bcClass).hideSuperfishUl();var g=a("a",this);g.each(function(l){var m=g.eq(l).parents("li");g.eq(l).focus(function(){i.call(m)}).blur(function(){k.call(m)})});e.onInit.call(this)}).each(function(){var c=[h.menuClass];b.op.dropShadows&&!(a.browser.msie&&a.browser.version<7)&&c.push(h.shadowClass);a(this).addClass(c.join(" "))})};var f=a.fn.superfish;f.o=[];f.op={};f.IE7fix=function(){var d=f.op;a.browser.msie&&a.browser.version>6&&d.dropShadows&&d.animation.opacity!= undefined&&this.toggleClass(f.c.shadowClass+"-off")};f.c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",arrowClass:"sf-sub-indicator",shadowClass:"sf-shadow"};f.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},speed:"normal",autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};a.fn.extend({hideSuperfishUl:function(){var d=f.op, b=d.retainPath===true?d.$path:"";d.retainPath=false;b=a(["li.",d.hoverClass].join(""),this).add(this).not(b).removeClass(d.hoverClass).find(">ul").hide().css("visibility","hidden");d.onHide.call(b);return this},showSuperfishUl:function(){var d=f.op,b=this.addClass(d.hoverClass).find(">ul:hidden").css("visibility","visible");f.IE7fix.call(b);d.onBeforeShow.call(b);b.animate(d.animation,d.speed,function(){f.IE7fix.call(b);d.onShow.call(b)});return this}})})(jQuery);

// Cufon Cufon.replace('h1,h2,h3,h4,h5,h6,.title', {hover:true});

// Cufon for IE flicker Cufon.now();

// initialise plugins
jQuery(function(){ jQuery('.nav ul').superfish({ delay: 400, animation: {opacity:'show',height:'show'}, speed: 'fast' }); });

// Fade image for prettyPhoto
jQuery(document).ready(function(){
	jQuery(".zoom img").fadeTo("fast", 1);
	jQuery(".zoom img").hover(function(){
		jQuery(this).stop().fadeTo("medium", 0.65);
			},function(){
		jQuery(this).stop().fadeTo("medium", 1);
	});
});

// Home Title Slide Up
jQuery(document).ready(function(){
	//Full Caption Sliding (Hidden to Visible)
	jQuery('.scroll-title').hover(function(){
		jQuery("h2", this).stop().animate({top:'140px'},{queue:false,duration:300});
		}, function() {
		jQuery("h2", this).stop().animate({top:'212px'},{queue:false,duration:300});
	});
});

// jQuery Tabs
jQuery(function() { jQuery("ul.tabs").tabs(".pane"); });

// jQuery Accordion for App Page
jQuery(function() { jQuery(".app-container").tabs(".app-content", {tabs: 'h3'}); });

// jQuery Accordion for Tour Page
jQuery(function() { jQuery(".tour-container").tabs(".tour-content", {tabs: 'h3'}); });

// jQuery for Alternate Page
jQuery(function() { jQuery(".home-container").tabs(".home-content", { tabs: 'h2', effect: 'fade', initialIndex: 0 }); });

// jQuery Scrollable
jQuery(function() { jQuery(".scrollable").scrollable({show: 1}).navigator(); });

// jQuery Scrollable Two
jQuery(function() { jQuery(".scrollable").scrollable({ circular: true }).click(function() { jQuery(this).data("scrollable").next(); }); });

// jQuery Signup
jQuery('#click-signup').click(function() {
  jQuery('#login-box').slideUp( function() { jQuery('#signup-box').animate({ height: 'toggle' }, 250)
  })
});

// jQuery Login
jQuery('#click-login').click(function() {
  jQuery('#signup-box').slideUp( function() { jQuery('#login-box').animate({ height: 'toggle' }, 250)
  })
});

// prettyPhoto
//jQuery(function() { jQuery("a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'}); });

// Home + Nivo
//jQuery(window).load(function() { jQuery('#slider').nivoSlider({effect: 'sliceDown', animSpeed: 1000, directionNav: false, directionNavHide: true, controlNav: true, pauseTime: 5000, captionOpacity: 0.9}); });

// Home Alternate with Nivo
//jQuery(window).load(function() { jQuery('#slider-alt').nivoSlider({effect: 'sliceDown', animSpeed: 1000, directionNav: false, directionNavHide: true, controlNav: false, pauseTime: 5000, captionOpacity: 0.9}); });

// Tooltip
jQuery(".footer-social img[title]").tooltip({ effect: 'fade', fadeOutSpeed: 20, predelay: 0, position: "bottom left", offset: [-38,8] });
