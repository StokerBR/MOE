<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validação de CPF e CNPJ
 *
 * @author Henrique Martins <henrique@sysout.com.br>
 * @since 09/08/2021 
 * @version 1.0.0
 */
class CPFCNPJ implements Rule {

    public function passes($attribute, $value) {
        return checkCPF($value) || checkCNPJ($value);
    }

    public function message() {
        return "O documento (CPF ou CNPJ) informado é inválido.";
    }

}
