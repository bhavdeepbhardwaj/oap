// custom-app.js

// Add jQuery Validation custom rules
$(function() {
    $.validator.addMethod("alphabetspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter alphabets and space only.");

    $.validator.addMethod("alphabet", function(value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/.test(value);
    }, "Please enter alphabets only. Space is not allowed.");
});

// Cache burst check for offline fallback
function burstCache() {
    if (!navigator.onLine) {
        document.body.innerHTML = 'Loading...';
        window.location = 'ErrorPage.html';
    }
}

// Idle timeout auto-reload
var idleTime = 0;
$(document).ready(function () {
    if (typeof window.clientIp !== 'undefined' && window.clientIp !== '::1') {
        burstCache();
    }

    setInterval(timerIncrement, 1000); // Every second

    $(this).on('mousemove keypress', function () {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime += 1;
    if (idleTime > 1800) { // 30 minutes
        window.location.reload();
    }
}
