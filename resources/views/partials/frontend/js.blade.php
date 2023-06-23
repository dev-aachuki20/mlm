<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script type="text/javascript">
    // counter
    var counted = 0;
      $(window).scroll(function() {
  
        var oTop = $('#counter').offset().top - window.innerHeight;
        if (counted == 0 && $(window).scrollTop() > oTop) {
          $('.count').each(function() {
            var $this = $(this),
              countTo = $this.attr('data-count');
            $({
              countNum: $this.text()
            }).animate({
                countNum: countTo
              },
  
              {
  
                duration: 2000,
                easing: 'swing',
                step: function() {
                  $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                  $this.text(this.countNum);
                  //alert('finished');
                }
  
              });
          });
          counted = 1;
        }
  
      });
      // banner slider
    $(function(){
      var owl = $('#banner-slider');
      owl.owlCarousel({
        autoplay: 3000,
        items:1,
        loop: true,
        nav: true,
        dots:false,
          navText: [
            'Previous',
            'Next'
          ],
          navContainer: '.home-banner-outer .custom-nav',
        onInitialized  : counter, //When the plugin has initialized.
        onTranslated : counter //When the translation of the stage has finished.
      });
  
      function counter(event) {
        var element   = event.target;   
        var items     = event.item.count;   
        var item      = event.item.index + 1; 
        
        // it loop is true then reset counter from 1
        if(item > items) {
          item = item - items
        }
        $('#counter').html("0"+item)
      }
    });
  
    // video js
      $(".box-video").click(function(){
        $('video source',this)[0].src;
        $(this).addClass('open');
      });
      // team slider
        $('#team-slider').owlCarousel({
          loop: false,
          margin: 30,
          dots: false,
          nav: true,
          items: 2,
          navText: [
            'Previous',
            'Next'
          ],
          navContainer: '.our-team-slider .custom-nav',responsive: {
            0: {
              items: 1
            },
            480: {
              items: 1
            },
            768: {
              items: 2
            }
          },
          responsiveRefreshRate: 200,
          responsiveBaseElement: window,
        })
        // team slider
        $('#testimonial-slider').owlCarousel({
          autoplay: 1500,
          loop: true,
          margin: 0,
          center: true,
          dots: false,
          nav: true,
          items: 3,
          navText: [
            'Previous',
            'Next'
          ],
          navContainer: '.testimonial-slider-outer .custom-nav',
          responsive: {
            0: {
              items: 1
            },
            480: {
              items: 1
            },
            768: {
              items: 2
            },
            992: {
              items: 3
            }
          },
          responsiveRefreshRate: 200,
          responsiveBaseElement: window,
        })
      
</script>