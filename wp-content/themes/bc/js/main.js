// Shuffle Array Function
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
$(document).ready(function(){
  // Any <a> tag that has href="#" will just do nothing
  $('a[href="#"]').click(function(e){
    e.preventDefault();
  });

  // Video Background Auto Play Function
  if($(".video-bg").length){
    $(".video-bg")[0].play();
  }

  // Setting Up Match Height Classes
  var matchHeightClasses = 0; // number of different matching height classes
  $(".match-height").matchHeight({ byRow: false });
  for(var i = 1;i <= matchHeightClasses; i++){
    console.log(".match-height-" + i);
    $(".match-height-" + i).matchHeight({ byRow: false });
  }

  // Scripts for our themes tabs
  $(".bc-tabs a").click(function(e){
    e.preventDefault();
    if($(this).hasClass('tab-active')){
      return;
    }else{
      var currentTab = $(".bc-tabs .tab-active");
      var currentPanel = $(".bc-tab-panels .panel-active");
      var newTab = $(this);
      var newPanel = $(".bc-tab-panels").find("[data-tab='" + newTab.data('toggle') + "']");
      currentTab.removeClass('tab-active');
      newTab.addClass('tab-active');
      currentPanel.removeClass('panel-active').fadeOut('fast',function(){
        newPanel.addClass('panel-active').fadeIn('fast');
      });
    }
  });

  // Contact Form Validation
  $(".wpcf7-captchar").addClass("wpcf7-validates-as-required");
  $(".contact-form input:not([type='submit']), .contact-form textarea").blur(function(){
    if($.trim($(this).val()) == '' && $(this).hasClass('wpcf7-validates-as-required')){
      $(this).css({
        'background-color': '#FFF0F0'
      });
    }else{
      $(this).css({
        'background-color' : '#F0FFF0'
      });
    }
  });

  // Slideshow Init
  // See documentation for more options => http://kenwheeler.github.io/slick/
  $('.bc-slideshow').slick({
    dots: true,
    infinite: true,
    cssEase: 'linear',
    slidesToShow: 1,
    arrows: true,
    dots: false
  });

  $(".primary-nav-search-toggle").click(function(){
    $(".primary-nav-search-form").slideToggle();
  })

  // Acoordion Setup
  $(".accordion-header a").click(function(e){
    var parent = $(this).parent().parent();
    var siblings = parent.siblings();
    e.preventDefault();
    if(parent.hasClass('active-accordion')){
      parent.removeClass('active-accordion');
      siblings.find('.accordion-content').slideUp();
      $(this).parent().next().slideToggle();
    }else{
      siblings.removeClass('active-accordion');
      parent.addClass('active-accordion');
      siblings.find('.accordion-content').slideUp();
      $(this).parent().next().slideToggle();
    }
  });

  // Calculating The Height Of Navbar If postiton: fixed
  $(".desktop-nav-wrap").css('height', $(".primary-nav").outerHeight(true));

  // Calculating The Height Of Mobile Navbar If postiton: fixed
  $(".mobile-nav-wrap").css('height', $(".mobile-nav").outerHeight(true));

  // Toggling The Mobile Nav Links When The Toggle Button Is Clicked
  $(".mobile-nav-toggle").click(function(e){
    e.preventDefault();
    $(".mobile-nav-links").slideToggle();
  });

  // Checks if there is a .topbar and then adds postion:fixed after the topbar is out of sight
  if($(".topbar").length){
    var scrollPos = 0;
    $(document).scroll(function(){
      scrollPos = $(this).scrollTop();
      if(scrollPos > $(".topbar").outerHeight(true)){
        $(".primary-nav").addClass('fixed-top');
        if($(".primary-nav").hasClass("navbar-sit-over-banner")){
          $(".primary-nav").css('top', 0);
        }
      }else{
        $(".primary-nav").removeClass('fixed-top');
        if($(".primary-nav").hasClass("navbar-sit-over-banner")){
          $(".primary-nav").css('top', $(".topbar").outerHeight(true) - scrollPos);
        }
      }
      if(scrollPos > $(".desktop-nav-wrap").outerHeight(true)){
        $(".primary-nav-shrink").addClass('shrink-on-scroll');
      }else{
        $(".primary-nav-shrink").removeClass('shrink-on-scroll');
      }
    })
  }else{
    var scrollPos = 0;
    $(document).scroll(function(){
      scrollPos = $(this).scrollTop();
      if(scrollPos > $(".desktop-nav-wrap").outerHeight(true)){
        $(".primary-nav-shrink").addClass('shrink-on-scroll');
      }else{
        $(".primary-nav-shrink").removeClass('shrink-on-scroll');
      }
    })
  }

  // If the navbar has the style change module, add that class after the clear element
  if($('.primary-nav').hasClass('navbar-style-change')){
    var clearElement = $('.primary-nav').data('change');
    if($('.desktop-nav-wrap').length){
      $(document).scroll(function(){
        scrollPos = $(this).scrollTop();
        if(scrollPos > $(clearElement).outerHeight(true)){
          $(".primary-nav").addClass('navbar-style-change-active');
        }else{
          $(".primary-nav").removeClass('navbar-style-change-active');
        }
      })
    }else{
      $(document).scroll(function(){
        scrollPos = $(this).scrollTop();
        if(scrollPos > $(clearElement).outerHeight(true) - ($('.primary-nav').outerHeight(true))){
          $(".primary-nav").addClass('navbar-style-change-active');
        }else{
          $(".primary-nav").removeClass('navbar-style-change-active');
        }
      })
    }
  }

  // Adding a dropdown arrow for child pages
  $('.mobile-nav .menu-item-has-children > a').append('<i class="fa fa-angle-double-down"></i>');

  // Clicking dropdown icon on mobile causes sub menu to appear
  $('.mobile-nav .menu-item-has-children > a i').click(function(e){
    e.preventDefault();
    $(this).parent().siblings('.sub-menu').slideToggle();
  });

  // Affix nav setup and calculations
  $(".affix-page-nav").affix({
    offset: {
      top: $(".affix-page-nav").data('bc-offset'),
      bottom: function () {
        return (this.bottom = $('#footer-top').outerHeight(true))
      }
    }
  });

  // Smooth Scroll Setup
  $(".affix-page-nav a").smoothScroll({
    offset: -(60 + $(".affix-page-nav").outerHeight(true))
  });

  // Reviews List Animation
  $(".review-link-grid .block-grid-item").each(function(index){
    var row = $(this);
    setTimeout(function(){
      row.css({
        opacity: 1,
        transform: 'rotate(0deg)'
      })
    }, index * 300);
  });



  // Block Grid Animations

  /* random pop */
  $(".block-grid-random-pop").waypoint(function(){
    var children = shuffle($(this.element).children('.block-grid-item'));
     $(children).each(function(index) {
       var self = $(this);
       setTimeout(function(){
         self.css({
           'opacity': 1,
           'transform' : 'scale(1)',
           '-webkit-transform' : 'scale(1)',
           '-ms-transform' : 'scale(1)'
         });
       }, index * 150);
     });
     this.destroy();
   }, {offset: '80%', triggerOnce: true});

   /* pop */
   $(".block-grid-pop").waypoint(function(){
     var children = $(this.element).children('.block-grid-item');
      $(children).each(function(index) {
        var self = $(this);
        setTimeout(function(){
          self.css({
            'opacity': 1,
            'transform' : 'scale(1)',
            '-webkit-transform' : 'scale(1)',
            '-ms-transform' : 'scale(1)'
          });
        }, index * 150);
      });
      this.destroy();
    }, {offset: '80%', triggerOnce: true});

    /* all-pop */
    $(".block-grid-all-pop").waypoint(function(){
      var children = $(this.element).children('.block-grid-item');
      $(children).css({
        'opacity': 1,
        'transform' : 'scale(1)',
        '-webkit-transform' : 'scale(1)',
        '-ms-transform' : 'scale(1)'
      });
       this.destroy();
     }, {offset: '80%', triggerOnce: true});

    /* slide */
    $(".block-grid-slide").waypoint(function(){
      var children = $(this.element).children('.block-grid-item');
       $(children).each(function(index) {
         var self = $(this);
         setTimeout(function(){
           self.css({
             'opacity': 1,
             'transform' : 'translateX(0)',
             '-webkit-transform' : 'translateX(0)',
             '-ms-transform' : 'translateX(0)'
           });
         }, index * 300);
       });
       this.destroy();
     }, {offset: '80%', triggerOnce: true});

     /* up-down */
     $(".block-grid-up-down").waypoint(function(){
       var children = $(this.element).children('.block-grid-item');
        $(children).each(function(index) {
          var self = $(this);
          setTimeout(function(){
            self.css({
              'opacity': 1,
              'transform' : 'translateY(0)',
              '-webkit-transform' : 'translateY(0)',
              '-ms-transform' : 'translateY(0)'
            });
          }, index * 200);
        });
        this.destroy();
      }, {offset: '80%', triggerOnce: true});

      /* fade-spin */
      $(".block-grid-fade-spin").waypoint(function(){
        var children = $(this.element).children('.block-grid-item');
         $(children).each(function(index) {
           var self = $(this);
           setTimeout(function(){
             self.css({
               'opacity': 1,
               'transform' : 'rotate(0deg) translateY(0)',
               '-webkit-transform' : 'rotate(0deg) translateY(0)',
               '-ms-transform' : 'rotate(0deg) translateY(0)'
             });
           }, index * 200);
         });
         this.destroy();
       }, {offset: '80%', triggerOnce: true});



  /* changing the `x-brand` image src on resize > 768px */
  // $(window).resize(function(){
  //   if(($(window).width() <= (1199 - 15)) && ($(window).width() >= (992 - 15)) || ($(window).width() <= 526)) {
  //     // mobile logo
  //     $(".nav-logo img").attr('src', '/bc/wp-content/uploads/2016/03/logo-mobile.png');
  //   }else{
  //     // desktop logo
  //     $(".nav-logo img").attr('src', '/bc/wp-content/uploads/2016/03/logo-desktop.png');
  //   }
  // })
});
