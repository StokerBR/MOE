"use strict";

(function($) {

	window.Parsley.on("field:error", function() {
		this.$element.addClass("error");
	});

	window.Parsley.on("field:success", function() {
		this.$element.removeClass("error");
	});

	window.Parsley.addValidator('notequalto', {
		requirementType: 'string',
		validateString: function (value, element) {
			return value !== $(element).val();
		},
		messages: {
			'pt-br': 'Esse valor precisa ser diferente!'
		}
	});

    // Valida o cnpj
	window.Parsley.addValidator('cnpj', {
		requirementType: 'string',
		validateString: function (value, requirement) {

	        var  cnpj = value.replace(/[^0-9]/g, '');
	    	var len = cnpj.length - 2;
	    	var numbers = cnpj.substring(0,len);
	    	var digits = cnpj.substring(len);
	    	var add = 0;
	    	var pos = len - 7;
	    	var invalidCNPJ = [
				'00000000000000',
				'11111111111111',
				'22222222222222',
				'33333333333333',
				'44444444444444',
				'55555555555555',
				'66666666666666',
				'77777777777777',
				'88888888888888',
				'99999999999999'
			];

	    	var result;

	        if (cnpj.length < 11 || $.inArray(cnpj, invalidCNPJ) !== -1) {
	            return false;
	        }

	        for (var i = len; i >= 1; i--) {
	            add = add + parseInt(numbers.charAt(len - i)) * pos--;
	            if (pos < 2) { pos = 9; }
	        }

	        result = (add % 11) < 2 ? 0 : 11 - (add % 11);
	        if (result != digits.charAt(0)) {
	            return false;
	        }

	        len = len + 1;
	        numbers = cnpj.substring(0,len);
	        add = 0;
	        pos = len - 7;

	        for (var i = 13; i >= 1; i--) {
	            add = add + parseInt(numbers.charAt(len - i)) * pos--;
	            if (pos < 2) { pos = 9; }
	        }

			result = (add % 11) < 2 ? 0 : 11 - (add % 11);

	        if (result != digits.charAt(1)) {
	            return false;
	        }

	        return true;
		},
		messages: {
			'pt-br': 'Este campo deve ser um CNPJ válido.'
		}
    });

    //Validação de cpf.
	window.Parsley.addValidator('cpf', {
		requirementType: 'string',
		validateString: function (value, element) {

			var cpf = value.replace(/[^\d]+/g, '');

			if (cpf == '') {
				return false;
			}

			// Elimina CPFs invalidos conhecidos
			if (cpf.length != 11 ||
				cpf == "00000000000" ||
				cpf == "11111111111" ||
				cpf == "22222222222" ||
				cpf == "33333333333" ||
				cpf == "44444444444" ||
				cpf == "55555555555" ||
				cpf == "66666666666" ||
				cpf == "77777777777" ||
				cpf == "88888888888" ||
				cpf == "99999999999") {

				return false;
			}

			// Valida 1o digito
			var add = 0;
			for (var i = 0; i < 9; i++) {
				add += parseInt(cpf.charAt(i)) * (10 - i);
			}

			var rev = 11 - (add % 11);
			if (rev == 10 || rev == 11) {
				rev = 0;
			}

			if (rev != parseInt(cpf.charAt(9))) {
				return false;
			}

			// Valida 2o digito
			add = 0;
			for (var i = 0; i < 10; i++) {
				add += parseInt(cpf.charAt(i)) * (11 - i);
			}

			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11) {
				rev = 0;
			}

			if (rev != parseInt(cpf.charAt(10))) {
				return false;
			}

			return true;

		},
		messages: {
			'pt-br': 'O valor do CPF informado é inválido!'
		}
	});

}(window.jQuery));
