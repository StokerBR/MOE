'use strict';
var $dialog;

(function() {

	$dialog = {

		confirm: function(message, callback, isDelete = false) {

			var $footer = $(`
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary me-auto btn-close-modal">Cancelar</button>
				<button type="button" class="btn btn-${isDelete ? 'danger' : 'primary'} btn-confirm">Confirmar</button>
			</div>`);

			// Ao clicar no botão "Confirmar" executar callback
			$footer.find(".btn-confirm").one("click", callback);

			var modal = new CustomModal(message, "Atenção!", $footer, {
				className: "confirm-modal"
			});

			modal.show();

			return modal;

			/* return bootbox.dialog({
				title: "Atenção!",
				message: message,
				className: "confirm-modal",
				buttons: {
					cancel: { label: "Cancelar", className: "btn-light btn-md" },
				    confirm: { label: "Ok", className: "btn-primary btn-md", callback: callback }
				}
			}); */
		},

		alert: function(message) {

			return bootbox.alert({
                title: "Atenção!",
                size: 'large',
				message: message
			});
		},
	};

})();
