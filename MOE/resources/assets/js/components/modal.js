"use strict";

/**
 * Criar modal
 */
class CustomModal {

	constructor($body, title, $footer, options) {

		var html = `
		<div class="modal fade content-modal" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn btn-icon btn-close">
							<i class="fas fa-times"></i>
						</button>
					</div>
					<div class="modal-body"></div>
				</div>
			</div>
		</div>`;

		var $html = $(html);

		if (title) {
			$html.find(".modal-header").append(`<h3>${ title }</h3>`);
		}

		if ($footer) {
			$footer.addClass("modal-footer");
			$html.find(".modal-content").append($footer);
		}

		$html.find(".modal-body").append($body);

		var defaultOptions = {};
		options = Object.assign(defaultOptions, options);

		if (options) {

			if (options.className) {
				$html.addClass(options.className);
			}
		}

		$html.on("click", ".btn-close, .btn-close-modal", function() {
			$html.modal("hide");
		});

		this.$modal = $html;
	}

	show() {
		this.$modal.modal("show");
	}

	close() {
		this.$modal.modal("hide");
	}
}
