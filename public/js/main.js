$(function() {
    
    //sidebar (mobile) da navbar
    var elems = document.querySelectorAll('.sidenav');
    M.Sidenav.init(elems, {edge: 'right'});

    //dropdown navbar
    $(".dropdown-trigger").dropdown({
        coverTrigger: false,
        // hover: true,
    });

    //selects
    $('select').formSelect();

    //alert
    function alert($alert) {
        //mostrar o alerta
        $alert.css({top: '-50px'}).animate({opacity: 1, top: '0px'}, 'fast');

        function closeAlert() {
            $alert.css({ opacity: 0, transition: 'opacity 0.5s' }).slideUp(function() {
                $alert.remove();
            });
        }

        //fechar o alerta automaticamente depois de 10 segundos
        setTimeout(() => {
            closeAlert();
        }, 10000);

        //fechar o alerta ao clicar no botão
        $alert.find('.close-alert').on('click', function() {
            closeAlert();
        });
    }
    $('.materialert').each(function() {
        alert($(this));
    });
    function createAlert(tipo, mensagem) {

        let $alert = null;

        switch (tipo) {
            case 'success':
                $alert = $(`
                    <div class="materialert success">
                        <div class="material-icons">check</div>
                        ${mensagem}
                        <button type="button" class="close-alert">×</button>
                    </div>
                `);
                break;
            
            case 'error':
                $alert = $(`
                    <div class="materialert error">
                        <div class="material-icons">error</div>
                        ${mensagem}
                        <button type="button" class="close-alert">×</button>
                    </div>
                `);
                break;
        }

        if ($alert) {

            $('.alerts').append($alert);
            alert($alert);

        }

    }

    let siteUrl = $('meta[name="site_url"]').attr('content');

    //página de registro de usuário
    $('.page .page-registrar').each(function() {

        let $self = $(this);
        
        //mudar o formulário de acordo com o tipo de conta escolhida
        $self.find('.tipo-conta').on('change', 'input[name="tipo_conta"]:checked', function() {
            
            let $tipoConta = $(this).val();

            let $formEstagiario = $self.find('.estagiario');
            let $formEmpregador = $self.find('.empregador');

            if ($tipoConta == 'estagiario') {

                //esconder empregador e mostrar estagiario
                $formEmpregador.addClass('d-none');
                $formEstagiario.removeClass('d-none');

                //remover required de empregador e adicionar em estagiario
                
                $formEmpregador.find('input').each(function() {
                    $(this).removeAttr('required');
                    $(this).attr('data-parsley-excluded', true);
                });
                $formEmpregador.find('textarea').removeAttr('required');
                $formEmpregador.find('textarea').attr('data-parsley-excluded', true);
                
                $formEstagiario.find('input').each(function() {
                    $(this).attr('required', true);
                    $(this).removeAttr('data-parsley-excluded');
                });
                $formEstagiario.find('textarea').attr('required', true);
                $formEstagiario.find('textarea').removeAttr('data-parsley-excluded');
                $formEstagiario.find('select').attr('required', true);
                $formEstagiario.find('select').removeAttr('data-parsley-excluded');
                
            } else if ($tipoConta == 'empregador') {
                
                //esconder estagiario e mostrar empregador
                $formEstagiario.addClass('d-none');
                $formEmpregador.removeClass('d-none');
                
                //remover required de estagiario e adicionar em empregador
                
                $formEstagiario.find('input').each(function() {
                    $(this).removeAttr('required');
                    $(this).attr('data-parsley-excluded', true);
                });
                $formEstagiario.find('textarea').removeAttr('required');
                $formEstagiario.find('textarea').attr('data-parsley-excluded', true);
                $formEstagiario.find('select').removeAttr('required');
                $formEstagiario.find('select').attr('data-parsley-excluded', true);
                
                $formEmpregador.find('input').each(function() {
                    $(this).attr('required', true);
                    $(this).removeAttr('data-parsley-excluded');
                });
                $formEmpregador.find('textarea').attr('required', true);
                $formEmpregador.find('textarea').removeAttr('data-parsley-excluded');

            }

        });
        $self.find('.tipo-conta input[name="tipo_conta"]:checked').trigger('change');

    });

    //página de visualização de empresas pelo estagiário
    $('.page .page-empresas').each(function() {

        $('.btn-interesse').on('click', function() {

            let $btn = $(this);

            let idEmpresa = $btn.attr('data-id');

            $.ajax({
                url: siteUrl + '/estagiario/interesse/cadastrar',
                method: 'POST',
                data: {id: idEmpresa},
                success: function() {
                    createAlert('success', 'Interesse cadastrado com sucesso');
                    $btn.remove();
                },
                error: function(response) {
                    createAlert('error', 'Não foi possível cadastrar interesse nessa empresa: ' + response.responseText);
                }
            });

        });

    });

    //página de visualização de empresas de interesse pelo estagiário
    $('.page .page-empresasInteresse').each(function() {

        $('.btn-interesse').on('click', function() {

            let $btn = $(this);
            let $tBody = $btn.closest('tbody');
            let $trs = $tBody.find('tr');

            let idEmpresa = $btn.attr('data-id');

            $.ajax({
                url: siteUrl + '/estagiario/interesse/descadastrar',
                method: 'POST',
                data: {id: idEmpresa},
                success: function() {

                    createAlert('success', 'Interesse descadastrado com sucesso');

                    if ($trs.length == 1) {
                        $tBody.append(`<tr><td class="center-align" colspan="3">Nenhuma Empresa encontrada</td></tr>`);
                    }

                    $btn.closest('tr').remove();

                },
                error: function(response) {
                    createAlert('error', 'Não foi possível descadastrar interesse nessa empresa: ' + response.responseText);
                }
            });

        });

    });

});