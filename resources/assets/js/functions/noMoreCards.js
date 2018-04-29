define(["jquery"], function ($) {
        return function () {
            console.log('no more cards')
            var alertDiv = $('#above-content-alert');
            alertDiv.append('No More Cards!');
            alertDiv.removeClass('hidden');

            setTimeout(function() {
                alertDiv.fadeOut('fast');
            }, 5000);
        }
    }
);
