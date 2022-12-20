"use strict";

var closeAlert = function($elem) {

	var delay = 5000;

	if ($elem.hasClass('alert-danger') || $elem.hasClass('alert-warning')) {
		delay = 8000;
	}

	setTimeout(function() {

	 	$elem.removeClass('fadeInDown').addClass('fadeOutUp');

	 	setTimeout(function() {
			$elem.remove();
	 	}, 500);

	}, delay);
}

var $alert;

(function() {

	$('.alert:not(.sticky)').each(function() {
		closeAlert($(this));
    });

    $("body").on("click", ".alert .btn-close", function() {
        $(this).closest(".alert").remove();
    });

	var toggle = function(type, message, $container, blockScroll) {

		var $container = $container || $('.alert-container').first();

		if ($container.length > 0) {

			var $elem = $(
			`<div class="alert alert-${ type } animated fadeInDown">
				<div class="texts"></div>
				<button type="button" class="btn-close">
					<i class="fas fa-times"></i>
				</button>
			</div>`);

			if (isHTML(message)) {
				$elem.find(".texts").append(message);

			} else {
				$elem.find(".texts").append(`<p>${ message }</p>`);
			}

			closeAlert($elem);

			if (!blockScroll) {
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
			$container.html($elem);
		}
	}

	$alert = {

		success: function(message, $container, blockScroll = false) {
			toggle('success', message, $container, blockScroll);
		},

		info: function(message, $container, blockScroll = false) {
			toggle('info', message, $container, blockScroll);
		},

		error: function(message, $container, blockScroll = false) {
			toggle('danger', message, $container, blockScroll);
		},

		warning: function(message, $container, blockScroll = false) {
			toggle('warning', message, $container, blockScroll);
		},

		toggle: function(type, message, $container, blockScroll = false) {
			toggle(type, message, $container, blockScroll);
		}
	};

})();

$.fn.alert = function(type, message, blockScroll = false) {
	if (type == "error") type = "danger";
	$alert.toggle(type, message, $(this), blockScroll);
}
