"use strict";

$(function() {

    /**
    *
    * @param $elem ($zipcode)
    * @returns
    */
    function searchZipCode($elem) {

        var zipcode = $elem.val().replace(/\D/g, '');

        if (zipcode != null && zipcode.length == 8) {

            var $form = $elem.closest('form');
            wait();

            $.getJSON("https://viacep.com.br/ws/" + zipcode + "/json/?callback=?", function (dados) {

                // console.log(dados);

                if (!("erro" in dados)) {

                    var $stateSelect = $form.find('select[name="state_id"]');
                    var $citySelect = $form.find('select[name="city_id"]');
                    var $districtSelect = $form.find('select[name="district_id"]');

                    $citySelect.attr('data-name', dados.localidade);
                    $districtSelect.attr('data-name', dados.bairro);

                    $stateSelect.val($stateSelect.find('option[data-abbrev="' + dados.uf + '"]').val());

                    $stateSelect.trigger('change');

                    $form.find("[name=street]").val(dados.logradouro);
                    $form.find("[name=address]").val(dados.logradouro);
                    $form.find("[name=complement]").val(dados.complemento);
                    $form.find("[name=street_number]").focus();

                }

                closeWait();

            }).fail(function () {
                $form.closeWait();
            });
        }
    }

    // Buscar endereço através do CEP
    $('form input.zipcode').on("blur", function () {
        searchZipCode($(this));
    });


	$("body").on("click", ".password-icon i", function() {

		var $icon = $(this);
		var $inputGroup = $icon.parent();
		var $input = $inputGroup.find(".form-control");

		if ($inputGroup.hasClass("password-visible")) {
			$inputGroup.removeClass("password-visible");
			$input.attr("type", "password");

		} else {
			$inputGroup.addClass("password-visible");
			$input.attr("type", "text");
        }

        $input.trigger("focus");

	});

    /** Forms **/

    $('form .select2').each(function() {
        var $select = $(this); loadSelect2($select);
    });

    //carrega as cidades quando um estado for selecionado
    stateSelect($('form .state-select'));

	//on submit wait formulários
	$('form.onsubmit-wait').on('submit', function() {
		$('body').wait();
	});

    /**
     * Submete as informações do formulário em ajax
     */
    $('body').on('submit', 'form[data-ajax]', function(e) {

        e.preventDefault();

        var $form = $(this);

        var config = {
            method: $form.attr('method') || 'get',
            data: $form.serialize(),
            url: $form.attr('action') || window.location.href,
            success: function(response) {
                $form.trigger('submit:success', response);
            },
            error: function(err) {
                $form.trigger('submit:error', err);
            }
        }

        if ($form.attr('enctype') && $form.attr('enctype')=='multipart/form-data') {

            config.processData = false;
            config.contentType = false;

            var formData = new FormData($form[0]);
            config.data = formData;

        } else {
            config.data = $form.serialize();
        }

        wait();

        $.ajax(config).then(function() {
            closeWait();
        }).fail(function() {
            closeWait();
        });

        return false;

    });

});

function stateSelect($elem) {

    $elem.on('change', function() {

        var $state = $(this);
        var stateId = $state.val();
        var $form = $state.closest('form');
        var $city = $form.find('select[name=city_id]');

        if ($city.length && stateId) {

            $('.modal').length > 0 ? $('.modal').wait() : $('body').wait();

            var cityId = $city.attr('data-id');
            var cityName = $city.attr('data-name');

            $city.empty();
            $city.append('<option value="">Selecione</option>');

            var url = siteUrl('estados/' + stateId + '/cidades');

            $.get(url, function(cities) {

                cities.forEach(c => {

                    if (cityName && cityName != '' && cityName != undefined) {

                        cityName = cityName.toLowerCase();
                        $city.append(`<option ${(cityName == c.name.toLowerCase() ? 'selected="selected"' : '')} value="${c.id}">${c.name}</option>`);

                    } else {
                        // console.log(cityId)
                        $city.append(`<option ${(cityId && cityId == c.id ? 'selected="selected"' : '')} value="${c.id}">${c.name}</option>`);
                    }

                });

            }).fail(function(err) {
                console.error(err);

            }).then(function(){
                $city.trigger('change');
                closeWait();
            });

        } else {

            $city.empty();
            $city.append('<option value="">Selecione um estado</option>');

        }

    }).trigger('change');

}

function loadSelect2($select) {

    var placeholder = "Pesquise pelas opções disponíveis";

    if ($select.attr("placeholder")) {
        placeholder = $select.attr("placeholder");
    }

    if ($select.attr("multiple")) {
        var defaultOptions = {
            "language": "pt-BR",
            'placeholder' : placeholder
        };
    } else {
        var defaultOptions = {
            "language": "pt-BR"
        };
    }

    $select.select2(defaultOptions);

}
