document.onreadystatechange = function() {

  var state = document.readyState
  if (state == 'uninitialized' || state == "loading") {

  } else if (state == 'interactive') {} else if (state == 'complete') {
    document.getElementById('interactive');
    try {
      getServicesData();
    } catch (error) {}
  }
}
$(document).ready(function() {
  window.onscroll = function() {
    stickHeader()
  };

  function stickHeader() {
    if (window.pageYOffset >= 2) {
      $('.header-left').addClass("sticky")
    } else {
      $('.header-left').removeClass("sticky");
    }
  }
  $().UItoTop({
    easingType: 'easeOutQuart'
  });
  $(".scroll").click(function(event) {
    event.preventDefault();
    $('html,body').animate({
      scrollTop: $(this.hash).offset().top
    }, 1000);
  });
  /* init Jarallax */
  $('.jarallax').jarallax({
    speed: 0.5,
    imgWidth: 1366,
    imgHeight: 768
  })
  $("#topMarquee").responsiveSlides({
    auto: true,
    pager: true,
    nav: false,
    speed: 600,
    namespace: "callbacks",
    before: function() {},
    after: function() {}
  });
});

function getServicesData() {
  $.ajax({
    dataType: "json",
    url: "data/services.json?" + new Date().getTime(),
    data: {},
    success: function(res) {
      getServicesContent(res);
    }
  });
}

function getServicesContent(data) {
  var rowId = "row0";
  $('#servicesContents').append('<div class="w3-welcome-grids" id=' + rowId + '></div>');
  for (var i = 0; i < data.length; i++) {
    var service = data[i];
    $('#servicesContents').append('<div class="col-md-3 w3-welcome-grid">' +
      '<div class="w3-welcome-grid-info">' +
      '<a href="#servicesModal" data-toggle="modal" >' +
      '<i class="fa fa-4x ' + service.iconClass + ' wow bounceIn"></i>' +
      '<h4>' + service.title + '</h4>' +
      '<p>' + service.description + '</p>' +
      '</a>' +
      '</div>' +
      '</div>');
    if ((i + 1) % 4 == 0) {
      $('#' + rowId).append('<div class="clearfix"> </div><div class="w3-welcome-grids">');
      rowId = "row" + i;
      $('#servicesContents').append('<div class="w3-welcome-grids" id=' + rowId + '></div>');
    }
  }
}
