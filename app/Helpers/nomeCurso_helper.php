<?php

function nomeCurso($tipo) {

    switch ($tipo) {
        
        case 'es':
            return "Engenharia de Software";

        case 'cc':
            return "Ciência da Computação";

        case 'si':
            return "Sistemas de Informação";

    }

}