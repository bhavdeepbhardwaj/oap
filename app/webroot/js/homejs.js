$(function () {
  // Burst Cache
  function burstCache() {
    if (!navigator.onLine) {
      document.body.innerHTML = 'Loading...';
      window.location = 'ErrorPage.html';
    }
  }

  // Check if not localhost
  if (window.clientIp !== '::1') {
    burstCache();
  }

  // Login modal
  $(".login-model").click(function () {
    $("#loginModal").modal('show');
    $('#loginModelBody').html('Loading...');
    $.get(window.webroot + 'users/login', function (response) {
      $('#loginModelBody').html(response);
    });
  });

  // Trigger login modal if session flag is set
  if (window.shouldOpenLogin) {
    $(".login-model").trigger('click');
  }

  // Forgot password modal
  $(".forgot-password-model").click(function () {
    $("#forgotPasswordModal").modal('show');
    $('#forgotPasswordModelBody').html('Loading...');
    $.get(window.webroot + 'users/forgot_password', function (response) {
      $('#forgotPasswordModelBody').html(response);
    });
  });

  // Adjust footer position
  var docHeight = $(window).height();
  var footerHeight = $('#footer').height();
  var footerTop = $('#footer').position().top + footerHeight;
  if (footerTop < docHeight) {
    $('#footer').css('margin-top', -6 + (docHeight - footerTop) + 'px');
  }

  // Popup logic
  var overlay = $('<div id="overlay"></div>');
  overlay.show();
  overlay.appendTo(document.body);
  $('.popup').show();

  $('.close, .x').click(function () {
    $('.popup').hide();
    overlay.remove();
    return false;
  });

  window.close1 = function () {
    $('.popup').hide();
    $('#overlay').remove();
    return false;
  };
});
