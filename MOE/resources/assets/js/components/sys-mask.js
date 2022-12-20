"use strict";

/**
* Carregar máscara no elemento
* @returns null
*/
$.fn.sysMask = function(key) {

    var masks = {
        "zipcode": "00000-000",
        "cpf": "000.000.000-00",
        "cnpj": "00.000.000/0000-00",
    };

    if (key in masks) {

        $(this).mask(masks[key]);

    } else if (key == "phone") {

        phoneMask($(this))

    } else if (key == "percent") {

        $(this).mask('##0,00', { reverse: true });

    } else if (key == "number") {

        // Faz com que aceite somente números no campo de código
        $(this).on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });

    } else if (key == "doc") {

        var CpfCnpjMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
        };

        var cpfCnpjoptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
            }
        };

        $(this).mask(CpfCnpjMaskBehavior, cpfCnpjoptions);

    } else {
        console.error(`Não foi possível carregar a máscara para a chave "${key}"`);
    }
}

function phoneMask($elem) {

	var celPhoneMask = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    };

    var spOptions = {
	    onKeyPress: function(val, e, field, options) {
		    field.mask(celPhoneMask.apply({}, arguments), options);
	    }
    };

	$elem.mask(celPhoneMask, spOptions);
}

$(function() {

    $("[sys-mask]").each(function() {
        $(this).sysMask(this.getAttribute("sys-mask"));
    });

});
