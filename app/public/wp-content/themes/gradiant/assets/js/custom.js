(function($) {
    'use strict';
  $(document).ready(function () {
      // About
      function authorToggleHandler(o) { var t = $(".about-toggle"),e = $(".author-close");$("body").toggleClass("author-popup-active"), $("body").toggleClass("overlay-enabled"), $("body").hasClass("author-popup-active") ? e.focus() : t.focus(), authorPopupAccessibility()
      } function hideAuthorPopup(o) { var t = $(".about-toggle"),e = $(".author-popup");$(o.target).closest(t).length || $(o.target).closest(e).length || $("body").hasClass("author-popup-active") && ($("body").removeClass("author-popup-active"), $("body").removeClass("overlay-enabled"), t.focus(), o.stopPropagation())
      } function authorPopupAccessibility() { var links,i,len,searchItem=document.querySelector('.author-popup'),fieldToggle=document.querySelector('.author-close');let focusableElements='button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';let firstFocusableElement=fieldToggle;let focusableContent=searchItem.querySelectorAll(focusableElements);let lastFocusableElement=focusableContent[focusableContent.length-1];if(!searchItem){return!1}
          links=searchItem.getElementsByTagName('button');for(i=0,len=links.length;i<len;i++){links[i].addEventListener('focus',toggleFocus,!0);links[i].addEventListener('blur',toggleFocus,!0)}
          function toggleFocus(){var self=this;while(-1===self.className.indexOf('author-anim')){if('input'===self.tagName.toLowerCase()){if(-1!==self.className.indexOf('focus')){self.className=self.className.replace('focus','')}else{self.className+=' focus'}}
          self=self.parentElement}} document.addEventListener('keydown',function(e){let isTabPressed=e.key==='Tab'||e.keyCode===9;if(!isTabPressed){return}
          if(e.shiftKey){if(document.activeElement===firstFocusableElement){lastFocusableElement.focus();e.preventDefault()}}else{if(document.activeElement===lastFocusableElement){firstFocusableElement.focus();e.preventDefault()}}})
      } $(document).on("click", ".about-toggle", authorToggleHandler), $(document).on("click", ".author-close", authorToggleHandler), $(document).on("click", hideAuthorPopup);

		// Main Slider
      var owlMainSlider = $('.main-slider');
      owlMainSlider.owlCarousel({
          /*onChanged: function(e) {
            progressSim('.owl-item.active .item>img');
          },*/
          rtl: $("html").attr("dir") == 'rtl' ? true : false,
          items: 1,
          autoplay: true,
          autoplayTimeout: 9000,
          animateOut: false,
          animateIn: false,
          margin: 0,
          loop: false,
		  navRewind: false,
          dots: false,
          nav: true,
          navText: ['<i class="fa fa-chevron-left"></i> <span>SLIDE</span>', '<span>SLIDE</span> <i class="fa fa-chevron-right"></i>'],
          singleItem: true,
          transitionStyle: "fade",
          touchDrag: true,
          mouseDrag: false,
          responsive: {
              0: {
                  nav: false
              },
              768: {
                  nav: true
              },
              992: {
                  nav: true
              }
          }
      });
      owlMainSlider.owlCarousel();
      owlMainSlider.on('translate.owl.carousel', function (event) {
          var data_anim = $("[data-animation]");
          data_anim.each(function() {
              var anim_name = $(this).data('animation');
              $(this).removeClass('animated ' + anim_name).css('opacity', '0');
          });
      });
      $("[data-delay]").each(function() {
          var anim_del = $(this).data('delay');
          $(this).css('animation-delay', anim_del);
      });
      $("[data-duration]").each(function() {
          var anim_dur = $(this).data('duration');
          $(this).css('animation-duration', anim_dur);
      });
      owlMainSlider.on('translated.owl.carousel', function() {
          var data_anim = owlMainSlider.find('.owl-item.active').find("[data-animation]");
          data_anim.each(function() {
              var anim_name = $(this).data('animation');
              $(this).addClass('animated ' + anim_name).css('opacity', '1');
          });
      });
      function owlHomeThumb() {
          $('.owl-item').removeClass('prev next');
          var currentSlide = $('.main-slider .owl-item.active');
          currentSlide.next('.owl-item').addClass('next');
          currentSlide.prev('.owl-item').addClass('prev');
          var nextSlideImg = $('.owl-item.next').find('.item img').attr('data-img-url');
          var prevSlideImg = $('.owl-item.prev').find('.item img').attr('data-img-url');
          $('.owl-nav .owl-prev').css({
              backgroundImage: 'url(' + prevSlideImg + ')'
          });
          $('.owl-nav .owl-next').css({
              backgroundImage: 'url(' + nextSlideImg + ')'
          });
      }
      owlMainSlider.on('translated.owl.carousel', function() {
          owlHomeThumb();
      });
	  
	  
	  // Blog
      $(".post-carousel").owlCarousel({
        rtl: $("html").attr("dir") == 'rtl' ? true : false,
        loop: true,
        dots: false,
        nav: true,
        navText: ['<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>'],
        margin: 30,
        stagePadding: 15,
        autoplay: false,
        autoplayTimeout: 10000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
          0: {
            items: 1
          },
          601: {
            items: 2
          },
          992: {
            items: 3,
          }
        }
      });
	  
	  
      $(".widget_social_widget").find("li a").each(function () {
          $(this).on('mouseenter focus', function () {
              var icon = this.querySelector('i');
              if (icon) {
                  var burst = new mojs.Burst({
                      radius: {15: 45},
                      parent: icon,
                      children: {
                          fill: ['var(--sp-primary)', 'var(--sp-primary2)', 'var(--sp-primary)'],
                      }
                  });
                  var shape = new mojs.Shape({
                      parent: icon,
                      type: 'circle',
                      radius: {0: 30},
                      fill: 'transparent',
                      stroke: 'var(--sp-primary)',
                      strokeWidth: {15: 0},
                      opacity: 0.6,
                      duration: 1000,
                      easing: mojs.easing.sin.out
                  });
                  shape.play();
                  burst.play();
              }
          });
      });
  });
  //ripples
  $('.footer-effect-active, .cta-effect-active, .breadcrumb-effect-active').ripples({
    resolution: 500,
    dropRadius: 20,
    perturbance: 0.04
  });
  //roller
  var t = $(this).dels = [],
    e = {
      attribute: "data-roller",
      classNames: ["roller", "rollerstart", "rollerended"],
      start: .75,
      end: .75,
      autoInit: !0
    };
  function s() {
    document.addEventListener("scroll", a);
    for (var s = document.querySelectorAll("[" + e.attribute + "]"), d = 0; d < s.length; d++) {
      var n = s[d],
        r = n.getAttribute(e.attribute, 2).split(";"),
        i = {};
      i.start = e.start, i.end = e.end;
      for (var l = 0; l < r.length; l++) {
        var o = r[l].split(":"),
          c = o[0],
          u = isNaN(1 * o[1]) ? o[1] : 1 * o[1];
        c && (i[c] = void 0 === u || u)
      }
      i.el = n, i.id = t.length, t.push(i), n.classList.add(e.classNames[0]), i.debug && (n.style.outline = "solid red 4px")
    }
    a()
  }
  function a() {
    for (var s = window.innerHeight, a = 0; a < t.length; a++) {
      var d = t[a],
        n = d.el.getBoundingClientRect(),
        r = n.top / s,
        i = n.bottom / s;
      d.debug && (r >= 0 && r <= 1 && (d.startLine || (d.startLine = document.createElement("div"), document.body.appendChild(d.startLine), d.startLine.style = "position:fixed;height:0;width:100%;border-bottom:dotted red 2px;top:" + 100 * d.start + "vh")), (i < d.end || r > 1) && d.startLine && (d.startLine.parentNode.removeChild(d.startLine), delete d.startLine)), r < d.start && !d.rollerstart ? (d.rollerstart = !0, d.el.classList.add(e.classNames[1])) : r > d.start && d.rollerstart && (d.rollerstart = !1, d.el.classList.remove(e.classNames[1])), i < d.end && !d.rollerended ? (d.rollerended = !0, d.el.classList.add(e.classNames[2])) : i > d.end && d.rollerended && (d.rollerended = !1, d.el.classList.remove(e.classNames[2]))
    }
  }
  document.addEventListener("DOMContentLoaded", function() {
    e.autoInit && s()
  }), $(this).init = s, $(this).config = function(t) {
    for (var s in t) e[s] = t[s]
  }
})(jQuery);



