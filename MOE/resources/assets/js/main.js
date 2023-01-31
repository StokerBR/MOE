$(function() {

	//Dar focus no campo de busca do select2 assim que ele abrir
	$('.select2').on('select2:open', () => {
        setTimeout(() => {
            var $searchBox = document.querySelector('.select2-search.select2-search--dropdown .select2-search__field') ?? null;
            if ($searchBox) {
                $searchBox.focus();
            }
        }, 100);
	});

    var modalDeletedOpened = false;
    // Ao clicar no botão de remover algum registro.
    $('.btn-delete').on('click', function() {

        // Caso não exista modal de exclusão aberto.
        if (modalDeletedOpened == false) {

            var $btnDelete = $(this);
            var url = $btnDelete.attr('data-url');
            var id = $btnDelete.attr('data-id');

            if (url && id) {

                // Bloqueia a abertura do modal.
                modalDeletedOpened = true;

                var $body = $btnDelete.closest('body');
                var question = 'Esta ação irá <b>remover o registro do sistema</b>.<br/>Deseja realmente continuar?';

                var $form = $('<form>', {
                    class: 'hide', action: siteUrl(url), method: 'POST'
                });

                // Adiciona os campos no formulário.
                $form.append($('<input>', { type: 'hidden', name: '_method', value: 'DELETE' }));
                $form.append($('<input>', { type: 'hidden', name: '_token', value: getCsrfToken() }))
                $form.append($('<input>', { type: 'hidden', name: 'id', value: id }));

                var dialog = $dialog.confirm(question, function() {
                    $body.append($form); $form.trigger('submit');
                }, true);

                dialog.$modal.on('hidden.bs.modal', function() {
                    modalDeletedOpened = false;
                });
            }
        }

    });

});
