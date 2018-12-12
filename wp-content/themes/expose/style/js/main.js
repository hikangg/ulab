/*-----------------------------------------------------------------------------------*/
/*	CUSTOM FUNCTIONS
/*-----------------------------------------------------------------------------------*/ 
function parallaxInit() {
	jQuery('.parallax, .parallax-layer').each(function() {
			jQuery(this).parallax("30%", 0.1);
	});
}
jQuery.fn.setAllToMaxHeight = function(){
	return this.css({ 'height' : '' }).height( Math.max.apply(this, jQuery.map( this , function(e){ return jQuery(e).height() }) ) );
}	
function exposeSetHeights(){
	//Detecting viewpot dimension
	var vH = jQuery(window).height();
	var vW = jQuery(window).width();
	
	//Adjusting Intro Components Spacing based on detected screen resolution
	jQuery('.fullwidth').css('width',vW);
	jQuery('.halfwidth').css('width',vW/2);
	jQuery('.fullheight').css('height',vH);
	jQuery('.halfheight').css('height',vH/2);
}
/*-----------------------------------------------------------------------------------*/
/*	WORDPRESS STUFF
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function($) {
"use strict";
	
	/**
	 * Comment form Fixes
	 */
	$('#respond #author').attr('placeholder', $('#respond #author').prev().text() );
	$('#respond #email').attr('placeholder', $('#respond #email').prev().text() );
	$('#respond #url').attr('placeholder', $('#respond #url').prev().text() );
	$('#respond #comment').attr('placeholder', $('#respond #comment').prev().text() );
	
});
/*-----------------------------------------------------------------------------------*/
/*	BASIC STUFF
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";
     
    exposeSetHeights();
    jQuery(window).resize(function(){
    	exposeSetHeights();
    });
  
    //Mobile Menu (multi level)
    jQuery('ul.slimmenu').slimmenu({
        resizeWidth: '1200',
        collapserTitle: 'menu',
        easingEffect:'easeInOutQuint',
        animSpeed:'medium',
    });

});
/*-----------------------------------------------------------------------------------*/
/*	MENU CLICK INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";
     
    jQuery('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
    	jQuery(this).toggleClass('open');
    });

});
/*-----------------------------------------------------------------------------------*/
/*	NAVMENU INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";
     
	// Mobile Navigation
	jQuery('.mobile-toggle').click(function() {
		if (jQuery('.main-nav').hasClass('open-nav')) {
			jQuery('.main-nav').removeClass('open-nav');
			jQuery('.masthead').removeClass('revealed');
			jQuery('.slogan-holder').slideUp(1000,function(){
				jQuery('.menu-panel').stop().animate({
					right: "3000px"
				}, 2000);
			});
		} else {
			jQuery('.main-nav').addClass('open-nav');
			jQuery('.masthead').addClass('revealed');
			jQuery('.menu-panel').stop().animate({
				right: "0px"
			}, 1000, function(){
				jQuery('.slogan-holder').slideDown(1000);
			});
		}
	});
	
	jQuery('.mastwrap').click(function(){
		jQuery('.main-nav').removeClass('open-nav');
		jQuery('.masthead').removeClass('revealed');
	});
	
	//Navigation Sub Menu Triggering
	jQuery('.main-nav-menu > li > a[href="#"]').click(function(){
		jQuery('.main-nav-menu > li > ul').slideUp('fast');
		jQuery(this).parent().find('ul').slideDown('slow');
		return false;
	});

});
/*-----------------------------------------------------------------------------------*/
/*	BG SLIDER INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

	if( false ){
		jQuery.mbBgndGallery.buildGallery({
		    containment:".mastwrap",
		    timer:1000,
		    effTimer:15000,
		    controls:false, //updated in v1.1
		    grayScale:false,
		    shuffle:true,
		    preserveWidth:false,
		    preserveTop: true,
		    effect:"zoom",
		
		     images:[
		     "images/bg/06.jpg",
		     "images/bg/03.jpg",
		     ],
		
		    onStart:function(){},
		    onPause:function(){},
		    onPlay:function(opt){},
		    onChange:function(opt,idx){},
		    onNext:function(opt){},
		    onPrev:function(opt){}
		});
	}

});
/*-----------------------------------------------------------------------------------*/
/*	BXSLIDER INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";
	
	jQuery('.bxslider').bxSlider({
		pagerCustom: '#bx-pager',
		controls: false,
	});
	
	jQuery('.agency-slider-triggers a').click(function(){
		jQuery('.agency-slider-triggers a').removeClass('agency-triggered');
		jQuery(this).addClass('agency-triggered');
	});
		
});
/*-----------------------------------------------------------------------------------*/
/*	CAROUSEL INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(window).load(function() {
"use strict";
	
	jQuery('.services-carousel').owlCarousel({
	    stagePadding: false,
	    loop:true,
	    margin:10,
	    nav:false,
	    dots:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:5
	        },
	        1000:{
	            items:5
	        }
	    }
	});
	
	jQuery('.post-slider').owlCarousel({
	    loop:true,
	    nav:false,
	    dots:true,
	    autoHeight: true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	});
		
});
/*-----------------------------------------------------------------------------------*/
/*	EQUAL HEIGHTS INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(window).load(function(){

	if (jQuery(window).width() > 990) { 
		//EqualHeights triggering via JS for viewports > 990px
	    jQuery('.equal-height').setAllToMaxHeight();
	    jQuery('.news-item').setAllToMaxHeight();
		jQuery('.contact-dual-panel').setAllToMaxHeight();
	    jQuery('.agency-tile').setAllToMaxHeight();

	} else {
			//If EqualHeights are not being triggered, then Height is not fixed value. So we are removing '.valign' (vertical align) on all COL-* Elements (Bootstrap Columns) when viewed on viewports width < 990px
		jQuery('.equal-height').find('.valign').removeClass('valign');
		jQuery('.news-item').find('.valign').removeClass('valign');
		jQuery('.contact-dual-panel').find('.valign').removeClass('valign');
	    jQuery('.agency-tile').find('.valign').removeClass('valign');
	}

});

jQuery( window ).resize(function() {

	if (jQuery(window).width() > 990) { 
		//EqualHeights triggering via JS for viewports > 990px
	    jQuery('.equal-height').setAllToMaxHeight();
	    jQuery('.news-item').setAllToMaxHeight();
		jQuery('.contact-dual-panel').setAllToMaxHeight();
	    jQuery('.agency-tile').setAllToMaxHeight();

	} else {
			//If EqualHeights are not being triggered, then Height is not fixed value. So we are removing '.valign' (vertical align) on all COL-* Elements (Bootstrap Columns) when viewed on viewports width < 990px
		jQuery('.equal-height').find('.valign').removeClass('valign');
		jQuery('.news-item').find('.valign').removeClass('valign');
		jQuery('.contact-dual-panel').find('.valign').removeClass('valign');
	    jQuery('.agency-tile').find('.valign').removeClass('valign');
	}

});
/*-----------------------------------------------------------------------------------*/
/*	PARALLAX INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

	if( !device.tablet() && !device.mobile() ) {
		jQuery(window).bind('load', function () {
			parallaxInit();						  
		});
	} else  {
		jQuery('.parallax, .parallax-layer').addClass('no-parallax');	
	}
		
});
/*-----------------------------------------------------------------------------------*/
/*	SHOWCASE INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

	jQuery('.showcase-carousel.standard-showcase').owlCarousel({
	    stagePadding: 0,
	    loop:true,
	    margin:0,
	    nav:false,
	    dots:false,
	    mouseDrag:true,
	    touchDrag:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        1000:{
	            items:2
	        }
	    }
	});
	
	if( jQuery('.showcase-carousel.alt-showcase').length ){
		var vW = jQuery(window).width();
		jQuery('.showcase-carousel.alt-showcase').owlCarousel({
		    stagePadding: vW/4,
		    loop:true,
		    margin:0,
		    nav:false,
		    dots:false,
		    mouseDrag:true,
		    touchDrag:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:1
		        },
		        1000:{
		            items:1
		        }
		    }
		});
	
		jQuery( window ).resize(function() {
		 	var vrW = jQuery(window).width();
			jQuery('.showcase-carousel.alt-showcase').owlCarousel({
			    stagePadding: vrW/4,
			    loop:true,
			    margin:0,
			    nav:false,
			    dots:false,
			    mouseDrag:true,
			    touchDrag:true,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:1
			        },
			        1000:{
			            items:1
			        }
			    }
			});
		});
	}
		
});
/*-----------------------------------------------------------------------------------*/
/*	INTRO 09 INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

	var vW = jQuery(window).width();
	jQuery('.intro09-carousel').owlCarousel({
	    stagePadding: 0,
	    loop:true,
	    margin:0,
	    nav:false,
	    dots:true,
	    mouseDrag:true,
	    touchDrag:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	});

	jQuery( window ).resize(function() {
	 	var vrW = jQuery(window).width();
		jQuery('.intro09-carousel').owlCarousel({
		    stagePadding: 0,
		    loop:true,
		    margin:0,
		    nav:false,
		    dots:true,
		    mouseDrag:true,
		    touchDrag:true,
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:1
		        },
		        1000:{
		            items:1
		        }
		    }
		});
	});
		
});
/*-----------------------------------------------------------------------------------*/
/*	ISOTOPE INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

	jQuery(window).load(function(){
	        
        var $container = jQuery('.works-container');
        $container.isotope({
          itemSelector: '.works-item',
          layoutMode: 'masonry',
          transitionDuration:'0.8s'
        });

        jQuery('.works-filter li a').click(function(){
        jQuery('.works-filter li a').removeClass('active');
        jQuery(this).addClass('active');

        var selector = jQuery(this).attr('data-filter');
              jQuery('.works-container').isotope({ filter: selector });
              return false;
        });

        jQuery(window).resize(function() {
             $container.isotope({
              itemSelector: '.works-item',
              layoutMode: 'masonry',
              transitionDuration:'0.8s'
            });
        });

    });
    
	
	if(jQuery('#grid').length > 0){
		new GridScrollFx( 
			document.getElementById( 'grid' ), {
				viewportFactor : 0.4
			} 
		);
	}		

});
/*-----------------------------------------------------------------------------------*/
/*	VENOBOX INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

	jQuery('.venobox, .image-lightbox-link').venobox({
		numeratio: true
	}); 
	
});
/*-----------------------------------------------------------------------------------*/
/*	SMOOTH SCROLL
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function($) {
"use strict";

    jQuery(".scroll").click(function(event){
        event.preventDefault();
        jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top-0}, 1000, 'easeInSine');
    });
});   
/*-----------------------------------------------------------------------------------*/
/*	CANVAS INIT
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function() {
"use strict";

if( jQuery('#large-header').length > 0 ){
	
	(function() {
	
	    var width, height, largeHeader, canvas, ctx, points, target, animateHeader = true;
	
	    // Main
	    initHeader();
	    initAnimation();
	    addListeners();
	
	    function initHeader() {
	        width = window.innerWidth;
	        height = window.innerHeight;
	        target = {x: width/2, y: height/2};
	
	        largeHeader = document.getElementById('large-header');
	        largeHeader.style.height = height+'px';
	
	        canvas = document.getElementById('demo-canvas');
	        canvas.width = width;
	        canvas.height = height;
	        ctx = canvas.getContext('2d');
	
	        // create points
	        points = [];
	        for(var x = 0; x < width; x = x + width/20) {
	            for(var y = 0; y < height; y = y + height/20) {
	                var px = x + Math.random()*width/20;
	                var py = y + Math.random()*height/20;
	                var p = {x: px, originX: px, y: py, originY: py };
	                points.push(p);
	            }
	        }
	
	        // for each point find the 5 closest points
	        for(var i = 0; i < points.length; i++) {
	            var closest = [];
	            var p1 = points[i];
	            for(var j = 0; j < points.length; j++) {
	                var p2 = points[j]
	                if(!(p1 == p2)) {
	                    var placed = false;
	                    for(var k = 0; k < 5; k++) {
	                        if(!placed) {
	                            if(closest[k] == undefined) {
	                                closest[k] = p2;
	                                placed = true;
	                            }
	                        }
	                    }
	
	                    for(var k = 0; k < 5; k++) {
	                        if(!placed) {
	                            if(getDistance(p1, p2) < getDistance(p1, closest[k])) {
	                                closest[k] = p2;
	                                placed = true;
	                            }
	                        }
	                    }
	                }
	            }
	            p1.closest = closest;
	        }
	
	        // assign a circle to each point
	        for(var i in points) {
	            var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
	            points[i].circle = c;
	        }
	    }
	
	    // Event handling
	    function addListeners() {
	        if(!('ontouchstart' in window)) {
	            window.addEventListener('mousemove', mouseMove);
	        }
	        window.addEventListener('scroll', scrollCheck);
	        window.addEventListener('resize', resize);
	    }
	
	    function mouseMove(e) {
	        var posx = 0,
	        	posy = 0;
	        if (e.pageX || e.pageY) {
	            posx = e.pageX;
	            posy = e.pageY;
	        }
	        else if (e.clientX || e.clientY)    {
	            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
	            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
	        }
	        target.x = posx;
	        target.y = posy;
	    }
	
	    function scrollCheck() {
	        if(document.body.scrollTop > height) animateHeader = false;
	        else animateHeader = true;
	    }
	
	    function resize() {
	        width = window.innerWidth;
	        height = window.innerHeight;
	        largeHeader.style.height = height+'px';
	        canvas.width = width;
	        canvas.height = height;
	    }
	
	    // animation
	    function initAnimation() {
	        animate();
	        for(var i in points) {
	            shiftPoint(points[i]);
	        }
	    }
	
	    function animate() {
	        if(animateHeader) {
	            ctx.clearRect(0,0,width,height);
	            for(var i in points) {
	                // detect points in range
	                if(Math.abs(getDistance(target, points[i])) < 4000) {
	                    points[i].active = 0.3;
	                    points[i].circle.active = 0.6;
	                } else if(Math.abs(getDistance(target, points[i])) < 20000) {
	                    points[i].active = 0.1;
	                    points[i].circle.active = 0.3;
	                } else if(Math.abs(getDistance(target, points[i])) < 40000) {
	                    points[i].active = 0.02;
	                    points[i].circle.active = 0.1;
	                } else {
	                    points[i].active = 0;
	                    points[i].circle.active = 0;
	                }
	
	                drawLines(points[i]);
	                points[i].circle.draw();
	            }
	        }
	        requestAnimationFrame(animate);
	    }
	
	    function shiftPoint(p) {
	        TweenLite.to(p, 1+1*Math.random(), {x:p.originX-50+Math.random()*100,
	            y: p.originY-50+Math.random()*100, ease:Circ.easeInOut,
	            onComplete: function() {
	                shiftPoint(p);
	            }});
	    }
	
	    // Canvas manipulation
	    function drawLines(p) {
	        if(!p.active) return;
	        for(var i in p.closest) {
	            ctx.beginPath();
	            ctx.moveTo(p.x, p.y);
	            ctx.lineTo(p.closest[i].x, p.closest[i].y);
	            ctx.strokeStyle = 'rgba(' + wp_data.color_interactive +','+ p.active+')';
	            ctx.stroke();
	        }
	    }
	
	    function Circle(pos,rad,color) {
	        var _this = this;
	
	        // constructor
	        (function() {
	            _this.pos = pos || null;
	            _this.radius = rad || null;
	            _this.color = color || null;
	        })();
	
	        this.draw = function() {
	            if(!_this.active) return;
	            ctx.beginPath();
	            ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
	            ctx.fillStyle = 'rgba(' + wp_data.color_interactive +','+ _this.active+')';
	            ctx.fill();
	        };
	    }
	
	    // Util
	    function getDistance(p1, p2) {
	        return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
	    }
	    
	})();
	
}
	
});