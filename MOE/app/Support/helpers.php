<?php

if (!function_exists('getCurrentGuard')) {

    /**
     * Retorna a guard atual
     * @return string
     */
    function getCurrentGuard() {

        $currentGuard = 'web';

        if (request()->is(adminPrefix().'*')) {
            return $currentGuard = 'admin';

        } else if (request()->is(studentPrefix().'*')) {
            return $currentGuard = 'student';

        } else if (request()->is(companyPrefix().'*')) {
            return $currentGuard = 'company';

        } else if (request()->is(courseCoordPrefix().'*')) {
            return $currentGuard = 'course-coordinator';
        }

        return $currentGuard;

    }

}

if (!function_exists('dynPrefix')) {

    /**
     * Retorna o prefixo dinâmico de acordo com a rota atual
     * @return string
     */
    function dynPrefix() {

        if (request()->is(adminPrefix().'*')) {
            return adminPrefix();

        } else if (request()->is(studentPrefix().'*')) {
            return studentPrefix();

        } else if (request()->is(companyPrefix().'*')) {
            return companyPrefix();

        } else if (request()->is(courseCoordPrefix().'*')) {
            return courseCoordPrefix();

        } else {
            return '';
        }

    }
}

if (!function_exists('dynUrl')) {

    /**
     * Retorna uma url dinâmica de acordo com a rota atual
     * @param unknown $url
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string|unknown
     */
    function dynUrl($url) {

        if (request()->is(adminPrefix().'*')) {
            return adminUrl($url);

        } else if (request()->is(studentPrefix().'*')) {
            return studentUrl($url);

        } else if (request()->is(companyPrefix().'*')) {
            return companyUrl($url);

        } else if (request()->is(courseCoordPrefix().'*')) {
            return courseCoordUrl($url);

        } else {
            return url($url);
        }
    }

}

if (!function_exists('dynRedirect')) {

    /**
     * Redireciona dinâmicamente um usuário para determinada rota
     * @param [type] $url
     * @return void
     */
    function dynRedirect($url) {
        return redirect(dynUrl($url));
    }
}

if (!function_exists('adminRedirect')) {

    /**
     * Redirectiona para uma url de admin
     * @param unknown $url
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function adminRedirect($url) {
        return redirect(adminUrl($url));
    }

}

if (!function_exists('studentRedirect')) {

    /**
     * Redirectiona para uma url de universitário
     * @param unknown $url
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function studentRedirect($url) {
        return redirect(studentUrl($url));
    }

}

if (!function_exists('companyRedirect')) {

    /**
     * Redirectiona para uma url de empresa
     * @param unknown $url
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function companyRedirect($url) {
        return redirect(companyUrl($url));
    }

}

if (!function_exists('courseCoordRedirect')) {

    /**
     * Redirectiona para uma url de admin
     * @param unknown $url
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function courseCoordRedirect($url) {
        return redirect(courseCoordUrl($url));
    }

}

if (!function_exists('adminUrl')) {

    /**
     * Obtem a url de admin
     * @param unknown $url
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function adminUrl($url) {
        return url(adminPrefix() . '/' .$url);
    }
}

if (!function_exists('studentUrl')) {

    /**
     * Obtem a url de universitário
     * @param unknown $url
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function studentUrl($url) {
        return url(studentPrefix() . '/' .$url);
    }
}

if (!function_exists('companyUrl')) {

    /**
     * Obtem a url de empresa
     * @param unknown $url
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function companyUrl($url) {
        return url(companyPrefix() . '/' .$url);
    }
}

if (!function_exists('courseCoordUrl')) {

    /**
     * Obtem a url de coordenador de curso
     * @param unknown $url
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function courseCoordUrl($url) {
        return url(courseCoordPrefix() . '/' .$url);
    }
}

if (!function_exists('adminPrefix')) {

    /**
     * Obtem o prefix de rota de admin
     * @return string
     */
    function adminPrefix() {
        return config('admin.prefix');
    }
}

if (!function_exists('studentPrefix')) {

    /**
     * Obtem o prefix de rota de universitário
     * @return string
     */
    function studentPrefix() {
        return config('student.prefix');
    }
}

if (!function_exists('companyPrefix')) {

    /**
     * Obtem o prefix de rota de empresa
     * @return string
     */
    function companyPrefix() {
        return config('company.prefix');
    }
}

if (!function_exists('courseCoordPrefix')) {

    /**
     * Obtem o prefix de rota de coordenador de curso
     * @return string
     */
    function courseCoordPrefix() {
        return config('course-coordinator.prefix');
    }
}

if (!function_exists('onlyNumbers')) {

    /**
    * Remove todos os caracteres não numéricos da string
    *
    * @param string $str
    * @return string
    */
    function onlyNumbers($str) {
        return preg_replace('/[^0-9]/', '', $str);
    }
}

if (!function_exists('checkCNPJ')) {

    /**
    * Verifica se um CNPJ é válido
    *
    * @param string $value
    * @return void
    */
    function checkCNPJ($value) {

        $value = onlyNumbers((string) $value);

        // Valida tamanho
        if (strlen($value) != 14) {
            return false;
        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i ++) {
            $soma += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;

        if ($value[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i ++) {
            $soma += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $value[13] == ($resto < 2 ? 0 : 11 - $resto);

    }

}

if (!function_exists('checkCPF')) {

    /**
    * Verifica se um CPF é válido
    *
    * @param string $value
    * @return void
    */
    function checkCPF($value) {
        $cpf = $value;

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = onlyNumbers($cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        }
    }

}


if (!function_exists('randomArrayUniqueNumbers')) {

    /**
     * Retorna um array em orem aleatória de números não repetidos
     *
     * @param int $min
     * @param int $max
     * @param int $size
     * @return array
     */
    function randomArrayUniqueNumbers($min, $max, $size = null) {

        $numbers = range($min, $max);
        shuffle($numbers);

        if ($size) {
            array_splice($numbers, $size);
        }

        return $numbers;

    }

}
