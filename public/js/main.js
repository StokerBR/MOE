$(function() {
    
    //sidebar (mobile) da navbar
    var elems = document.querySelectorAll('.sidenav');
    M.Sidenav.init(elems, {edge: 'right'});

    //dropdown navbar
    $(".dropdown-trigger").dropdown({
        coverTrigger: false,
        // hover: true,
    });

    $('select').formSelect();

    //alert
    $('.materialert').each(function() {

        let $alert = $(this);

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

    });

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

});