$(document).ready(function() {
  $('.collapsible').collapsible();
  $('.scrollspy').scrollSpy({
    scrollOffset: '80'
  });
  $('.materialboxed').materialbox();


  const mediaQuery = window.matchMedia("(max-width: 992px)"); // Mobile breakpoint
  mediaQuery.addListener(handleDeviceChange);
  handleDeviceChange(mediaQuery);

  function handleDeviceChange(e) { // Listen for media query change

    // desktop navbar animation
    if (e.matches) { //--on mobile
      $('.navbar-fixed').removeClass('is-top');
    } else { //--on desktop
      $('.navbar-fixed').scrollMenu();
    }

    // Sliders - load only on mobile
    if (e.matches) { //--on mobile
      $('.review-slider').slick({
        dots: true,
        infinite: false,
        arrows: false,
        adaptiveHeight: true,
        speed: 300,
        fade: false,
        slidesToShow: 1,

        responsive: [{
            breakpoint: 5000,
            settings: "unslick"
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });


      $('.benefits-slider').slick({
        dots: false,
        infinite: false,
        arrows: true,
        appendArrows: '.benefits-slider .slick-slide',
        adaptiveHeight: true,
        speed: 300,
        fade: false,
        slidesToShow: 1,

        responsive: [{
            breakpoint: 5000,
            settings: "unslick"
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
      $('.benefits-slider .slick-prev').on('click', function() {
        $('.benefits-slider').slick("slickPrev");
      });
      $('.benefits-slider .slick-next').on('click', function() {
        $('.benefits-slider').slick("slickNext");
      });

    }

  }


  // Disable right click
  //$(document).bind("contextmenu", function(e) {
    //return false;
  //});




  // Add smooth scrolling to HOME
$(".scroll-to-home").on('click', function(event) {
  event.preventDefault();
  $('html, body').animate({
    scrollTop: $('#home').offset().top - 60
  }, 700);

});

  // Add smooth scrolling to form
  if (mediaQuery.matches) {
    $(".scroll-to-form").on('click', function(event) {
      event.preventDefault();
      $('html, body').animate({
        scrollTop: $('#buy').offset().top - 60
      }, 700);

    });

  } else {
    $(".scroll-to-form").on('click', function(event) {
      event.preventDefault();
      $('html, body').animate({
        scrollTop: $('#buy').offset().top - 130
      }, 700);

    });
  }


});

// Open mobile menu
$("#moblenav-trigger-btn").click(function() {
  $("#moblenav-trigger").click();
});

$("nav .collapsible-body").click(function() {
  $("#moblenav-trigger").click();
});

// popup window
function popup(url) {
  var width = 600;
  var height = 600;
  var left = (screen.width - width) / 2;
  var top = (screen.height - height) / 2;
  var params = 'width=' + width + ', height=' + height;
  params += ', top=' + top + ', left=' + left;
  params += ', directories=no';
  params += ', location=no';
  params += ', menubar=no';
  params += ', resizable=no';
  params += ', scrollbars=no';
  params += ', status=no';
  params += ', toolbar=no';
  newwin = window.open(url, 'windowname5', params);
  if (window.focus) {
    newwin.focus()
  }
  return false;
};

// countdown
function startTimer(duration) {
  var timer = duration,minutes, seconds;
  setInterval(function() {
    minutes = parseInt(timer / 60, 10)
    seconds = parseInt(timer % 60, 10);
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    $(".chours").html("00");
    $(".cminutes").html(minutes);
    $(".cseconds").html(seconds);
    if (--timer < 0) {
      timer = duration;
    }
  }, 1000);
}
var mins = 60 * 10;
startTimer(mins);