;(function(window) {
    'use strict';
    // Helper vars and functions.
    function extend( a, b ) {
        for( var key in b ) { 
            if( b.hasOwnProperty( key ) ) {
                a[key] = b[key];
            }
        }
        return a;
    }
	
    function getMousePos(e) {
        var posx = 0, posy = 0;
        if (!e) var e = window.event;
        if (e.pageX || e.pageY)     {
            posx = e.pageX;
            posy = e.pageY;
        }
        else if (e.clientX || e.clientY)    {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        return { x : posx, y : posy }
    }
    /**
     * TiltFx obj.
     */
    function TiltFx(el, options) {
        this.DOM = {};
        this.DOM.el = el;
        this.options = extend({}, this.options);
        extend(this.options, options);
        this._init();
    }
    TiltFx.prototype.options = {
        movement: {
            imgWrapper : {
                translation : {x: 0, y: 0, z: 0},
                rotation : {x: -5, y: 5, z: 0},
                reverseAnimation : {
                    duration : 1200,
                    easing : 'easeOutElastic',
                    elasticity : 600
                }
            },
            lines : {
                translation : {x: 10, y: 10, z: [0,10]},
                reverseAnimation : {
                    duration : 1000,
                    easing : 'easeOutExpo',
                    elasticity : 600
                }
            },
            caption : {
                translation : {x: 20, y: 20, z: 0},
                rotation : {x: 0, y: 0, z: 0},
                reverseAnimation : {
                    duration : 1500,
                    easing : 'easeOutElastic',
                    elasticity : 600
                }
            }
        }
    };
    /**
     * Init.
     */
    TiltFx.prototype._init = function() {
        this.DOM.animatable = {};
        this.DOM.animatable.imgWrapper = this.DOM.el.querySelector('.tilter__figure');
        this.DOM.animatable.lines = this.DOM.el.querySelector('.tilter__deco--lines');
        this.DOM.animatable.caption = this.DOM.el.querySelector('.tilter__caption');
        //this.DOM.animatable.overlay = this.DOM.el.querySelector('.tilter__deco--overlay');
        //this.DOM.animatable.shine = this.DOM.el.querySelector('.tilter__deco--shine > div');
        this._initEvents();
    };
    /**
     * Init/Bind events.
     */
    TiltFx.prototype._initEvents = function() {
        var self = this;
		
		this.mouseenterFn = function() {
			for(var key in self.DOM.animatable) {
				anime.remove(self.DOM.animatable[key]);
			}
		};
		
		this.mousemoveFn = function(ev) {
			requestAnimationFrame(function() { self._layout(ev); });
		};
		
		this.mouseleaveFn = function(ev) {
			requestAnimationFrame(function() {
				for(var key in self.DOM.animatable) {
					if( self.options.movement[key] == undefined ) {continue;}
					anime({
						targets: self.DOM.animatable[key],
						duration: self.options.movement[key].reverseAnimation != undefined ? self.options.movement[key].reverseAnimation.duration || 0 : 1,
						easing: self.options.movement[key].reverseAnimation != undefined ? self.options.movement[key].reverseAnimation.easing || 'linear' : 'linear',
						elasticity: self.options.movement[key].reverseAnimation != undefined ? self.options.movement[key].reverseAnimation.elasticity || null : null,
						scaleX: 1,
						scaleY: 1,
						scaleZ: 1,
						translateX: 0,
						translateY: 0,
						translateZ: 0,
						rotateX: 0,
						rotateY: 0,
						rotateZ: 0
					});
				}
			});
		};
		
        this.DOM.el.addEventListener('mousemove', this.mousemoveFn);
        this.DOM.el.addEventListener('mouseleave', this.mouseleaveFn);
        this.DOM.el.addEventListener('mouseenter', this.mouseenterFn);
    };
    TiltFx.prototype._layout = function(ev) {
        // Mouse position relative to the document.
        var mousepos = getMousePos(ev),
            // Document scrolls.
            docScrolls = {left : document.body.scrollLeft + document.documentElement.scrollLeft, top : document.body.scrollTop + document.documentElement.scrollTop},
            bounds = this.DOM.el.getBoundingClientRect(),
            // Mouse position relative to the main element (this.DOM.el).
            relmousepos = { x : mousepos.x - bounds.left - docScrolls.left, y : mousepos.y - bounds.top - docScrolls.top };
        // Movement settings for the animatable elements.
        for(var key in this.DOM.animatable) {
            if( this.DOM.animatable[key] == undefined || this.options.movement[key] == undefined ) {
                continue;
            }
            var t = this.options.movement[key] != undefined ? this.options.movement[key].translation || {x:0,y:0,z:0} : {x:0,y:0,z:0},
                r = this.options.movement[key] != undefined ? this.options.movement[key].rotation || {x:0,y:0,z:0} : {x:0,y:0,z:0},
                setRange = function (obj) {
                    for(var k in obj) {
                        if( obj[k] == undefined ) {
                            obj[k] = [0,0];
                        }
                        else if( typeof obj[k] === 'number' ) {
                            obj[k] = [-1*obj[k],obj[k]];
                        }
                    }
                };
            setRange(t);
            setRange(r);
            
            var transforms = {
                translation : {
                    x: (t.x[1]-t.x[0])/bounds.width*relmousepos.x + t.x[0],
                    y: (t.y[1]-t.y[0])/bounds.height*relmousepos.y + t.y[0],
                    z: (t.z[1]-t.z[0])/bounds.height*relmousepos.y + t.z[0],
                },
                rotation : {
                    x: (r.x[1]-r.x[0])/bounds.height*relmousepos.y + r.x[0],
                    y: (r.y[1]-r.y[0])/bounds.width*relmousepos.x + r.y[0],
                    z: (r.z[1]-r.z[0])/bounds.width*relmousepos.x + r.z[0]
                }
            };
            this.DOM.animatable[key].style.WebkitTransform = this.DOM.animatable[key].style.transform = 'translateX(' + transforms.translation.x + 'px) translateY(' + transforms.translation.y + 'px) translateZ(' + transforms.translation.z + 'px) rotateX(' + transforms.rotation.x + 'deg) rotateY(' + transforms.rotation.y + 'deg) rotateZ(' + transforms.rotation.z + 'deg)';
        }
    };
    window.TiltFx = TiltFx;
})(window);
jQuery(document).ready(function ($) {
    // Perspective Hover Effect
    var perspectiveSettings = [
      {},
      {
        movement: {
          imgWrapper : {
            translation : {x: 10, y: 10, z: 30},
            rotation : {x: 0, y: -10, z: 0},
            reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
          },
          lines : {
            translation : {x: 10, y: 10, z: [0,70]},
            rotation : {x: 0, y: 0, z: -2},
            reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
          },
          caption : {
            rotation : {x: 0, y: 0, z: 2},
            reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
          }
        }
      },
      {
        movement: {
          imgWrapper : {
            rotation : {x: -5, y: 10, z: 0},
            reverseAnimation : {duration : 900, easing : 'easeOutCubic'}
          },
          caption : {
            translation : {x: 30, y: 30, z: [0,40]},
            rotation : {x: [0,15], y: 0, z: 0},
            reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
          }
        }
      },
      {
        movement: {
          imgWrapper : {
            rotation : {x: -5, y: 10, z: 0},
            reverseAnimation : {duration : 50, easing : 'easeOutQuad'}
          },
          caption : {
            translation : {x: 20, y: 20, z: 0},
            reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
          }
        }
      },
      {
        movement: {
          imgWrapper : {
            translation : {x: 0, y: -8, z: 0},
            rotation : {x: 3, y: 3, z: 0},
            reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
          },
          lines : {
            translation : {x: 15, y: 15, z: [0,15]},
            reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
          },
          caption : {
            translation : {x: 10, y: -15, z: 0},
            reverseAnimation : {duration : 900, easing : 'easeOutExpo'}
          }
        }
      },
      {
        movement: {
          lines : {
            translation : {x: -5, y: 5, z: 0},
            reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
          },
          caption : {
            translation : {x: 15, y: 15, z: 0},
            rotation : {x: 0, y: 0, z: 3},
            reverseAnimation : {duration : 1500, easing : 'easeOutElastic', elasticity : 700}
          }
        }
      },
      {
        movement: {
          imgWrapper : {
            translation : {x: 5, y: 5, z: 0},
            reverseAnimation : {duration : 800, easing : 'easeOutQuart'}
          },
          caption : {
            translation : {x: 10, y: 10, z: [0,50]},
            reverseAnimation : {duration : 1000, easing : 'easeOutQuart'}
          }
        }
      },
      {
        movement: {
          lines : {
            translation : {x: 40, y: 40, z: 0},
            reverseAnimation : {duration : 1500, easing : 'easeOutElastic'}
          },
          caption : {
            translation : {x: 20, y: 20, z: 0},
            rotation : {x: 0, y: 0, z: -5},
            reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
          }
        }
    }];
    var idx = 0;
    [].slice.call(document.querySelectorAll('.tilter')).forEach(function(el, pos) { 
      idx = pos%2 === 0 ? idx+1 : idx;
      new TiltFx(el, perspectiveSettings[idx-1]);
    });
});